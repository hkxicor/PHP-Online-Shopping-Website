 
 <!--Header-->
 <?php include('./inc/header.php'); ?>
 <script type="text/javascript" >
	function delete_add(id){
		jQuery.ajax({
			type: "POST", 
			url: "ajax/delete_address.php", //Where to make Ajax calls
			dataType:"text", 
			data:{id:id}, 
			success:function(data){
				alert(data);
				window.location.reload();
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}								
			});			
		}
</script>
<div id="page_thumb" align="center">
<?php
		if(!($user->isLogin())){
			$user->redirect("./index.php");
		}
?>

<!---->
	
<div class="container">
	  <ol class="breadcrumb" >
		  <li><a href="index.php">Home</a></li>
		  <li class="active">User Account</li>
		  <li class="active">Saved Address</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2> Saved Address <span>  </span></h2>
			 <!-- [if IE] 
				< link rel='stylesheet' type='text/css' href='ie.css'/>  
			 [endif] -->  
			  
			 <!-- [if lt IE 7]>  
				< link rel='stylesheet' type='text/css' href='ie6.css'/>  
			 <! [endif] -->  
			 
			 <div class="registration_form">
			    <!-- Form -->
					<div class="cart-item-thumb" style="height:auto;">
						<p><?php $user->displayAddress();?>	</p>
					</div>
				<!-- /Form -->
			 </div>
		 </div>
		 
		 <div class="clearfix"></div>
	 </div>
</div>

<?php include("./inc/suscribe.php"); ?>
<!--Footer Part-->
<?php include("./inc/footer.php"); ?>