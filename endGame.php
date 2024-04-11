<?php

require_once("functions.php");

db_update('player', ['checkers' => 0, 'gameId' => 0, 'player' => 0], "id = {$_SESSION['player']['id']}");
db_update('player', ['checkers' => 0, 'gameId' => 0, 'player' => 0], "id = {$_SESSION['opponent']['id']}");

$_SESSION['opponent'] = null;

header("Location: homepage.php");