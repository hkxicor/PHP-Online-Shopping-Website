<!--Header-->
 <?php include('./inc/header.php'); ?>
 <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
 <script type="text/javascript" >
function show_result(id){
window.location.href = "result.php?id="+id;	
	}
</script>
<script type="text/javascript" >
	$('.box').hover(function(){
		alert("dd");
		$('.caption').slideToggle();
		});
</script>

<?php
	
	$q = isset($_GET['q']) ? $_GET['q']: "";
	$cat = isset($_GET['cat']) ? $_GET['cat']: "all";
	
	//filter 
		$cat = strip_tags($cat);
		$q = strip_tags($q);
		$cat =trim($cat);
		$q = trim($q);
	
	//validate
		$cat = (strlen($cat)<10) ? $cat : "";
		$q = (strlen($q)<50) ? $q : "";
	
		
		//write search script
		include_once './inc/class.search.php';
		$s = new SEARCH($DB_con);
?>

<!--header//-->

<div class="product-model">	 
	 <div class="container">
			<ol class="breadcrumb">
		  <li><a href="index.html">Home</a></li>
		  <li class="active">Search</li>
		  		  <li class="active"><?php echo htmlspecialchars(utf8_encode($cat)); ?></li>

		 </ol>
			<h2>Searching for:<?php echo htmlspecialchars(utf8_encode($q)); ?></h2>			
		
		 <div class="bottom-prdt">																						
			 <div class="btm-grid-sec">
				<?php
					htmlspecialchars($s->printProducts($s->search($q,$cat),$q,$cat));
				?>
			 </div>
		 </div>
		 
						
	</div>
				
			</div>
			
  </div>
  </div>
  </div>
<!--Suscribe Part-->

<!--Footer Part-->
<?php include("./inc/footer.php"); ?>