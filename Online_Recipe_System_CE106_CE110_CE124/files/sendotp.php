<?php
require_once('PHPMailer/PHPMailerAutoload.php');
session_start();
$mail = new PHPMailer(true);
$_SESSION["usemailforotp"]=$_POST['email'];
$text = rand(10000,99999); 
$_SESSION['otp'] = $text; 
try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cookierookierecipes@gmail.com';                     // SMTP username
    $mail->Password   = 'Pyzadmin123';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = '465';                                    // TCP port to connect to

  $mail->setFrom('cookierookierecipes@gmail.com', 'Admin');
    $mail->addAddress($_SESSION["usemailforotp"]);     // Add a recipient
     

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Password For Account of Cookie Rookie';
    $mail->Body    = 'One Time Password for Change Password for an Cookie Rookie Account-<br> <b>'.$_SESSION["otp"].'</b>';
    $mail->AltBody = 'One Time Password for Change Password for an Cookie Rookie Account- '.$_SESSION["otp"].'';

    $mail->send();
    
    echo 'Message has been sent';
    header('Location: takeotp.php');
} catch (Exception $e) {
    $_SESSION['error']="Message could not be sent. Mailer Error";
    header('Location: login.php');
}
?>
