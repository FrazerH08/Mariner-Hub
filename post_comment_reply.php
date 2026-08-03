<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$news_id = $_POST['news_id'] ?? '';
$parent_id = $_POST['parent_id'] ?? '';
$text = $_POST['text'] ?? '';
$user_id = $_SESSION['user_id'];

if (!$news_id || !$parent_id || trim($text) === '') {
    die('Invalid request.');
}

// Confirm the parent is a real, top-level comment on this article
// (parent_id IS NULL here enforces single-level nesting - you can't reply to a reply)
$stmt = $conn->prepare("SELECT id FROM comments WHERE id = ? AND news_id = ? AND parent_id IS NULL");
$stmt->bind_param("ii", $parent_id, $news_id);
$stmt->execute();
$parent = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$parent) {
    die('Invalid parent comment.');
}

$stmt = $conn->prepare("INSERT INTO comments (news_id, user_id, text, parent_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $news_id, $user_id, $text, $parent_id);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: retrieve_news.php?id=' . $news_id);
exit;
