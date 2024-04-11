<?php

require_once("functions.php");

if(isset($_GET['turn'])) {
    $turn = $_GET['turn'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['turn' => $turn], "id = {$id}");

    $id = $_SESSION['opponent']['id'];
    db_update('player', ['turn' => $turn], "id = {$id}");
}