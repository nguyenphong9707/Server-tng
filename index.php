
<?php
    include 'db.php';
?>
<?php 

$sql = "SELECT * FROM `user`";
$result1 = mysqli_query($conn ,$sql);
$Data_Info = array();
while ($rows1 = mysqli_fetch_array($result1)) {
    $name = $rows1['Name'];
    $email = $rows1['Email']; 
    array_push($Data_Info, $name, $email);

}
$User = array();
for ($i = 0; $i < count($Data_Info); $i++) {
    $a=array();
    if($i % 2 == 0){
        array_push($a, $Data_Info[$i], $Data_Info[$i+1]);
        array_push($User, $a);
    };
  }
    // echo $name;
    print_r($User);
?>


    <!-- // function sendGmail() {
    //     var date = new Date();
    //     var Hours = date.getHours();
    //     var Minutes = date.getMinutes();
    //     if(Hours == 14 && Minutes == 20){
    //         console.log('Đã send gmail')
    //     }
    // }
 
    // setInterval(sendGmail,2000); -->
