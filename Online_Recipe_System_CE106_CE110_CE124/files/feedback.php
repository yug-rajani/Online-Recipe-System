<?php

try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['uname'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    if (!empty($email) && !empty($feedback)) {
        $query = $dbhandler->prepare("INSERT INTO feedback (uname,uemail,feedback) VALUES (?,?,?)");
        $query->execute(array($username, $email, $feedback));

        $count = $query->rowcount();
        //   echo'feedback submitted successfully';
        if ($count>0) {
            echo 'The feedback has been sent.';
        } else {
            echo 'failed';
        }
    } else {


        //echo"Username or feedback can't be empty...";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
?>


