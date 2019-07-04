<?php
session_start();
if (!isset($_SESSION['user']))
    die();

require_once("../db/user.php");
$user = new User($_SESSION['user']);

try {
    $data = $user->get_todo_list();

    echo json_encode($data);
} catch (PDOException $pdo) {
    echo $pdo->getMessage();
}