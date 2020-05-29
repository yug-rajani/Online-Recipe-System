<!DOCTYPE html>
<html>
<head>	
	<title>Recipe</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="css2/images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css2/css/util.css">
<link rel="stylesheet" type="text/css" href="css2/css/main.css">
<!--===============================================================================================-->

</head>
<body>
    
     <?php
     
     
     try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=cookie_rookie', 'root', '');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  

        $stmt = $dbhandler->prepare("SELECT * FROM recipe WHERE rid=?");
        $stmt->execute(array($_GET['rid']));
        $r = $stmt->fetch();
        echo'
	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
        
			
                         
                        <img src="req_recipe/'.$r['image'].'" alt="recipe" height="400">
                            

			</div>

                      <form class="contact1-form validate-form" >
				<span class="contact1-form-title">
					'.$r['rname'].'</span>
				


				<div class="wrap-input1 validate-input" data-validate = "Recipe Name is required">
                                    By-<p>'.$r['uemail'].'</p>
					<span class="shadow-input1"></span>
				</div>

        
				<div class="wrap-input1 validate-input" data-validate = "Category Name is required">
                                   Category- <p>'.$r['category'].'</p>
					<span class="shadow-input1"></span>
				</div>

				
 
				

				<div class="wrap-input1 validate-input" data-validate = "Description is required">
                                     Description-   <p>'.$r['description'].'</p>
					<span class="shadow-input1"></span>
				</div>
                                <div class="wrap-input1 validate-input" data-validate = "Ingredients are required one per each line">
					Ingredients-<p>'.$r['ingredients'].'</p>
					<span class="shadow-input1"></span>
				</div>
				<div class="wrap-input1 validate-input" data-validate = "Recipe is required">
				Recipe-	<p>'.$r['recipe'].'</p>
					<span class="shadow-input1"></span>
				</div>
                                                            <button>
						 <a href="index.php">Home</a>
                                                                </button>
							
						
				
				</div>
			</form>
		</div>
	</div>';
        
        
        } catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
     
?>

<!--===============================================================================================-->
<script src="css2/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="css2/vendor/bootstrap/js/popper.js"></script>
<script src="css2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="css2/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="css2/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!-- Global site tag (gtag.js) - Google Analytics -->

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

                       <script>
            // If user clicks anywhere outside of the modal, Modal will close

            
            window.onclick = function (event) {
                if (event.target == modal) {

                    window.location.href = "index.php";
                }
            }

        </script>
<!--===============================================================================================-->
<script src="css2/js/main.js"></script>

</body>
</html>