 <!--Header-->
 <?php include('./inc/header.php'); ?>
 
<?php
	if(!$user->isLogin()){
		$user->redirect("./index.php");
	}
	include_once './inc/class.csrf.php';
?>

<?php
//get the data
$error=" ";



$csrf = new CSRF();

//generate token id and validate 

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

//generate random form names

$form_names = $csrf->form_names(array('fname','lname'),false);
if(isset($_POST[$form_names['fname']],$_POST[$form_names['lname']])){
	//check if token id and token values are valid.
	if($csrf->check_valid('post')){
		$fname = $_POST[$form_names['fname']];
		$lname = $_POST[$form_names['lname']];
		//form action 
		
			//filter
			$fname = (isset($fname)) ? trim(strip_tags($fname)) : $my_fname;
			$lname = (isset($lname)) ? trim(strip_tags($lname)) : $my_lname;
				
				if($fname == "" OR $lname == ""){
					$error = "Problem with input ... try again";
				}
				else{
					if($_POST['save_change']){
					$user->updateDetails($fname,$lname);
					}
				}
		//form end
	}
	//regenerate new random values for the form.
	$form_names = $csrf->form_names(array('fname','lname'),true);
}
$my_fname = $user->getName();
$my_lname = $user->getLName();

	/*
	$submit=$_POST['save_change'];
	
	if($submit) {
				if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['mobile']) ) {
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						$mobile=$_POST['mobile'];
						
						//make sure that mobile no. is unique and of 10 digits 
						
						if( strlen($mobile)==10  ) {
							
							if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"],"SELECT user_id from users mobile='$mobile'")) > 0) {
										
										$error="Mobile number alredy registered";				
								}
								else {
									
															$result2=mysqli_query($GLOBALS["___mysqli_ston"],"update users set fname='$fname' , lname='$lname' , mobile='$mobile'  where user_id='$user_login' ");
						if($result2) {
								$error="Changes Saved";							
							}					
							else {
																$error="Error...Try Again";
								}			
							
									
									
									}
							}
							
							
							else {$error="Mobile number should be atleast 10 digit ";}
						
					}
				else {$error="All Entries Should Be filled";}		
		}
		*/
?>
<!---->	
<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">User Account</li>
		  <li class="active">Edit Profile</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2> User Account <span>  </span></h2>
			 <!-- [if IE] 
				< link rel='stylesheet' type='text/css' href='ie.css'/>  
			 [endif] -->  
			  
			 <!-- [if lt IE 7]>  
				< link rel='stylesheet' type='text/css' href='ie6.css'/>  
			 <! [endif] -->  
			 
			 <div class="registration_form">
			 <!-- Form -->
				<?php echo htmlspecialchars($error); ?>
				<form method="POST" action="#">
<input type="hidden" name="<?php echo $token_id ?>" value="<?php echo htmlspecialchars($token_value); ?>" />
 <span>First Name</span><input type="text" name="<?php echo $form_names['fname']; ?>"  required="required" placeholder="<?php echo htmlspecialchars($my_fname); ?>" />
 <br>
 <span>Last Name  </span><input type="text" name="<?php echo $form_names['lname']; ?>"  required="required" placeholder="<?php echo htmlspecialchars($my_lname); ?>" >
 <br>
 
	<input type="submit" name="save_change"  value="Save Changes"  >
</form>

				<!-- /Form -->
			 </div>
		 </div>
		 
		 <div class="clearfix"></div>
	 </div>
</div>


<!--Footer Part-->
<?php include("./inc/footer.php"); ?>