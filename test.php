	<!--Header-->
 <?php include('./inc/header.php'); ?>
 
 <?php 
 /*
			if(!$_GET['u']) {
				
						//echo "dose not set";									
				}		
				else {
							//		echo "set";
					
					}
			$di=$_GET['u'];
		 $q=mysqli_query($GLOBALS["___mysqli_ston"],"select shop_name,shop_address,mob_pri from dealer where dealer_id='$di' ");
		while($row=mysqli_fetch_array($q)) {
		
				$shopname=$row['shop_name'];
				$shopaddress=$row['shop_address'];
				$shop_con=$row['mob_pri'];			
			
			}			*/
		 
  ?>
 		<div class="wall-image">
			<div class="shopname-bold"><img src="./shop.png" alt="" >Shop Name</div>
			<div class="shopaddress-bold"><img src="./location.png" alt="" >Ajmer</div>
			<div class="stars">
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				<img src="./star.png" alt="" >
				(4/5)
				<button>Give Rating</button>
			</div>
			<div class="user-block">
				<button style="background-color:crimson;">Subscribe</button>
				<button>Write Review</button>
				<button>My Purchases</button>
				
				
			</div>
		<!--	<div class="geners">
			<h4>Shop Category</h4>
				<div class="gener-block">
							book shop 
				</div>
				
				<div class="gener-block">
							stationary
				</div>
			</div>  -->
			
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