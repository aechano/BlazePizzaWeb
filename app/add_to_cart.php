<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
} 

if(!isset($_POST['order_type']) || !isset($_SESSION['customerID'])){
	return;
}


if($_POST['order_type'] == "1" && isset($_POST['id'])) {
	$product = $conn->prepare("SELECT * FROM `orderitemcart` WHERE productID = ? AND customerID = ?");
	$product->execute([$_POST['id'], $_SESSION['customerID']]);

	if($product->rowCount() > 0) {
	    $sum = $_POST['quantity'];
	    $add_to_cart = $conn->prepare("UPDATE `orderitemcart` SET OICartQty = ? WHERE productID = ? AND customerID = ?");
	    $add_to_cart->execute([$sum, $_POST['id'], $_SESSION['customerID']]);

	    echo "success";
		return;
	}

}

echo "success";
return;

?>