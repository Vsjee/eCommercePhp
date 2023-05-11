<?php
include '../../../php/connection.php';

// get user message through ajax
$getMessage = mysqli_real_escape_string($connection, $_POST['message']);

//checking message available
$checkData = "SELECT replies FROM autochat WHERE queries LIKE '%$getMessage%'";
$runQuery = mysqli_query($connection, $checkData) or die("Query error");

// matching message
if (mysqli_num_rows($runQuery) > 0) {

  //fetch replay 
  $fetchData = mysqli_fetch_assoc($runQuery);

  //store replay to a varible which we'll send to ajax
  $reply = $fetchData['replies'];

  echo $reply;
} else {
  echo 'Lo siento, no entendi, intenta de nuevo escribiendo "Ayuda" =D';
}
