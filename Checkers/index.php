<?php
require_once("../functions.php");
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
    <!-- Checker class -->
    <script src="./scripts/Checker.js"></script>
    <!-- Tile class -->
    <script src="./scripts/Tile.js"></script>
    <!-- Board class -->
    <script src="./scripts/Board.js"></script>
    <!-- Draw Manager class -->
    <script src="./scripts/DrawManager.js"></script>
    <!-- Game Manager class -->
    <script src="./scripts/GameManager.js"></script>
    <!-- AI class -->
    <script src="./scripts/AI.js"></script>
    <!-- Button Controller -->
    <script src="./scripts/ButtonController.js"></script>
    <!-- Message class -->
    <script src="./scripts/Message.js"></script>
    <!-- Logger class -->
    <script src="./scripts/Logger.js"></script>
    <!-- Main script -->
    <script src="./scripts/index.js"></script>
    <!-- opponent update script -->
    <script src="./scripts/opponent.js"></script>
</head>

<body>
    <div class="column">
        <div id="menu">
            <h3>Game ID: <?= $_SESSION['player']['gameId'] ?></h3>
            <h1>Moves</h1>
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