<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="stats.css">
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
    <h1 class="title"><u>Stats</u></h1>
    <div class="grid-container">
        <a href="league_table.php"class="btn">League 2 table</a>
        <a href="squad_stats.php" class="btn">Squad Stats</a>
        <a href="fixtures&results.php" class="btn">Fixtures & Results</a>
        <iframe id="sofa-standings-embed-84-61960" src="https://widgets.sofascore.com/embed/tournament/84/season/61960/standings/League%20Two?widgetTitle=League%20Two&showCompetitionLogo=true" style=height:1283px!important;max-width:768px!important;width:100%!important; frameborder="0" scrolling="yes"></iframe>
        <p class="stats-summary">
            <b><u>Top Scorer:</u></b>
            <br>
            <br> <b>Danny Rose:</b>15 goals
            <br> <br>
            <b><u>Top Assister:</u></b>
            <br>
            <br> <b>Denver Hume :</b>15 assists
            <br> <br>
            <b><u>Most Clean sheets as a goalkeeper:</u></b>
            <br>
            <br> <b><u>Jordan Wright :</u></b> 6 clean sheets
            <br> <br>
            <b><u>Most Appearances:</u></b>
            <br>
            <br> <b>Evan Khouri:</b> 50 Appearances
            <br> <br>
            <br><b><u>Most Yellow Cards:</u></b>
            <br> <b>Kieran Green & Denver Hume:</b> 10 Yellow Cards
            <br> <br>
            <br><b><u>Most Red Cards:</u></b>
            <br> <b>Kieran Green, Harvey Rodgers & Lewis Cass:</b> 1 Red Card
            <br>
        </p>
        <p class="stats-summary">
            <b><u>Results:</u></b> <br>
            03/05/25 Grimsby Town 0-1 Wimbledon  L 
            <br>
            26/04/25 MK Dons 0-0 Grimsby Town D 
            <br>
            21/04/25 Port Vale 2-2 Grimsby Town D 
            <br>
            18/04/25 Grimsby 0-4 Swindon L
            <br>
            12/04/25 Harrogate 2-2 Grimsby D
            <br>
            05/04/25 Grimsby 3-1 Morecambe W
            <br>
            01/04/25 Crewe 2-0 Grimsby L
            <br>
            28/03/25 Colchester 1-2 Grimsby W
            <br>
            22/03/25 Grimsby 1-0 Newport W
            <br>
            <br>
            <b><u>Fixtures:</u></b> <br>
            05/07/25 Cleethorpes VS Grimsby Away 
            <br>
            08/07/25 Grimsby Borough VS Grimsby Away 
            <br>
        </p>
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
            <p><a class="other-projects-link" href="other-projects\index.html">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>

</body>
</html>