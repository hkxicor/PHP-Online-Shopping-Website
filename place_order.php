<!--Header-->
 <?php include('./inc/header.php'); ?> 
<!---->	
<?php

$aId = isset($_GET['aId']) ? trim(strip_tags($_GET['aId'])) : 0;
include_once './inc/class.checkout.php';
include_once './inc/class.product.php';
$co = new CHECKOUT($DB_con);
$flag = false;


if($co->getCoStep() != 2 OR !isset($_GET['aId']) ){
	$co->destroyCo();
	$user->redirect("./index.php");
}
else{
	$flag = true;
	$co->setCoStep(3);
}

?>

<!-- -->
<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="cart.php">Cart</a></li>
		  <li><a href="select_address.php">Select Address</a></li>
		  <li>Payment(Cash On Delevery : Default)</li>
		  <li>Place Order</li>
		 </ol>
		 <h2>Place Order</h2>
					<?php $co->printVirtualBill($flag,$aId); ?>
		 <div class="clearfix"></div>
	 </div>
</div>
<!--Footer Part-->
<?php include("./inc/footer.php"); ?>