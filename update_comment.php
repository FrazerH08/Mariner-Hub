<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$content_type = $_POST['content_type'] ?? '';
$comment_id = $_POST['id'] ?? '';
$text = $_POST['text'] ?? '';

$typeConfig = [
    'news_comment' => ['table' => 'comments', 'parent_col' => 'news_id', 'redirect' => 'retrieve_news.php'],
    'thread_reply' => ['table' => 'threads_replies', 'parent_col' => 'thread_id', 'redirect' => 'retrieve_thread.php'],
];

if (!isset($typeConfig[$content_type]) || !$comment_id || trim($text) === '') {
    die('Invalid request.');
}

$config = $typeConfig[$content_type];
$table = $config['table'];
$parentCol = $config['parent_col'];

// Confirm ownership and grab the parent id so we know where to redirect back to
$stmt = $conn->prepare("SELECT user_id, $parentCol AS parent_id FROM $table WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$row || $row['user_id'] != $_SESSION['user_id']) {
    die('You do not have permission to edit this comment.');
}

$stmt = $conn->prepare("UPDATE $table SET text = ? WHERE id = ?");
$stmt->bind_param("si", $text, $comment_id);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: ' . $config['redirect'] . '?id=' . $row['parent_id']);
exit;
