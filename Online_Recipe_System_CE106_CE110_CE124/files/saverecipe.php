<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    session_start();
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
    echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $uemail = $_SESSION['user'];
    $rname = $_POST['rname'];
    $category = $_POST['category'];
    
    $ingredients = $_POST['ingredients'];
    $recipe = $_POST['recipe'];
    $description = $_POST['description'];
    if(isset($_SESSION['aname'])){
        echo 'admin\n';
         $query = $dbhandler->prepare("INSERT INTO recipe(rname,category,uemail,ingredients,recipe,description) VALUES (?,?,?,?,?,?)");
         $query->execute(array($rname, $category, $uemail, $ingredients, $recipe, $description));
    }else{
        echo 'user\n';
    $query = $dbhandler->prepare("INSERT INTO requested_recipe(rname,category,uemail,ingredients,recipe,description) VALUES (?,?,?,?,?,?)");
    $query->execute(array($rname, $category, $uemail, $ingredients, $recipe, $description));
    }
    $count = $query->rowcount();
    echo $dbhandler->lastInsertId();

    // echo 'check1';
    if (!empty($_FILES["upl"]["name"])) {
//echo 'check2';
        $target_location = "req_recipe/" . basename($_FILES["upl"]["name"]);

        if (!(move_uploaded_file($_FILES["upl"]["tmp_name"], $target_location)))
            echo "Error: " . $_FILES["upl"]["error"] . "<br>";
        else {
           echo basename($target_location); 
            $ext = pathinfo($target_location, PATHINFO_EXTENSION);
            echo ($ext);

            $new = "req_recipe/" . $dbhandler->lastInsertId().".".$ext;
            $n=$dbhandler->lastInsertId().".".$ext;
           echo $new;
            rename($target_location, $new);
            if(isset($_SESSION['aname'])){
        echo 'admin\n';
          $query = $dbhandler->prepare("UPDATE recipe SET image=? where rid=?");
    }else{
        echo 'user\n';
    $query = $dbhandler->prepare("UPDATE requested_recipe SET image=? where rid=?");
    }
          
            $query->execute(array($n,$dbhandler->lastInsertId()));
        }

        echo'Success';
            header('Location:index.php');
    } else {
        echo'Invalid Data Entered';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
?>