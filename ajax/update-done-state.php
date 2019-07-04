<?php
session_start();
if (!isset($_SESSION['user']) ||
    !isset($_GET['todo_id']))
    die();

require_once("../db/user.php");
$user = new User($_SESSION['user']);

if ($user->update_done_state($_GET['todo_id']))
    echo json_encode(true);

else
    echo json_encode(false);