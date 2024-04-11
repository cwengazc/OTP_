<?php

require_once("functions.php");

$username=trim($_POST['username']);
$password=trim($_POST['password']);

if (login_user($username, $password)) {
    header("Location: homepage.php");
} else {
    header("Location: login.html");
}