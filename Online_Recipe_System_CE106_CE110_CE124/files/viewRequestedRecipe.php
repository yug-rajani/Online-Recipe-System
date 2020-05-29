<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="zxx" class="no-js">
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Author Meta -->
        <meta name="author" content="parth">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->

        <title>Requested Recipes</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <!--
            CSS
        ============================================= -->
    
        <link rel="stylesheet" href="css/bootstrap.css">
       
        <link rel="stylesheet" href="css/main.css">
        
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        

        <?php
        session_start();
            
        if (!isset( $_SESSION['aname'])) {
                $_SESSION['error'] = "Login First";
                 header('Location: login.php');
        }
        ?>
        <div class="topnav">
            <a class="active">Logged in as Admin</a>                       
<a href="addrecipe.php">Add Recipe</a>
 
            <a href="viewfeedback.php">View Feedback</a>
            <button class="open-button" onclick="openForm()">Add Category</button>

        
           <a href="logout.php" class="logout">Log out</a>
</div>
        
<div class="form-popup" id="myForm">
    <form action="savecategory.php" class="form-container" method="post">
    

        <label><h2>ADD CATEGORY</h2></label>
        <input type="text" placeholder="Enter Category Name" name="category" required>
    <button type="submit" class="btn">Add</button>
<!--<input type="submit">-->
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
        <div class="datas">

        <div class="row">
            <?php
            try {
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
                //echo "Connection is established...<br/>";
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $query = $dbhandler->query('select * from requested_recipe');
                $count = $query->rowcount();
                if ($count == 0) {
                    echo '<h1><font color="red">NO REQUESTED RECIPES</font></h1>';
                } else {
                    while ($r = $query->fetch()) {



                        echo'   

                                <div class="column">
                               <div class="content">
                              <h3>' . $r['rid'] . '-' . $r['rname'] . '</h3><br>
                              <img src="req_recipe/' . $r['image'] . '" alt="recipe" class="rimg">
                                
                   <h3>By</h3>           <p>' . $r['uemail'] . '</p>
                              
              <h3>Category</h3>        <p> ' . $r['category'] . '</p>
                
                 <h3>Description</h3>       <p> ' . $r['description'] . '</p>
         <h3>Ingredients</h3>   <p>' . $r['ingredients'] . '</p>
           <h3>Recipe</h3>     <p>' . $r['recipe'] . '</p>
               

<a href="approve.php?rid=' . $r['rid'] . '" class="genric-btn success-border circle">Approve</a>
                                                <a href="delete_req_recipe.php?rid=' . $r['rid'] . '" class="genric-btn primary-border circle">Reject</a>



                            </div>
                            </div>

                                   
                        ';
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            ?>	
        </div> 



       </div>
        <script src="js/popup.js"></script>
        <script src="js/vendor/jquery-2.2.4.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>			
        <script src="js/easing.min.js"></script>			
        <script src="js/hoverIntent.js"></script>
        <script src="js/superfish.min.js"></script>	
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>	
        <script src="js/owl.carousel.min.js"></script>			
        <script src="js/jquery.sticky.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>			
        <script src="js/parallax.min.js"></script>	
        <script src="js/mail-script.js"></script>	
        <script src="js/main.js"></script>	
    </body>
</html>
