<?php

require_once("functions.php");

if(isset($_GET['w_prev'])) {
    $w_prev = $_GET['w_prev'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['w_prev' => $w_prev], "id = {$id}");

    $id = $_SESSION['opponent']['id'];
    db_update('player', ['w_prev' => $w_prev], "id = {$id}");
}

if(isset($_GET['b_prev'])) {
    $b_prev = $_GET['b_prev'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['b_prev' => $b_prev], "id = {$id}");

    $id = $_SESSION['opponent']['id'];
    db_update('player', ['b_prev' => $b_prev], "id = {$id}");
}