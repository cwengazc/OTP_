<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("../functions.php");

$id = $_SESSION['player']['id'];

db_update('player', ["checkers" => 1], "id={$id}");

header("Location: matching.php");

?>