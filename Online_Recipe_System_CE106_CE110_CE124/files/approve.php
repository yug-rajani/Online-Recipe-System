<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {

    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
   //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbhandler->prepare("Select * from requested_recipe where rid=?");
    $query->execute(array($_GET['rid']));
    $r = $query->fetch();
    $query = $dbhandler->prepare("INSERT INTO recipe(rname,category,uemail,ingredients,recipe,description,image) VALUES (?,?,?,?,?,?,?)");
    $query->execute(array($r['rname'], $r['category'],$r['uemail'], $r['ingredients'], $r['recipe'], $r['description'],$r['image']));
    echo ''.$dbhandler->lastInsertId();
        
    $query = $dbhandler->prepare("Delete from requested_recipe where rid=?");
    $query->execute(array($_GET['rid']));
     header('Location:viewRequestedRecipe.php');
}catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
?>