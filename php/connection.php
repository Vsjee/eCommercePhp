<?php 
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'store';

    $connection = mysqli_connect($hostname, $username, $password, $database);

    if(!$connection) {
        echo "Not connected";
    } else {
        echo `<script>console.log("connected")</script>`;
    }
?>