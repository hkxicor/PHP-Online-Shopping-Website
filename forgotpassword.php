<!--Header-->
 <?php include('./inc/header.php'); ?>
 <?php include('./inc/db.php'); ?>
 <?php 
if($_SESSION['user_login']) {
		echo '<script>window.location.href = "index.php";</script>';
	}
$error=" "; ?>

<!---->	
<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Forgot password</li>
		 </ol>
		 <h2>Forgotpassword</h2>
		 <div class="col-md-6 log">			 
				 <p>Please Provide your email address to recover your password.</p>
				
				 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					 <h5>Email Address</h5>	
					 <input type="text" name="email" value="">
					 
					 					
					 <input type="submit" name="submit" value="Recover Password">	
						
				 </form>
				 
					
		 </div>	
				<?php echo $error; ?>
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<!--Suscribe Part-->
<?php include("./inc/suscribe.php"); ?>
<!--Footer Part-->
<?php include("./inc/footer.php"); ?>