<?php
if (!isset($_GET['username']) ||
    !isset($_GET['password']))
    die();

require_once("../db/user-handler.php");
$handler = new UserHandler();

$id = $handler->login_validation($_GET['username'], $_GET['password']);

if (!$id)
    echo 0;

else {
    require_once("../db/user.php");

    session_start();

    $_SESSION['user'] = $id;

    /*
    $user = new User($id, $_GET['username']);
    $_SESSION['user'] = serialize($user);
*/
    echo 1;
}