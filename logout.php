<?php error_reporting(E_ERROR|E_PARSE); ?>
<?php 
include("./inc/connection.php");
session_start();
session_destroy();
if (session_status() == PHP_SESSION_ACTIVE) {
	echo "Something Went Wrong Please Try Again";
}
else{

	header("location:./index.php");
}

?>