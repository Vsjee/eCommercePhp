<?php
include_once '../../php/connection.php';

session_start();

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$PasswordConfirm = $_POST['PasswordConfirm'];

$query = "SELECT U_NAME ,U_EMAIL, U_PASSWORD FROM users WHERE U_EMAIL = '$Email'LIMIT 1";
$query_user = mysqli_query($connection, $query);

if (mysqli_num_rows($query_user) > 0) {
  echo '<script>
  alert("User already exist");
  window.history.go(-1);
</script>';
} else {
  if ($Password === $PasswordConfirm) {
    $all = "SELECT U_NAME ,U_EMAIL, U_PASSWORD FROM users";
    $all_query = mysqli_query($connection, $all);

    $createUser = "INSERT INTO `users`(`U_ID`, `U_NAME`, `U_EMAIL`, `U_PASSWORD`, `P_TYPE`) VALUES (null,'$Name','$Email','$Password', 'user')";
    $res = mysqli_query($connection, $createUser);

    header("Location: ../login/login.php", true);
    die();
  } else {
    echo '<script>
    alert("Error incorrect password");
    window.history.go(-1);
  </script>';
  }
}

mysqli_close($connection);
