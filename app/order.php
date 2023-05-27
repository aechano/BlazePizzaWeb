<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
} 

if(!isset($_GET['action']) || !isset($_SESSION['customerID'])){
	return;
}

if($_GET['action'] == "remove_order" && isset($_POST['id'])) {

	if($_POST['order_type'] == 1) {
		$product = $conn->prepare("DELETE FROM `orderitemcart` WHERE productID = ? AND customerID = ?");
		$product->execute([$_POST['id'], $_SESSION['customerID']]);
	}
	
	echo "success";
	return;
}


?>