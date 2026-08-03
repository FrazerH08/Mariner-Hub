<?php
ob_start(); // catch any stray output/warnings so they can't corrupt the JSON response
session_start();
include 'connectdb.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    ob_end_clean();
    http_response_code(401);
    echo json_encode(['error' => 'You must be logged in to react.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$content_type = $_POST['content_type'] ?? null;
$content_id = $_POST['content_id'] ?? null;
$type = $_POST['type'] ?? null;

$allowed_content_types = ['news', 'news_comment', 'thread', 'thread_reply'];
if (!$content_id || !in_array($content_type, $allowed_content_types, true) || !in_array($type, ['like', 'dislike'], true)) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request.']);
    exit;
}

// Check for an existing vote from this user on this piece of content
$stmt = $conn->prepare("SELECT id, type FROM reactions WHERE content_type = ? AND content_id = ? AND user_id = ?");
$stmt->bind_param("sii", $content_type, $content_id, $user_id);
$stmt->execute();
$existing = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($existing) {
    if ($existing['type'] === $type) {
        // Clicking the same button again removes the vote
        $stmt = $conn->prepare("DELETE FROM reactions WHERE id = ?");
        $stmt->bind_param("i", $existing['id']);
        $stmt->execute();
        $stmt->close();
        $my_vote = null;
    } else {
        // Switching from like to dislike or vice versa
        $stmt = $conn->prepare("UPDATE reactions SET type = ? WHERE id = ?");
        $stmt->bind_param("si", $type, $existing['id']);
        $stmt->execute();
        $stmt->close();
        $my_vote = $type;
    }
} else {
    // New vote
    $stmt = $conn->prepare("INSERT INTO reactions (content_type, content_id, user_id, type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $content_type, $content_id, $user_id, $type);
    $stmt->execute();
    $stmt->close();
    $my_vote = $type;
}

// Recalculate counts to send back
$stmt = $conn->prepare("SELECT
        SUM(CASE WHEN type = 'like' THEN 1 ELSE 0 END) AS likes,
        SUM(CASE WHEN type = 'dislike' THEN 1 ELSE 0 END) AS dislikes
    FROM reactions WHERE content_type = ? AND content_id = ?");
$stmt->bind_param("si", $content_type, $content_id);
$stmt->execute();
$counts = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

ob_end_clean();
echo json_encode([
    'likes' => (int)($counts['likes'] ?? 0),
    'dislikes' => (int)($counts['dislikes'] ?? 0),
    'my_vote' => $my_vote
]);
