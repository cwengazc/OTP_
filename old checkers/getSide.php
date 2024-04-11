<?php

require_once('functions.php');

$id = $_SESSION['player']['id'];

global $conn;

$sql = "SELECT * FROM player WHERE id = {$id}"; 

$result = mysqli_query($conn, $sql);

$side = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($side);