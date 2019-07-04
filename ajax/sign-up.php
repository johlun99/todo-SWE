<?php
if (!isset($_GET['username']) ||
    !isset($_GET['email']) ||
    !isset($_GET['password']))
    die();

require_once("../db/user-handler.php");
$username = $_GET['username'];
$email = $_GET['email'];
$password = $_GET['password'];

$handler = new UserHandler();
if ($handler->sign_up($username, $email, $password)) {
    echo json_encode(1);
} else {
    echo json_encode(0);
}

echo false;