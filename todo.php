<?php
require_once("includes/validate-logged-in.php");
require_once("includes/layout.php");

echo START;

echo CSS;
echo "<script src='https://kit.fontawesome.com/0f29229e93.js'></script>";
echo "<title>Att göra</title>";

echo BODY;
require_once("content/todo.html");

echo JS;
echo "<script src='js/todo.js'></script>";

echo END;