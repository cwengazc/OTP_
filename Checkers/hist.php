<?php
require_once("../functions.php");
$_SESSION['player']['gameId'] = $_GET['gameId'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Checkers</title>
    <link rel="shortcut icon" type="image/png" href="./images/favicon.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="./styles/main.css" />
    <!-- Library used for displaying emojis -->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    
    <!-- history script -->
    <script src="./scripts/hist.js"></script>
</head>

<body>
    <div class="column">
        <div id="menu">
            <h3>Game ID: <?= $_SESSION['player']['gameId'] ?></h3>
            <h1>Moves</h1>
            <div class="buttons">
                <button onclick="Prev()">Previous</button>
                <button onclick="Next()">Next</button>
            </div>
            <div id="log"></div>
            <p>&#60insert cool group name&#47&#62, all rigths reserved © 2023</p>
        </div>
    </div>
    <div id="board">
        <div class="tiles"></div>
    </div>
    <div class="endGame"><a href="../endGame.php">End Game</a></div>
</body>

</html>