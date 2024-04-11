<?php

require_once("functions.php");

if(isset($_GET['piece'])) {
    $piece = $_GET['piece'];
    $id = $_SESSION['player']['id'];
    db_update('player', ['pieceIndex' => $piece], "id = {$id}");
}