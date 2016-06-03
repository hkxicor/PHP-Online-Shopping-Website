<?php 
include("./inc/db.php");

		$user = new USER($DB_con);
		$c = new CART($DB_con);
		$idToDelete = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0; 
		if(($user->getId() == $c->cartUser($idToDelete)) AND $idToDelete != 0){
				if($c->deleteProduct($idToDelete)){
					echo "Deleted";
				}
				else{
					echo "Not Deleted Try Again";
				}
		}
		else{
			echo "Something Went Wrong Try Again";
		}  
 ?>