<?php

require_once("functions.php");

if(isset($_GET['ul'])) {
    $piece = $_GET['ul'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['upLeft' => $piece], "id = {$id}");
}

if(isset($_GET['ur'])) {
    $piece = $_GET['ur'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['upRight' => $piece], "id = {$id}");
}

if(isset($_GET['dl'])) {
    $piece = $_GET['dl'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['downLeft' => $piece], "id = {$id}");
}

if(isset($_GET['dr'])) {
    $piece = $_GET['dr'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['downRight' => $piece], "id = {$id}");
}

if(isset($_GET['at'])) {
    $piece = $_GET['at'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['attack' => $piece], "id = {$id}");
}