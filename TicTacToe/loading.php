<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("../functions.php");

$id = $_SESSION['player']['id'];

//Adds online status i.e. adds user info to 'online' table
db_update('player', ["tic_tac_toe" => 1], "id={$id}");

header("Location: matching.php");

?>