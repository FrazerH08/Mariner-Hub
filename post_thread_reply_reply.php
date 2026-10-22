<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$thread_id = $_POST['thread_id'] ?? '';
$parent_id = $_POST['parent_id'] ?? '';
$text = $_POST['text'] ?? '';
$user_id = $_SESSION['user_id'];

if (!$thread_id || !$parent_id || trim($text) === '') {
    die('Invalid request.');
}

// Confirm the parent is a real, top-level reply on this thread
// (parent_id IS NULL here enforces single-level nesting - you can't reply to a reply)
$stmt = $conn->prepare("SELECT id FROM threads_replies WHERE id = ? AND thread_id = ? AND parent_id IS NULL");
$stmt->bind_param("ii", $parent_id, $thread_id);
$stmt->execute();
$parent = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$parent) {
    die('Invalid parent reply.');
}

$stmt = $conn->prepare("INSERT INTO threads_replies (thread_id, user_id, text, parent_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $thread_id, $user_id, $text, $parent_id);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: retrieve_thread.php?id=' . $thread_id);
exit;
