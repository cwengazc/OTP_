<?php

require_once("../functions.php");

db_update('player', ['tic_tac_toe' => 0, 'gameIdTTT' => 0], "id = {$_SESSION['player']['id']}");
db_update('player', ['tic_tac_toe' => 0, 'gameIdTTT' => 0], "id = {$_SESSION['opponent']['id']}");

include 'connection.php';

$sql = "DELETE FROM ".$dbname.".`gamesessions` WHERE pl1id=".$_SESSION['player']['id'];
$conn->query($sql);
$sql = "DELETE FROM ".$dbname.".`gamesessions` WHERE pl2id=".$_SESSION['player']['id'];
$conn->query($sql);


$_SESSION['opponent'] = null;

header("Location: ../homepage.php");