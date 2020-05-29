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

        <title>My Recipes</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <!--
            CSS
        ============================================= -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">					
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/displayrecipes.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>


        <?php
        session_start();

        
        ?>
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.php">
                        </a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="index.php">Home</a></li>
                            <?php
                            if (isset($_SESSION['user'])) {
                               

                                echo'<li><a href="addrecipe.php">Add Recipe</a></li>';
                            }
                          ?>
                            
                            <li><a href="#contact">Contact Us</a></li>
<?php
if (!isset($_SESSION['user'])&& !isset($_SESSION['admin'])) {
    echo'<li><a href="login.php">Login</a></li>';
    echo'<li><a href="register.php">Register</a></li>';
} else {
    echo'<li><a href="">Welcome  <font color="yellow"> '.$_SESSION['uname'].'</font></a></li>';
    echo'<li><a href="logout.php">Log out</a></li>';
}
?>
                        </ul>
                    </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header><!-- #header -->
       
        <section class="top-dish-area section-gap" id="recipes">



<?php
                            if (isset($_SESSION['user'])) {
                               

                           
                         
                    try {
                        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
                        //echo "Connection is established...<br/>";
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                       
//                        $query = $dbhandler->query('select * from user_recipes where email=?');
//                        $query->execute(array($_SESSION['user']));
//                        
                 //       while($id=$query->fetch(PDO::FETCH_ASSOC)){
                            
                       $stmt = $dbhandler->prepare("SELECT * FROM recipe WHERE uemail=?");
        $stmt->execute([$_SESSION['user']]);
        if ($stmt->rowCount()>0) {
         

            echo' <div class="row">';
            while ($r = $stmt->fetch()) {



                echo'   

                                <div class="column">
                               <div class="content">
                              <h2>' . $r['rname'] . '</h2>
                              <img src="req_recipe/' . $r['image'] . '" alt="recipe" height="400" class="rimg">
            <br><br>     <p><h4> ' . $r['description'] . '</h4></p>
        

<button><a href="viewRecipes.php?rid='.$r['rid'].'">View</a></button>   

                            </div>
                            </div>

                                   
                        ';
            }
            echo'</div>';
            
        }else{
            echo"<h1>You Haven't Uploaded Recipe Yet</h1>";
        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        die();
                    }
                            }
                            else{
                                 $_SESSION['error'] = "Login First";

   header('Location: login.php');
                            }
                    ?>							
            
       
 




        </section>
        <!-- End top-dish Area -->


        <!-- start footer Area -->
        <section class="contact-area" id="contact">
            <footer class="footer-area section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                <h4 class="text-white">About Us</h4>
                                <p>
                                    Cookie Roockie is the place you can find best Recipes!
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                <h4 class="text-white">Contact Us</h4>
                                <p>
                                    Cookie Roockie is the place you can find best Recipes!
                                </p>
                                <p class="number">
                                    parthp582000@gmail.com <br>
                                    yug.rajani99@gmail.com<br>
                                    zarmypatel@gmail.com
                                </p>
                            </div>
                        </div>


                        <div class="col-lg-4  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                <h4 class="text-white">Give Feedback</h4>
                                <form class="form-area" id="myForm" class="contact-form text-right">
                                    <input name="uname" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mt-10" required="" type="text">
                                    <input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mt-10" required="" type="email">
                                    <textarea class="common-textarea mt-10" name="feedback" placeholder="feedback" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Feedback'" required=""></textarea>
                                    <button class="primary-btn mt-20" type="submit">Submit<span class="lnr lnr-arrow-right"></span></button>
                                    <div class="mt-10 alert-msg">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>


            </footer>	
        </section>
        <!-- End footer Area -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
