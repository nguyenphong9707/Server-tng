<?php 
 include 'db.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 // Load Composer's autoloader
 require 'vendor/autoload.php';
?>

 <?php 
    $tz = 'Asia/Bangkok';
    $tz_obj = new DateTimeZone($tz);
    $today = new DateTime("now", $tz_obj);
    $hours_today = $today->format('H:i');
    $today=$today->format('Y-m-d');
    $sql = "SELECT * FROM `user`";
    $result1 = mysqli_query($conn ,$sql);
    $Data_Info = array();
    while ($rows1 = mysqli_fetch_array($result1)) {
        $name = $rows1['id'];
        $email = $rows1['email']; 
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
    if($hours_today > '17:30' && $hours_today < '18:00'){

    foreach ($User as $key => $value) {
        $findchecksql = "SELECT * FROM `checkfingerprint` WHERE `id_user`= $value[0] AND `date`= '$today' AND `time`<'17:40:00' AND `time`>'13:00:00'";
        $findcheck = mysqli_query($conn ,$findchecksql);
        $row = $findcheck->num_rows;
        $Namesql = "SELECT `name` FROM `user` WHERE `id`= $value[0]";
        $Name = mysqli_query($conn ,$Namesql);
        $issend = '';
        $issendsql = "SELECT * FROM `issend` WHERE `id_user`= $value[0] AND `daysend`= '$today' ";
        $issend = mysqli_query($conn ,$issendsql);
        $rowsend = $issend->num_rows;
        if($row == 0 && $rowsend == 0){
            $Inissendsql = "INSERT INTO `issend`(`id_user`, `daysend`) VALUES ($value[0], '$today')";
            $Inissend = mysqli_query($conn ,$Inissendsql);
            $mail = new PHPMailer(true);
            try {
                //Server settings
                    $mail -> SMTPDebug = 3;
                    $mail -> isSMTP();
                    $mail -> Host = 'smtp.gmail.com';
                    $mail -> Port = 587;
                    $mail -> SMTPSecure = 'tls';
                    $mail -> SMTPAuth = true;
                    $mail -> Username = 'server.thenewgym@gmail.com';
                    $mail -> Password = 'Thenewgym@123';                                  // TCP port to connect to

                //Recipients
                $mail->setFrom('server.thenewgym@gmail.com', 'IT System');
                $mail->addAddress($value[1]); 

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = '[TNG-IT] - Fingerprint';
        while ($rows1 = mysqli_fetch_array($Name)) {
                $name = $rows1['name'];
                $mail->Body    = 'Dear <b>'.$name.'</b>, <br><br>&emsp;
                                    Hôm nay chúng tôi chưa ghi nhận được vân tay checkout của bạn trên hệ thống. 
                                    Hãy bấm vân tay ngay để tránh bị mất ngày công nhé !<br><br>Many thanks.';
    }
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
    echo 'Done !';
 ?>
