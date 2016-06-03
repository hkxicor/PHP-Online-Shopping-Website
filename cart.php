<?php include('./inc/header.php'); ?>
<?php
	include_once './inc/class.checkout.php';
	$co = new CHECKOUT($DB_con);
	$co->destroyCo();
?>
<script type="text/javascript">
function deleteProduct(id){
			var cart_id = parseInt(id);			
			swal({   title: "Remove Product from Cart ?", 
			text: "Press OK to Remove",   
			type: "info",   
			showCancelButton: true,  
			closeOnConfirm: false,  
			showLoaderOnConfirm: true, }, 
			function(){   
			 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "./deleteProductFormCart.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:{cart_id:cart_id}, //Form variables
			success:function(data){
				//on success, hide  element user wants to delete
				swal(data);
				window.location.reload();

			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				swal(thrownError);
			}
			});
			
			});
			
	
	}
</script>
<script type="text/javascript" >
 function InDecProduct(id,act){
 	jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "InDecProduct.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:{id:id,act:act}, //Form variables
			success:function(data){
				//on success, hide  element user wants to delete.
							swal(data);
							swal(data);
				setTimeout(function(){    window.location.reload();			    }, 1000);
							
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				swal(thrownError);
			}
			});
 	}
</script> 

<!--Header-->


<!-- check out -->
<div class="container">
	<div class="check-sec">	 
		
		<div class="col-md-9 cart-items">
			<h1>My Shopping Bag</h1>
				<?php
					$c->cartProductPrint($user->getId());
				?>
			<?php
				
				if($user->isLogin()){
					include_once './inc/class.csrf.php';
					include_once './inc/class.checkout.php';
					$csrf = new CSRF();
					//generate token id and validate 
					$token_id = $csrf->get_token_id();
					$token_value = $csrf->get_token($token_id);
					$form_names = $csrf->form_names(array('checkout'),false);
					if(isset($_POST[$form_names['checkout']])){
						if($csrf->check_valid('post')){
							$checkout = $_POST[$form_names['checkout']];
							$co = new CHECKOUT($DB_con);
							$co->setCoStep(1);
							$user->redirect("./select_address.php");
						}
						//regenerate new random values for the form.
						$form_names = $csrf->form_names(array('checkout'),true);
					}
				}
			?>
			
			<form method="post" action="#">
			<?php
			if($c->cartCount($user->isLogin(),$user->getId()) != 0) {
				echo '
				<input type="hidden" name="'.$token_id.'" value="'.htmlspecialchars($token_value).'" />
				<input type="submit"  name="'.$form_names['checkout'].'" class="continue" value="Proceed to checkout">
				';
			}
			else{
				echo 'Your Cart is Empyt<br>';
				echo '<a href="./index.php" > Continue Shoping </a>';
			}
			?>
			</form>
			<br>

		
		</div>
	</div>
</div>


<!--Footer Part-->
<?php include("./inc/footer.php"); ?>