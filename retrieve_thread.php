<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Thread </title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="retrieve_news.css">
    <link rel="stylesheet" href="feedback.css">
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
        .react-btn {
            background: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 2px 8px;
            margin-right: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .react-btn.active {
            border-color: #C8102E;
            color: #C8102E;
            font-weight: bold;
        }
        .report-btn {
            background: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 2px 8px;
            cursor: pointer;
            font-size: 13px;
            color: #888;
        }
        .report-btn:hover {
            border-color: #C8102E;
            color: #C8102E;
        }
        .report-btn:disabled {
            opacity: 0.6;
            cursor: default;
        }
        .comment-box {
            position: relative;
        }
        .comment-actions {
            position: absolute;
            top: 14px;
            right: 18px;
            font-size: 13px;
        }
        .comment-actions a,
        .comment-actions .report-btn {
            margin-left: 12px;
        }
        .comment-actions .edit-btn,
        .comment-actions .delete-btn {
            color: #888;
            text-decoration: none;
            font-size: 15px;
        }
        .comment-actions .edit-btn:hover,
        .comment-actions .delete-btn:hover {
            color: #C8102E;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="nav.js" defer></script>
    <script src="reactions.js" defer></script>
</head>
<body>
    
<?php
include 'connectdb.php';
$thread_id = $_GET['id'];
$current_user_id = $_SESSION['user_id'] ?? 0;

$sql = "SELECT title, description, content, username FROM threads WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$result = $stmt->get_result();

// Reaction counts for the thread post itself
$threadReactStmt = $conn->prepare("SELECT
        COALESCE(SUM(CASE WHEN type = 'like' THEN 1 ELSE 0 END), 0) AS likes,
        COALESCE(SUM(CASE WHEN type = 'dislike' THEN 1 ELSE 0 END), 0) AS dislikes,
        MAX(CASE WHEN user_id = ? THEN type ELSE NULL END) AS my_vote
    FROM reactions WHERE content_type = 'thread' AND content_id = ?");
$threadReactStmt->bind_param("ii", $current_user_id, $thread_id);
$threadReactStmt->execute();
$threadReact = $threadReactStmt->get_result()->fetch_assoc();
$threadReactStmt->close();

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        echo '<section class="postCard2">';
        echo "<h1>" . html_entity_decode($row['title']) . "</h1>";
        echo '<h2> Created By: ' . html_entity_decode($row['username']) . "</h2>";
        echo "<h3>" . html_entity_decode($row['description']) . "</h3>";
        echo "<p>" . html_entity_decode($row['content']) . "</p>";

        $likeActive = $threadReact['my_vote'] === 'like' ? ' active' : '';
        $dislikeActive = $threadReact['my_vote'] === 'dislike' ? ' active' : '';

        if (isset($_SESSION['user_id'])) {
            echo '<div class="reactions">';
            echo '<button class="react-btn like-btn' . $likeActive . '" data-content-type="thread" data-content-id="' . htmlspecialchars($thread_id) . '" data-type="like">👍 <span class="like-count">' . htmlspecialchars($threadReact['likes']) . '</span></button>';
            echo '<button class="react-btn dislike-btn' . $dislikeActive . '" data-content-type="thread" data-content-id="' . htmlspecialchars($thread_id) . '" data-type="dislike">👎 <span class="dislike-count">' . htmlspecialchars($threadReact['dislikes']) . '</span></button>';
            echo '</div>';
        } else {
            echo '<div class="reactions">👍 ' . htmlspecialchars($threadReact['likes']) . ' &nbsp; 👎 ' . htmlspecialchars($threadReact['dislikes']) . '</div>';
        }

        echo '</section>';
    }
} else {
    echo "Sorry, 0 Results Returned";
}


?>

<?php
if (isset($_SESSION['user_id'])){
    echo '
    <section class="comment-form">
        <form method="POST" action="post_thread_replies.php">
            <textarea name="text" placeholder="What would you like to comment..." required></textarea><br>
            <input type="hidden" name="thread_id" value="'. htmlspecialchars($thread_id) . '">
                <button class="btn" type="submit">Post Comment</button>
        </form>
    </section>';
} else{
    echo '<p class="login-prompt">Please <a href="login.php">Log In</a> to comment</p>';
}

// hidden = 0 filters out replies that have crossed the report threshold
$commentQuery = "SELECT t.id, t.text, t.date_created, t.user_id AS reply_user_id, u.username,
        COALESCE(SUM(CASE WHEN r.type = 'like' THEN 1 ELSE 0 END), 0) AS likes,
        COALESCE(SUM(CASE WHEN r.type = 'dislike' THEN 1 ELSE 0 END), 0) AS dislikes,
        MAX(CASE WHEN r.user_id = ? THEN r.type ELSE NULL END) AS my_vote
    FROM threads_replies t
    JOIN users u ON t.user_id = u.id
    LEFT JOIN reactions r ON r.content_type = 'thread_reply' AND r.content_id = t.id
    WHERE t.thread_id = ? AND t.hidden = 0
    GROUP BY t.id, t.text, t.date_created, t.user_id, u.username
    ORDER BY t.date_created ASC";
$commentStmt = $conn->prepare($commentQuery);
$commentStmt->bind_param("ii", $current_user_id, $thread_id);
$commentStmt->execute();
$commentResult = $commentStmt->get_result();

echo '<section class="comments">';
echo '<h3>Comments:</h3>';
while ($comment = $commentResult->fetch_assoc()) {
    $likeActive = $comment['my_vote'] === 'like' ? ' active' : '';
    $dislikeActive = $comment['my_vote'] === 'dislike' ? ' active' : '';
    $isOwner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['reply_user_id'];

    echo "<div class='comment-box'>";

    if (isset($_SESSION['user_id'])) {
        echo '<div class="comment-actions">';
        if ($isOwner) {
            echo '<a href="edit_comment.php?type=thread_reply&id=' . htmlspecialchars($comment['id']) . '" class="edit-btn" title="Edit"><i class="fa-solid fa-pen"></i></a>';
            echo '<a href="delete_comment.php?type=thread_reply&id=' . htmlspecialchars($comment['id']) . '" class="delete-btn" title="Delete" onclick="return confirm(\'Do You Really Want To Delete This?\')"><i class="fa-solid fa-trash"></i></a>';
        } else {
            echo '<button class="report-btn" data-content-type="thread_reply" data-content-id="' . htmlspecialchars($comment['id']) . '">Report</button>';
        }
        echo '</div>';
    }

    echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
    echo "<p>" . nl2br(htmlspecialchars($comment['text'])) . "</p>";
    echo "<p>". date("F j, Y, g:i a", strtotime($comment['date_created'])) . "</p>";

    if (isset($_SESSION['user_id'])) {
        echo '<div class="reactions">';
        echo '<button class="react-btn like-btn' . $likeActive . '" data-content-type="thread_reply" data-content-id="' . htmlspecialchars($comment['id']) . '" data-type="like">👍 <span class="like-count">' . htmlspecialchars($comment['likes']) . '</span></button>';
        echo '<button class="react-btn dislike-btn' . $dislikeActive . '" data-content-type="thread_reply" data-content-id="' . htmlspecialchars($comment['id']) . '" data-type="dislike">👎 <span class="dislike-count">' . htmlspecialchars($comment['dislikes']) . '</span></button>';
        echo '</div>';
    } else {
        echo '<div class="reactions">👍 ' . htmlspecialchars($comment['likes']) . ' &nbsp; 👎 ' . htmlspecialchars($comment['dislikes']) . '</div>';
    }

    echo "</div><hr>";
}
echo '</section>';
$stmt->close();
$commentStmt->close();
$conn->close();
?>
    <footer>
        <div class="f-container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email: citizensroadtosurvival@gmail.com</p>
            </div>
            <div class="footer-content">
                <h3> Quick links</h3>
                <ul class="f-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="https://x.com/Citizens_RoadTS"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/citizensroadtosurvival/"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>This is a fictional student website.</p>
        </div>
    </footer>
</body>
</html>