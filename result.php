<!--Header-->
 <?php include('./inc/header.php'); ?>
 <?php
	//get the product id and (filter+validate)
	if(!isset($_GET['id']) OR $_GET['id'] == '0000000000'){
		$user->redirect('./index.php');
	}
	$pid=$_GET['id'];
	$pid = (strlen($pid)==10) ? $pid : 0;
	$pid= (int)$pid;
	//create product object
	$product = new PRODUCT($DB_con,$pid);
	if(!($product->isValid())){
		$user->redirect('./index.php');
	}
	
 ?>
 <script type="text/javascript" >
	 function addToCart(product_id,dealer_id){
					var did = parseInt(dealer_id);
					var pid = parseInt(product_id)
					
					swal({   title: "Add to Cart?", 
						text: "", 
						type: "info",  
						showCancelButton: true,  
						confirmButtonColor: "green", 
						confirmButtonText: "Yes, add it!", 
						cancelButtonText: "No",  
						closeOnConfirm: false,  
						closeOnCancel: false }, 
						function(isConfirm){  
						if (isConfirm) {    
							$.ajax({
					type:"POST",
					url:"addToCart.php",
					data:{action:'call_this',product_id:pid,dealer_id:did},
					success:function(html){
							swal(html,"","");
							setTimeout(function(){    window.location.reload();			    }, 1000);
					}
					
				});
						
						} 
						else { 
						swal("Cancelled", "Not added to Cart", "");   } });
					
					
			
		}
</script>

<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!--header//-->
<div class="productd" style="margin-top:-0px;">
	 <div class="container">				
		 <div class="product-price1">
			 <div class="top-sing">
				  <div class="col-md-7 single-top">	
					 <div class="flexslider">
							  <ul class="slides">
								<li data-thumb="" >
									<div class="fix2 thumb-image"> <img  src="<?php echo $product->getImage(); ?>" style="width:100%;height:100%;"  data-imagezoom="true" class="fix2 img-responsive" alt=""/> </div>
								</li>
							  </ul>
							  
						</div>
<tbody>
	<h1 style="font-size:20px;">Product Details</h1><br>
	</tbody>
		<?php 
			$product->displayProuductDetails();
		?>						
					 <script src="js/imagezoom.js"></script>
						<script defer src="js/jquery.flexslider.js"></script>
						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
						</script>

				 </div>	
			     <div class="col-md-5 single-top-in simpleCart_shelfItem">
					  <div class="single-para" style="zoom:.8;">
						 <h4><?php echo $product->getName(); ?></h4>							
							<h5 class="item_price" style="color:red;font-size:25px;">MRP:<span style="text-decoration:line-through;"><?php echo $product->getMrp(); ?></span>&#8377</h1></h5>							
							<h4>Cash on Delivery eligible</h4>
							<h4 style="color:grey;font-size:20px;">in stock<h4>
							<hr>
								<h4 style="color:grey;font-size:20px;">Product Will Be Delevered Within Ajmer City only.<h4>
								<hr>
								<h4 style="color:grey;font-size:20px;">Fulfilled By: ShopDuct.<h4><br>
							<div class="prdt-info-grid">
								 <ul>
								
								 </ul>
							</div>
							  
							<table  class="table table-bordered" style="font-size:20px;;padding:5px;"> 
	<tbody>
	<h1 style="font-size:20px;">Sellers near you Selling this Product</h1><br>
	</tbody>
	
	<thead><tr><th>Seller</th><th>Price</th><th>Add to Cart</th></tr></thead>
	<?php
			$product->displayDealers();
			
	?>
	
	</table>
	
						
					</div>
					</div>
				</div> 
				 
				  </div>				  
	     </div>
	</div>
	
	</div>

	
	
	
	    

		 <div class="bottom-prdt">
		 <h4>Similer Products </h4>
			 <div class="btm-grid-sec">
				 <div class="col-md-2 btm-grid">
					 <a href="product.html">
						<img src="images/p3.jpg" alt=""/>
						<h4>Product#1</h4>
						<span>$1200</span></a>
				 </div>
				 <div class="col-md-2 btm-grid">
					 <a href="product.html">
						<img src="images/p10.jpg" alt=""/>
						<h4>Product#1</h4>
						<span>$700</span></a>
				 </div>
				 <div class="col-md-2 btm-grid">
					  <a href="product.html">
						<img src="images/p5.jpg" alt=""/>
						<h4>Product#1</h4>
						<span>$1300</span></a>
				 </div>
				 <div class="col-md-2 btm-grid">
					  <a href="product.html">
						<img src="images/p4.jpg" alt=""/>
						<h4>Product#1</h4>
						<span>$9000</span></a>
				 </div>
				 <div class="col-md-2 btm-grid">
					  <a href="product.html">
						<img src="images/p2.jpg" alt=""/>
						<h4>Product#1</h4>
						<span>$450</span></a>
				 </div>
				  <div class="clearfix"></div>
			 </div>			
		 </div>
<!--Footer Part-->
<?php include("./inc/footer.php"); ?>
