 
 <!--Header-->
 <?php include('./inc/header.php'); ?>
 <!---->
 <script type="text/javascript" >
	function cancel(id){
		
		var k = 'can_but'+id;
	jQuery.ajax({
			type: "POST", 
			url: "ajax/cancel_order.php", //Where to make Ajax calls
			dataType:"text", 
			data:{id:id}, 
			success:function(data){
				
				$(k).hide();
				$('#a').text(data);
				$('body').load(document.URL);
				
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}								
			});	
		
		}
</script>

	
<div class="container">
	  <ol class="breadcrumb" >
		  <li><a href="index.php">Home</a></li>
		  <li class="active">User Account</li>
		  <li class="active">Orders</li>
		 </ol>
	 
		 
			 <h2>Recent<span> Orders</span></h2><br>
			 <!-- [if IE] 
				< link rel='stylesheet' type='text/css' href='ie.css'/>  
			 [endif] -->  
			  
			 <!-- [if lt IE 7]>  
				< link rel='stylesheet' type='text/css' href='ie6.css'/>  
			 <! [endif] -->  
			 
			
			 <!-- Form -->									<?php

		$user_id=$_SESSION['user_login'];
		$query="select id,total,address,o_date from orders where user_id='$user_login' order by  id desc";
		$result=mysqli_query($GLOBALS["___mysqli_ston"],$query);
		while($row=mysqli_fetch_array($result)) {
			
					$order_id=$row['id'];
					$order_total=$row['total'];
					$address=$row['address'];
					$order_date = $row['o_date'];
					echo '<div class="alert alert-info">';
					echo '<h4 style="float:left;padding:10px;"  >Order-id : '.$order_id.'</h4>
					 		<h4 style="float:right;padding:10px;" >Date : '.$order_date.'</h4><br><hr>
					 		<h3 style="padding:10px;" >Address:</h3>
  							<div class="alert alert-success" style="font-size:18px;">'; 
					$query2="SELECT name,addline1,addline2,city,district,pincode,state,landmark,contact from address where id='$address'";
					$result2=mysqli_query($GLOBALS["___mysqli_ston"],$query2);
					while($row2=mysqli_fetch_array($result2)) {
								echo  $row2['name'].'<br> 
  										'.$row2['addline1'].' <br>
  										'.$row2['addline2'].'<br>
  										'.$row2['district'].' '.$row2['pincode'].'<br>
  										'.$row2['state'].'<br>
  										'.$row2['contact'].'<br>
  										</div>';						
						}
				
				echo '<span style="font-size:18px;padding:10px;" >Include Packets:</span>';
			
					$query3="select packet_id,seller_id,packet_total,packet_del,status from packet where order_id='$order_id'";
					$result3=mysqli_query($GLOBALS["___mysqli_ston"],$query3);
					while($row3=mysqli_fetch_array($result3)) {
								
								$packet_id=$row3['packet_id'];
								$seller_id=$row3['seller_id'];
								$packet_status=$row3['status'];
								$packet_total=$row3['packet_total'];
								$packet_del = $row3['packet_del'];
								 	echo '<div class="alert alert-success" >
								<h4 style="float:left;padding:10px;"  >Packet-Id :'.$packet_id.'</h4>';
								//need to get seller name through seller id
								$query4="select shop_name from dealer where dealer_id='$seller_id'";
								$result4=mysqli_query($GLOBALS["___mysqli_ston"],$query4);
								while($row4=mysqli_fetch_array($result4)) {
									$seller_name = $row4['shop_name'];
									echo '<h4 style="float:right;padding:10px;" >Seller : '.$seller_name.'</h4><br><hr>'; 
										}
								//now get all the products which are associated with this packet id;
								echo '<h4 style="padding:10px;">Packet Status</h4><hr>';
								bar($packet_status);
								if($packet_status==1 or $packet_status==2 ) {
									
										echo '<div id="a"><button class="label label-danger" style="padding:10px;margin:5px;" id=can_but'.$packet_id.' onclick="cancel('.$packet_id.')" > Cancel Order </button></div>';									
									
									}
								$query5="select product_id,price,qty,s from packet_desc where packet_id='$packet_id'";
								$result5=mysqli_query($GLOBALS["___mysqli_ston"],$query5);
								
								while($row5=mysqli_fetch_array($result5)) {
													
													$product_id=$row5['product_id'];
													$price = $row5['price'];
													$qty=$row5['qty'];
													$s=$row5['s'];
													
													//now print all the products
													echo '<br><div class="packet-item-wrap"><h4 style="padding:10px;">Products</h4><hr><br>';
																										
													echo display($product_id,$price,$qty,$s);
																										
													echo '</div>';									
									}
									echo '<div class="alert alert-warning" style="text-align:right;">
									<h4 style="padding:10px;"  >Delevery Charge:'.$packet_del.'₹</h4>
									<h4 style="padding:10px;"  >Packet Total:'.$packet_total.'₹ </h4>
									<h4 style="padding:10px;">Total Payable Amount '.($packet_del+$packet_total).'₹</h4>									
									<br></div>';
								
								
								echo '</div>';
								
							  
								
								
			
						}	
							echo		 '	
	<h1 style="padding:20px" >Order Total:'.$order_total.'₹</h1>
	
	';
								
			 	echo '<br></div></div>'; 
			 	
								
			 }
			
?>
	
				<!-- /Form -->
			 
		 </div>
		 
		 
		 

<?php include("./inc/suscribe.php"); ?>
<!--Footer Part-->
<?php include("./inc/footer.php"); ?>
<?php
		function getimage($id) {
			$table = 'cs';
			if($id>1000 && $id < 2000) {$table='cs';}
			elseif($id>2000 && $id < 3000) {$table='ec';}
			elseif($id>3000 && $id < 4000) {$table='ee';}
			elseif($id>4000 && $id < 5000) {$table='eic';}
			elseif($id>5000 && $id < 6000) {$table='civil';}
			elseif($id>6000 && $id < 7000) {$table='mech';}
					$l=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT name from $table where book_id='$id'				
					");
					while($t=mysqli_fetch_array($l)) {
								
						$path="photo/".$t['name'];
						return $path;								
						
						}	}
 		function display($id,$price,$qty,$s){
 			if($s==1) {
					$st="NEW"; 				
 				}
 				else {
					$st="OLD"; 					
 					}
 					$table = 'cs';
			if($id>1000 && $id < 2000) {$table='cs';}
			elseif($id>2000 && $id < 3000) {$table='ec';}
			elseif($id>3000 && $id < 4000) {$table='ee';}
			elseif($id>4000 && $id < 5000) {$table='eic';}
			elseif($id>5000 && $id < 6000) {$table='civil';}
			elseif($id>6000 && $id < 7000) {$table='mech';}

					$q="select book_name,auther,publication,edition from $table where book_id='$id'";
					$r=mysqli_query($GLOBALS["___mysqli_ston"],$q);
					while($r=mysqli_fetch_array($r)) {
							$n=$r['book_name'];
							$a=$r['auther'];
							$p=$r['publication'];
							$e=$r['edition'];						

						} 					
 					
				return '<div class="well" style="color:black;">		
				 <img src="'.getimage($id).'" alt="" style="width:100px;height:140px;padding:10px;" >
													<h4>'.$n.'</h4>
													<h4>'.$a.'</h4>
													<h4>'.$p.'</h4>
													<h4>'.$e.' edition</h4>
													<h4>Condition:'.$st.'</h4>
													<h4 class="well">Price:'.$price.'X'.$qty.' = '.$price*$qty.'₹</h4>
												</div>';
			}
			
function bar($st) {
	
	if($st==0) {
		$text = "Cenceled";			
			
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 0%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 0%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 100%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';	
	
		}
		elseif($st==1) {
					$text = "Waiting";
					
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 10%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 25%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==2) {
					$text = "Approved";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 25%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 0%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==3) {
					$text = "Packed";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 50%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 0%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==4) {
					$text = "Delevered";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 100%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 0%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==5) {
					$text = "Refused";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 50%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 25%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 25%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==6) {
					$text = "Address not found";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 50%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 50%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			elseif($st==7) {
					$text = "Dose not Delevered";
					
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 50%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 0%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 50%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
			}
			else {
					$text = "Unknown";
						
						
	echo '
 <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 0%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 100%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 0%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>	
	';
				}
									
		echo '<h3 class="well" >Current Status:'.$text.'</h3>';	
		
//	echo '<img id="imgx" src="./img/bar/'.$st.'.gif" style="width:250px;height:50px;" >';	
	}
		
?>