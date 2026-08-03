<?php
ob_start();
session_start();
include 'connectdb.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    ob_end_clean();
    http_response_code(401);
    echo json_encode(['error' => 'You must be logged in to report a comment.']);
    exit;
}

$REPORT_THRESHOLD = 3; // number of reports before a comment auto-hides

$user_id = $_SESSION['user_id'];
$content_type = $_POST['content_type'] ?? null;
$content_id = $_POST['content_id'] ?? null;

$typeConfig = [
    'news_comment' => 'comments',
    'thread_reply' => 'threads_replies',
];

if (!$content_id || !isset($typeConfig[$content_type])) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request.']);
    exit;
}

$table = $typeConfig[$content_type];

// Don't allow reporting your own comment
$stmt = $conn->prepare("SELECT user_id FROM $table WHERE id = ?");
$stmt->bind_param("i", $content_id);
$stmt->execute();
$owner = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$owner) {
    ob_end_clean();
    http_response_code(404);
    echo json_encode(['error' => 'Comment not found.']);
    exit;
}

if ($owner['user_id'] == $user_id) {
    ob_end_clean();
    echo json_encode(['error' => "You can't report your own comment."]);
    exit;
}

// Check if this user already reported this comment
$stmt = $conn->prepare("SELECT id FROM reports WHERE content_type = ? AND content_id = ? AND user_id = ?");
$stmt->bind_param("sii", $content_type, $content_id, $user_id);
$stmt->execute();
$existing = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($existing) {
    ob_end_clean();
    echo json_encode(['error' => 'You have already reported this comment.']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO reports (content_type, content_id, user_id) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $content_type, $content_id, $user_id);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM reports WHERE content_type = ? AND content_id = ?");
$stmt->bind_param("si", $content_type, $content_id);
$stmt->execute();
$count = (int)$stmt->get_result()->fetch_assoc()['count'];
$stmt->close();

$hidden = false;
if ($count >= $REPORT_THRESHOLD) {
    $hidden = true;
    $stmt = $conn->prepare("UPDATE $table SET hidden = 1 WHERE id = ?");
    $stmt->bind_param("i", $content_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
ob_end_clean();
echo json_encode(['reported' => true, 'count' => $count, 'hidden' => $hidden]);
