<?php 
    // $host = "localhost";
    // $dbusername = "root";
    // $dbpassword = "";
    // $dbname = "server-tng";

    // $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname) or die("Connect failed: %s\n". $conn -> error);
    // mysqli_set_charset($conn, 'UTF8');

?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $host = "localhost";
    $dbusername = "phong.nguyen";
    $dbpassword = "1234567890";
    $dbname = "servertng";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


