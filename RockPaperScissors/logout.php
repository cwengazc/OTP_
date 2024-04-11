<?php

require_once("functions.php");

db_update('player', ['rockpaperscissors' => 0, 'gameId' => 0], "id = {$_SESSION['player']['id']}");
db_update('player', ['rockpaperscissors' => 0, 'gameId' => 0], "id = {$_SESSION['opponent']['id']}");

$_SESSION['opponent'] = null;

header("Location: ../homepage.php");