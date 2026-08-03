<?php
session_start();
include 'connectdb.php';
include 'nav.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$content_type = $_GET['type'] ?? '';
$comment_id = $_GET['id'] ?? '';

$typeConfig = [
    'news_comment' => 'comments',
    'thread_reply' => 'threads_replies',
];

if (!isset($typeConfig[$content_type]) || !$comment_id) {
    die('Invalid request.');
}

$table = $typeConfig[$content_type];

$stmt = $conn->prepare("SELECT text, user_id FROM $table WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$comment = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
    die('You do not have permission to edit this comment.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="retrieve_news.css">
    <link rel="stylesheet" href="feedback.css">
    <script src="nav.js" defer></script>
</head>
<body>
    <h1 class="title"><u>Edit Comment</u></h1>
    <section class="comment-form">
        <form method="POST" action="update_comment.php">
            <textarea name="text" required><?php echo htmlspecialchars($comment['text']); ?></textarea><br>
            <input type="hidden" name="content_type" value="<?php echo htmlspecialchars($content_type); ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($comment_id); ?>">
            <button type="submit">Save Changes</button>
        </form>
    </section>
</body>
</html>
