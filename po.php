<?php include("./inc/header.php"); 
include_once './inc/class.checkout.php';
?>
<?php 
if(!$user->isLogin()) {
	$user->redirect("./index.php");
	}
else{
	$co = new CHECKOUT($DB_con);
	if($co->getCoStep() == 3){
		
		$uid = $user->getId();
		$aId = isset($_POST['aId']) ? strip_tags($_POST['aId']) : 0;
		echo $aId = $user->decryptAddress($aId);
		//now insert into shopduct_db.orders table ...
		//what we need ..
		//user_id ok, order_date ok, address_id ok, products_qty , packet_qty  ,product_cost , delevery_cost
		
		$product_qty = $c->allProductQtyCount();
		$packet_qty = $c->allPacketCount();
		$product_cost = $c->allCartCost();
		$delevery_cost = $c->allCartDeleveryCost();

		if($order_id = $co->createOrder($uid,$aId,$product_qty,$packet_qty,$product_cost,$delevery_cost)){
			//order  created
			//now create diffrent packets ..
			//order_id ,dealer_id ,Packet_total,packet_del,
			
			$allDealers =$c->getAllDealersInCart();
			
			foreach($allDealers as $dealer_id){
				
				$packet_total = $c->getPacketTotal($dealer_id);
				$packet_del = $c->getPacketDel($dealer_id);
				$packet_id = $co->createPacket($order_id,$dealer_id,$packet_total,$packet_del);
					//now insert packet details
					//packet_id
					//product_id
					//current_price
					//qty
					//now to all products associated with this packet
					
					$allProductsInPacket = $c->allProductsInPacket($dealer_id);
					
					for( $i=0; $i<$c->countProductInPacket($dealer_id); $i++){
						 $product_id = $allProductsInPacket[0][$i];
						include_once './inc/class.dealer.php';
						$d = new DEALER($DB_con,(int)$dealer_id);
						$price = $d->productPrice((int)$product_id);
						$qty = $c->countProductQtyInCart((int)$product_id,(int)$dealer_id);
						$co->insertPacketDetails((int)$packet_id,(int)$product_id,(int)$price,$qty);
						
					}
					
				
			}
			
			
		}
		
		//now all order and packt details are inserted .... now cross-check  everything
		//now clear cart ..
		if($c->clearCart()){
			$user->redirect("./index.php");
		}
		
		
		
		
	}
}

?>
