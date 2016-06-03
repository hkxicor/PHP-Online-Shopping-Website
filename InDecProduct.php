<?php

	if(isset($_POST['id']) AND isset($_POST['act']) ){
	include('./inc/db.php');
	$user = new USER($DB_con);
	$c = new CART($DB_con);
	$id=$_POST['id'];
	$act=$_POST['act'];
	$id = isset($_POST['id']) ? (int)$_POST['id'] : 0; 
	$act = ($act == 1 OR $act == 2) ? (int)$act : 0;
	
	if(($user->getId() == $c->cartUser($id)) OR $act != 0 OR $id != 0){
		
		if( ($c->cartProductQty($id) == 1) AND ($act == 2) ){
				echo "cannot decrement product qty ....";
		}
		else{
	
			if($c->cartProductQtyModify($id,$act)){
				if($act==1){
					echo "Incremented";
				}
				else{
					echo "Decremented";
				}
			}
			else{
				echo "Something Went Wrong";
			}
		}
	}
	else{
		echo "Error ... Try Again";
	}
	}else{
		die("Something Went Wrong");
	}
?>