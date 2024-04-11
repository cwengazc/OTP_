<?php

require_once("functions.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$username = trim($_POST['username']);
$confirm = trim($_POST['confirm']);

$sql = "SELECT * FROM player WHERE email = '{$email}'";
$res = $conn->query($sql);

if ($password != $confirm) {
    header("Location: index.html");
    die();
}

if ($res->num_rows != 0) {
    header("Location: index.html");
    die();
}

$password = password_hash($password,PASSWORD_DEFAULT);

$sql = "INSERT INTO player (
    username,
    email,
    password
) VALUES (
    '{$username}',
    '{$email}',
    '{$password}'
)";

if($conn->query($sql)) {
    header("Location: login.html");
} else {
    header("Location: index.html");
}
die();
?>
