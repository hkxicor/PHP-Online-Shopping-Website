	<!--Header-->
 <?php include('./inc/header.php'); 
 $did = isset($_GET['did']) ? (int)trim(strip_tags($_GET['did'])):0;
 $d = new DEALER($DB_con,$did);
 $true = ($d->getId()==0)? 0 : 1;
 if($true == 0){
	 $user->redirect("./index.php");
 }
 
 ?>
	
 <?php 
		
  ?>
 		<div class="wall-image">
			<div class="shopname-bold"><img src="./shop.png" alt="" ><?php echo htmlspecialchars($d->getShopname()); ?></div>
			<div class="shopaddress-bold"><img src="./location.png" alt="" ><?php echo  htmlspecialchars($d->getShopCity()); ?></div>
			<div class="stars">
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				(4/5)
				<button>Give Rating</button>
			</div>
			<div class="user-block">
				
					<?php
						if($d->isSuscribed($user->getId())){
							echo '<button style="background-color:green;">Suscribed</button>';
							echo '<button style="background-color:yellow;">Unsuscribe</button>';
						}
						else{
							echo '<button style="background-color:crimson;">Suscribe</button>';
						}
					?>
				<button>Write Review</button>
				<button>My Purchases</button>
				
				
			</div>
			
			
		</div>
		<div class="search-in-shop">
			<input type="text" placeholder="Search for any Product in this Shop" />
			<button>Search</button>
			<button style="float:right;">All Products</button>
		</div>
		
		<div class="items">

	 <div class="container">
	 <img  style="width:50px;" src="./img/special.png" alt="" > <h4 class="top" >Speacial Offers</h4>
	 <hr>
					<div class="offer-list">		 
		   <ul>
					<li>Buy Worth Rupees 500 and get 50% off *(Maximum Discount 250) </li>
					
					
		  	 </ul>
		   	</div>
	 </div>
	 
	 
	  <div class="container">
	 <img  style="width:50px;" src="./img/new.png" alt="" > <h4 class="top" >New Products</h4>
	 <hr>
					<div class="offer-list">		 
		   <ul>
					
		  	 </ul>
		   	</div>
	 </div>
</div>

		
<!---->
<!--Suscribe Part-->

<!--Footer Part-->
<?php include("./inc/footer.php"); ?>