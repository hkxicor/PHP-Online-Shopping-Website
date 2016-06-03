<!--Header-->
<?php include('./inc/header.php'); ?> 
<?php
include_once './inc/class.checkout.php';
$co = new CHECKOUT($DB_con);
if($co->getCoStep() != 1 ){
	$co->destroyCo();
	$user->redirect("./index.php");
}
else{
	include_once './inc/class.csrf.php';
	$csrf = new CSRF();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);
	//generate random form names

	$form_names = $csrf->form_names(array('address','next'),false);	
	if(isset($_POST[$form_names['address']],$_POST[$form_names['next']])){
		if($csrf->check_valid('post')){
			$address = $_POST[$form_names['address']];
			$address = trim(strip_tags($address));
			$co->setCoStep(2);
			$address = password_hash($address,PASSWORD_DEFAULT);
			$redirect = "place_order.php?aId=".$address;
			$user->redirect($redirect);
		}
	}
}			
?>

<!---->	
<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		 <li><a href="index.php">Home</a></li>
		  <li><a href="cart.php">Cart</a></li>
		  <li class="active">Select Address</li>
		 </ol>
		 <h2>Select Delevery Address</h2>
		 <div class="col-md-6 log">			 
				 <p>Select Address of Delevery and Payment</p>
<?php

?>
<form action="#" method="POST">
	<?php $user->displayAddress2($form_names['address']); ?>
	<input type="hidden" name="<?php echo $token_id ?>" value="<?php echo htmlspecialchars($token_value); ?>" />
	<input type="submit"  name="<?php echo $form_names['next']; ?>" class="cs-button" align="middle" value="Delever to this Address"  ><br>
</form>
<a href="./addnew_address.php"><br><br><input type="button"  value="Add New Address" /> </a>

					
		 </div>	
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<!--Suscribe Part-->

<!--Footer Part-->
<?php include("./inc/footer.php"); ?>