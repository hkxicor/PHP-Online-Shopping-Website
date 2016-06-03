<!--Header-->
 <?php include('./inc/header.php'); ?>
 
 <?php 
include_once './inc/class.csrf.php';
include_once './inc/class.checkout.php';
if(!($user->isLogin())) {
		$user->redirect("./index.php");
	}

$co = new CHECKOUT($DB_con);
$csrf = new CSRF();
	if($co->getCoStep() != 1){
		$co->destroyCo();
		$user->redirect('./index.php');
	}
//generate token id and validate 

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

//generate random form names

$form_names = $csrf->form_names(array('name','addline1','addline2','city','state','pincode','landmark','contact'),false);

if(isset($_POST[$form_names['name']]) && isset($_POST[$form_names['addline1']]) && isset($_POST[$form_names['addline2']]) && isset($_POST[$form_names['city']]) && isset($_POST[$form_names['city']]) && isset($_POST[$form_names['state']])  ) {
	
	if($csrf->check_valid('post')){
		
		$name = $_POST[$form_names['name']];
		$addline1 = $_POST[$form_names['addline1']];
		$addline2 = $_POST[$form_names['addline2']];
		$city = $_POST[$form_names['city']];
		$state = $_POST[$form_names['state']];
		$pincode = $_POST[$form_names['pincode']];
		$landmark = isset($_POST[$form_names['pincode']]) ? $_POST[$form_names['pincode']] : "Not Mentioned";
		$contact = isset($_POST[$form_names['contact']]) ? $_POST[$form_names['contact']] : "Not Mentioned";
		
		//form start
		
		//filter the variables
					$name = strip_tags($name);
					$addline1 = strip_tags($addline1);
					$addline2 = strip_tags($addline2);
					$city = strip_tags($city);
					$pincode = strip_tags($pincode);
					$state= strip_tags($state);
					$landmark = strip_tags($landmark);
					$contact = strip_tags( $contact);
					if($user->addAddress($name,$addline1,$addline2,$city,$pincode,$state,$landmark,$contact)){
					$user->redirect("./select_address.php");	
				}
				else{
					die("something wend wrong try again");
				}
		//form end
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
		  <li><a href="cart.php">Cart</a></li>
		  <li><a href="select_address.php">Select Address</a></li>
		  <li class="active">Add New Address</li>
		 </ol>
		 <h2>Add New Address</h2>
		 <div class="col-md-6 log">			 
				 <p>Please Enter Valid Information for better Services.</p>
				
				 <form action="#" method="POST">
					 <h5>Email Address</h5>	
						<input type="hidden" name="<?php echo $token_id ?>" value="<?php echo htmlspecialchars($token_value); ?>" />
						<input type="text" name="<?php echo $form_names['name']; ?>" placeholder="Receiver Name" required="required" /><br>
						<input type="text"  name="<?php echo $form_names['addline1']; ?>" placeholder="Addressline 1" required="required" /><br>
						<input type="text"  name="<?php echo $form_names['addline2']; ?>" placeholder="Addressline 2"  /><br>
						<input type="text"  name="<?php echo $form_names['city']; ?>" placeholder="City" readonly="readonly" value="Ajmer" required="required" /><br>
						<input type="text"  name="<?php echo $form_names['pincode']; ?>" placeholder="Pincode" readonly="readonly" value="305001" required="required" /><br>
						<input type="text"  name="<?php echo $form_names['state']; ?>" placeholder="State" readonly="readonly" value="Rajasthan" required="required" /><br>
						<input type="text"  name="<?php echo $form_names['landmark']; ?>" placeholder="Landmark" /><br/>
						<input type="text"  name="<?php echo $form_names['contact']; ?>" placeholder="contact" required="required" /><br>					 
						<input type="submit" name="submit" value="Save">	
				 </form>
				
					
		 </div>	
				
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<!--Suscribe Part-->

<!--Footer Part-->
<?php include("./inc/footer.php"); ?>