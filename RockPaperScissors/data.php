<?php

include ("functions.php");

$username = $_SESSION['player']['username'];
header('Content-Type: application/json');
echo json_encode($username);

