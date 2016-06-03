<!--Header-->
 <?php include('./inc/header.php'); ?>

 <?php 
		
	if($user->isLogin()){
		$user->redirect("./index.php");
	}
	include_once './inc/class.csrf.php';
?>

<?php		

$csrf = new CSRF();

//generate token id and validate 

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

//generate random form names

$form_names = $csrf->form_names(array('email','password'),false);

if(isset($_POST[$form_names['email']],$_POST[$form_names['password']])){
	//check if token id and token values are valid.
	if($csrf->check_valid('post')){
		//get from variable names
		$email = $_POST[$form_names['email']];
		$password = $_POST[$form_names['password']];
		
		//form function start
		$email=strip_tags($email);
		$email = preg_replace('#[^A-Za-z0-9@._]#i', '',$email); // filter everything but numbers,letters ,@, . and _
		$password = strip_tags($password);
		$password = trim($password);
		if($user->login($email,$password)){
			$user->redirect("./index.php");
		}
		else{
			die("Something Went Worng .... Try Again.");		
		}
		//form function start
	}
	//regenerate new random values for the form.
	$form_names = $csrf->form_names(array('email','password'),true);
}


?>

<!---->	
<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Login</li>
		 </ol>
		 <h2>Login</h2>
		 <div class="col-md-6 log">			 
				 <p>Welcome, please enter the folling to continue.</p>
				
				 <form action="#" method="POST">
				 <input type="hidden" name="<?php echo $token_id ?>" value="<?php echo htmlspecialchars($token_value); ?>" />
					 <h5>Email Address</h5>	
					 <input type="text" name="<?php echo $form_names['email']; ?>" >
					 <h5>Password</h5>
					 <input type="password" name="<?php echo $form_names['password']; ?>" >	
					
					 <input type="submit" name="submit" value="Login">	
						<a class="acount-btn" href="register.php">Create an Account</a>
				 </form>
				 <a href="./forgotpassword.php">Forgot Password ?</a>
					
		 </div>	
				
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<!--Suscribe Part-->

<!--Footer Part-->
<?php include("./inc/footer.php"); ?>