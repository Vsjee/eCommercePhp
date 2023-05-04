<?php
session_start();

session_destroy();

echo 'You are not logged in. <a href="./login/login.php">Click here</a> to log in.';
