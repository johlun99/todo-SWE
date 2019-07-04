<?php

require_once("includes/layout.php");
echo START;

echo CSS;
echo "<title>Todo - sign up</title>";

echo BODY;
require_once("content/sign-up.html");

echo JS;
echo "<script src='js/sign-up.js'></script>";

echo END;