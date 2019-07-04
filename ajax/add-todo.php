<?php
session_start();

if (!isset($_SESSION['user']) ||
    !isset($_GET['title']) ||
    !isset($_GET['description']))
    die();

require_once("../db/user.php");
$user = new User($_SESSION['user']);

if ($user->add_todo($_GET['title'], $_GET['description']))
    echo 1;

else
    echo 0;