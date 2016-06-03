<?php include_once './inc/db.php'; ?>
<?php
		if( isset($_POST['product_id']) AND isset($_POST['dealer_id']) ){
		$user = new USER($DB_con);
		$c = new CART($DB_con);
		if(!($user->isLogin())){
			echo "You have to login to add to cart this Product";
			return false;
		}
		else{
			//filter
			$pid = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
			$did = isset($_POST['dealer_id']) ? (int)$_POST['dealer_id'] : 0;
			
			if($c->countProductPresentInCart($pid,$did) == 0){
				if($c->addToCart($pid,$did)){
				echo "Successfully added to Cart";
				
				}
				else{
				echo "Something Went";
				}
			}else{
				
				$act = 1;
				if($c->cartProductQtyModify(($c->getCartId($user->getId(),$pid,$did)),$act)){
					echo "Alredy in Cart ...";
					echo "Item Qty Incremented";
				}
				else{
				echo "Something Went";
				}
			}
		}
		}else{
			echo "Something Went Wrong";
		}
	
?>