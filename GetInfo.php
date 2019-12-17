<?php
include 'db.php';

$id_user = $_GET["id"];
$date = $_GET["date"];
$time = $_GET["time"];
$datetime = $date.' '.$time;
$a = strval($datetime);
$date = strtotime($date);
$date = date('Y-m-d',$date);
try {
    $sql = "INSERT INTO `checkfingerprint`(`id_user`, `date`, `time`) VALUES ('$id_user','$date','$time')";
    echo $sql;
    $result1 = mysqli_query($conn ,$sql);
    echo $date.' '.$time;

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?> 