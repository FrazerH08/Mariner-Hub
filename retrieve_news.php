<?php
session_start();
include 'connectdb.php';
include 'nav.php';
$news_id = $_GET['id'];
$current_user_id = $_SESSION['user_id'] ?? 0;

$sql = "SELECT title, description, content, picture, username, time_created FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();

// Reaction counts for the article itself
$newsReactStmt = $conn->prepare("SELECT
        COALESCE(SUM(CASE WHEN type = 'like' THEN 1 ELSE 0 END), 0) AS likes,
        COALESCE(SUM(CASE WHEN type = 'dislike' THEN 1 ELSE 0 END), 0) AS dislikes,
        MAX(CASE WHEN user_id = ? THEN type ELSE NULL END) AS my_vote
    FROM reactions WHERE content_type = 'news' AND content_id = ?");
$newsReactStmt->bind_param("ii", $current_user_id, $news_id);
$newsReactStmt->execute();
$newsReact = $newsReactStmt->get_result()->fetch_assoc();
$newsReactStmt->close();

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        echo '<section class="postCard2">';
        if (!empty($row['picture'])) {
            echo "<h1>" . html_entity_decode($row['title']) . "</h1>";
            // If it's a file path
            if (file_exists($row['picture'])) {
                echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='Post Image'>";
            }
            // If it's base64 encoded
            else if (strpos($row['picture'], 'base64') !== false) {
                echo "<img src='" . $row['picture'] . "' alt='Post Image'>";
            }
            // If it's binary data
            else {
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['picture']) . "' alt='Post Image'>";
            }
        }
         echo '<h2>Created By: ' . htmlspecialchars($row['username']) . '</h2>';
        echo "<p>". date("F j, Y, g:i a", strtotime($row['time_created'])) . "</p>";
        echo "<h3>" . html_entity_decode($row['description']) . "</h3>";
        echo "<p>" . html_entity_decode($row['content']) . "</p>";

        $likeActive = $newsReact['my_vote'] === 'like' ? ' active' : '';
        $dislikeActive = $newsReact['my_vote'] === 'dislike' ? ' active' : '';

        if (isset($_SESSION['user_id'])) {
            echo '<div class="reactions">';
            echo '<button class="react-btn like-btn' . $likeActive . '" data-content-type="news" data-content-id="' . htmlspecialchars($news_id) . '" data-type="like">👍 <span class="like-count">' . htmlspecialchars($newsReact['likes']) . '</span></button>';
            echo '<button class="react-btn dislike-btn' . $dislikeActive . '" data-content-type="news" data-content-id="' . htmlspecialchars($news_id) . '" data-type="dislike">👎 <span class="dislike-count">' . htmlspecialchars($newsReact['dislikes']) . '</span></button>';
            echo '</div>';
        } else {
            echo '<div class="reactions">👍 ' . htmlspecialchars($newsReact['likes']) . ' &nbsp; 👎 ' . htmlspecialchars($newsReact['dislikes']) . '</div>';
        }

        echo '</section>';
    }
} else {
    echo "Sorry, 0 Results Returned";
}



?>
    <div class="read-more-btn-container">
        <a class="read-more-btn" style="text-align: center;" href="list_news.php">Read More Articles</a>
    </div>
<?php
if (isset($_SESSION['user_id'])){
    echo '
    <section class="comment-form">
        <form method="POST" action="post_comment.php">
            <textarea name="text" placeholder="What would you like to comment..." required></textarea><br>
            <input type="hidden" name="news_id" value="'. htmlspecialchars($news_id) . '">
            <button type="submit">Post Comment</button>
        </form>
    </section>';
} else{
    echo '<p class="login-prompt">Please <a href="login.php">Log In</a> to comment</p>';
}

// hidden = 0 filters out comments that have crossed the report threshold
// This fetches BOTH top-level comments and their single-level replies in one go;
// they get separated into a tree structure in PHP below
$commentQuery = "SELECT c.id, c.text, c.date_created, c.user_id AS comment_user_id, c.parent_id, u.username,
        COALESCE(SUM(CASE WHEN r.type = 'like' THEN 1 ELSE 0 END), 0) AS likes,
        COALESCE(SUM(CASE WHEN r.type = 'dislike' THEN 1 ELSE 0 END), 0) AS dislikes,
        MAX(CASE WHEN r.user_id = ? THEN r.type ELSE NULL END) AS my_vote
    FROM comments c
    JOIN users u ON c.user_id = u.id
    LEFT JOIN reactions r ON r.content_type = 'news_comment' AND r.content_id = c.id
    WHERE c.news_id = ? AND c.hidden = 0
    GROUP BY c.id, c.text, c.date_created, c.user_id, c.parent_id, u.username
    ORDER BY c.date_created ASC";
$commentStmt = $conn->prepare($commentQuery);
$commentStmt->bind_param("ii", $current_user_id, $news_id);
$commentStmt->execute();
$commentResult = $commentStmt->get_result();

// Split the flat result set into top-level comments and a lookup of replies by parent id
$topLevelComments = [];
$repliesByParent = [];
while ($comment = $commentResult->fetch_assoc()) {
    if ($comment['parent_id'] === null) {
        $topLevelComments[] = $comment;
    } else {
        $repliesByParent[$comment['parent_id']][] = $comment;
    }
}
$topLevelComments = array_reverse($topLevelComments); // newest top-level comment first

function renderCommentBox($comment, $news_id, $isReply = false) {
    $likeActive = $comment['my_vote'] === 'like' ? ' active' : '';
    $dislikeActive = $comment['my_vote'] === 'dislike' ? ' active' : '';
    $isOwner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['comment_user_id'];
    $boxClass = $isReply ? 'comment-box reply-box' : 'comment-box';

    echo "<div class='" . $boxClass . "' id='comment-" . htmlspecialchars($comment['id']) . "'>";

    if (isset($_SESSION['user_id'])) {
        echo '<div class="comment-actions">';
        if ($isOwner) {
            echo '<a href="edit_comment.php?type=news_comment&id=' . htmlspecialchars($comment['id']) . '" class="edit-btn" title="Edit"><i class="fa-solid fa-pen"></i></a>';
            echo '<a href="delete_comment.php?type=news_comment&id=' . htmlspecialchars($comment['id']) . '" class="delete-btn" title="Delete" onclick="return confirm(\'Do You Really Want To Delete This?\')"><i class="fa-solid fa-trash"></i></a>';
        } else {
            echo '<button class="report-btn" data-content-type="news_comment" data-content-id="' . htmlspecialchars($comment['id']) . '">Report</button>';
        }
        echo '</div>';
    }

    echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
    echo "<p>" . nl2br(htmlspecialchars($comment['text'])) . "</p>";
    echo "<p>". date("F j, Y, g:i a", strtotime($comment['date_created'])) . "</p>";

    if (isset($_SESSION['user_id'])) {
        echo '<div class="reactions">';
        echo '<button class="react-btn like-btn' . $likeActive . '" data-content-type="news_comment" data-content-id="' . htmlspecialchars($comment['id']) . '" data-type="like">👍 <span class="like-count">' . htmlspecialchars($comment['likes']) . '</span></button>';
        echo '<button class="react-btn dislike-btn' . $dislikeActive . '" data-content-type="news_comment" data-content-id="' . htmlspecialchars($comment['id']) . '" data-type="dislike">👎 <span class="dislike-count">' . htmlspecialchars($comment['dislikes']) . '</span></button>';
        if (!$isReply) {
            echo ' <button class="reply-toggle-btn" data-target="reply-form-' . htmlspecialchars($comment['id']) . '">Reply</button>';
        }
        echo '</div>';
    } else {
        echo '<div class="reactions">👍 ' . htmlspecialchars($comment['likes']) . ' &nbsp; 👎 ' . htmlspecialchars($comment['dislikes']) . '</div>';
    }

    // Reply form only makes sense on top-level comments, since replies can't themselves be replied to
    if (!$isReply && isset($_SESSION['user_id'])) {
        echo '<form method="POST" action="post_comment_reply.php" class="reply-form" id="reply-form-' . htmlspecialchars($comment['id']) . '" style="display:none;">';
        echo '<textarea name="text" placeholder="Write a reply..." required></textarea><br>';
        echo '<input type="hidden" name="news_id" value="' . htmlspecialchars($news_id) . '">';
        echo '<input type="hidden" name="parent_id" value="' . htmlspecialchars($comment['id']) . '">';
        echo '<button type="submit">Post Reply</button>';
        echo '</form>';
    }

    echo '</div>';
}

echo '<section class="comments">';
echo '<h3>Comments:</h3>';
foreach ($topLevelComments as $comment) {
    renderCommentBox($comment, $news_id, false);

    if (!empty($repliesByParent[$comment['id']])) {
        echo '<div class="replies">';
        foreach ($repliesByParent[$comment['id']] as $reply) {
            renderCommentBox($reply, $news_id, true);
        }
        echo '</div>';
    }

    echo '<hr>';
}
echo '</section>';
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Article</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="retrieve_news.css">
    <link rel="stylesheet" href="feedback.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
    <script src="reactions.js" defer></script>
</head>
<body>
</div>
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
                    <li><a href="list_news.php">News</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="about_club.php">About Club</a></li>
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
            <p>This is a student website , with some further additions after the course as I am extremely passionate about the club!</p>
            <p><a class="other-projects-link" href="other-projects\index.html">My other websites/projects </a></p>
        </div>
    </footer>

</body>
</html>
<?php 