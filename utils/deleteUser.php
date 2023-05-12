<?php
include '../php/connection.php';

$currUserId = $_POST['UserId'];

$query = "DELETE FROM `users` WHERE U_ID = '$currUserId'";
mysqli_query($connection, $query);

header('location: ../pages/private/userProfile.php');

mysqli_close($connection);
