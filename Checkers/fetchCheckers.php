<?php

require_once('../functions.php');

$gameId = $_SESSION['player']['gameId'];

global $conn;

$sql = "SELECT * FROM checkers WHERE gameId = {$gameId}"; 

$result = mysqli_query($conn, $sql);

$side = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($side);