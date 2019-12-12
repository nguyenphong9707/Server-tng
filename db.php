<?php 
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "server-tng";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname) or die("Connect failed: %s\n". $conn -> error);
    mysqli_set_charset($conn, 'UTF8');
?>