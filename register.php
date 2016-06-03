 <!--Header-->
 <?php include('./inc/header.php'); ?>
  <?php 
		
	if($user->isLogin()){
	//	$user->redirect("./index.php");
	}
	include_once './inc/class.csrf.php';
?>
<?php

$csrf = new CSRF();

//generate token id and validate 

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

//generate random form names

$form_names = $csrf->form_names(array('fname','lname','email','password','mnumber'),false);

	if(isset($_POST[$form_names['fname']]) && isset($_POST[$form_names['lname']]) && isset($_POST[$form_names['email']]) && isset($_POST[$form_names['password']]) && isset($_POST[$form_names['mnumber']])) {	    
		echo "dd";
		//check if token id and token values are valid.
		if($csrf->check_valid('post')){
		//get from variable names
				
				
				
			$fname = $_POST[$form_names['fname']];
			$lname = $_POST[$form_names['lname']];
			$email = $_POST[$form_names['email']];
			$password = $_POST[$form_names['password']];
			$mnumber = $_POST[$form_names['mnumber']];
			
			//form start
			
			//filter
			$password = strip_tags($password);
			$fname = strip_tags($fname);
			$lname = strip_tags($lname);
			$email = strip_tags($email);
			$email = preg_replace('#[^A-Za-z0-9@._]#i', '', $email); // filter everything but numbers,letters ,@, . and _
			$mobile = strip_tags($mnumber);
			
			//validate 
			if(strlen($mobile)!=10) {
				die("Mobile Number is not valid!!!<br><a href='register.php'>Back</a>");	 
			}
			else {					
				if(strlen($password)<6) {
					die("Password is too short.<br>Atlest 6 words.<br><a href='register.php'>Back</a>");
					$error = "Password is Too Short";	
				}
				else {
					if($user->register($email,$password,$mobile,$fname,$lname)){
						die("Successfully Registered ....");
					}
					else{
						die("Not Registered Try Again....");
					}
				}		
			}
			//form end
		}
		//regenerate new random values for the form.
		$form_names = $csrf->form_names(array('email','password'),true);
	}
  ?>
<!---->	
<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Register</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>new user? <span> create an account </span></h2>
			 <!-- [if IE] 
				< link rel='stylesheet' type='text/css' href='ie.css'/>  
			 [endif] -->  
			  
			 <!-- [if lt IE 7]>  
				< link rel='stylesheet' type='text/css' href='ie6.css'/>  
			 <! [endif] -->  
			 <script>
				(function() {
			
				// Create input element for testing
				var inputs = document.createElement('input');
				
				// Create the supports object
				var supports = {};
				
				supports.autofocus   = 'autofocus' in inputs;
				supports.required    = 'required' in inputs;
				supports.placeholder = 'placeholder' in inputs;
			
				// Fallback for autofocus attribute
				if(!supports.autofocus) {
					
				}
				
				// Fallback for required attribute
				if(!supports.required) {
					
				}
			
				// Fallback for placeholder attribute
				if(!supports.placeholder) {
					
				}
				
				// Change text inside send button on submit
				var send = document.getElementById('register-submit');
				if(send) {
					send.onclick = function () {
						this.innerHTML = '...Sending';
					}
				}
			
			 })();
			 </script>
			 <div class="registration_form">
			 <!-- Form -->
				<form action="#" method="POST">
				<input type="hidden" name="<?php echo $token_id ?>" value="<?php echo htmlspecialchars($token_value); ?>" />
					<div>
						<label>
							<input placeholder="first name" name="<?php echo $form_names['fname']; ?>" type="text"  required="required">
						</label>
					</div>
					<div>
						<label>
							<input placeholder="last name" name="<?php echo $form_names['lname']; ?>" type="text" tabindex="2" required="required">
						</label>
					</div>
					<div>
						<label>
							<input placeholder="email address" name="<?php echo $form_names['email']; ?>" type="email" tabindex="3" required="required">
						</label>
					</div>
					<div>
						<label>
							<input placeholder="Mobile" name="<?php echo $form_names['mnumber']; ?>" type="text"  tabindex="3" required="required">
						</label>
					</div>					
										
					<div>
						<label>
							<input placeholder="password" name="<?php echo $form_names['password']; ?>" type="password" tabindex="4" required="required">
						</label>
					</div>						
						
					<div>
						<input type="submit" name="submit" value="create an account" id="register-submit">
					</div>
				</form>
				<!-- /Form -->
			 </div>
		 </div>
		 
		 <div class="clearfix"></div>
	 </div>
</div>


<!--Footer Part-->
<?php include("./inc/footer.php"); ?>