<?php

require_once('../functions.php');

$pos = $_SESSION['position'];

echo json_encode($pos);