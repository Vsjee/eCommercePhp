<?php
include_once '../../php/connection.php';


$Email = $_POST['Email'];
$Password = $_POST['Password'];

$query = "SELECT U_NAME, U_EMAIL, U_PASSWORD FROM users WHERE U_EMAIL = '$Email' AND U_PASSWORD = '$Password' LIMIT 1";
$query_user = mysqli_query($connection, $query);

if (mysqli_num_rows($query_user) > 0) {
  $user = mysqli_fetch_array($query_user);
  $U_NAME = $user['U_NAME'];
  $U_EMAIL = $user['U_EMAIL'];
  $U_PASSWORD = $user['U_PASSWORD'];

  if ($U_EMAIL === $Email && $U_PASSWORD === $Password) {
    session_start();

    $_SESSION["user"] = $U_NAME;

    header("Location: ../../pages/private/userProfile.php");
  } else {
    echo "Email or password error, try again.";
  }
} else {
  echo '<script>
    alert("Email or password error, try again.");
    window.history.go(-1);
  </script>';
}

mysqli_close($connection);
