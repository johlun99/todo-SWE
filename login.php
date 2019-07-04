<?php
session_start();
session_unset();
require_once("includes/layout.php");

echo START;

echo CSS;
echo "<title>Todo - login</title>";

echo BODY;
require_once("content/login.html");

echo JS;
echo "<script src='js/login.js'></script>";

echo END;