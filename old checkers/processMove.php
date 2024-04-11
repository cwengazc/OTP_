<?php

require_once("functions.php");

if(isset($_GET['move'])) {
    $move = $_GET['move'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['move' => $move], "id = {$id}");
}