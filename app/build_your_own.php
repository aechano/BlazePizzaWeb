<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
}

$ingredients['dough'] = isset($_POST['dough']) ? $_POST['dough'] : "";
$ingredients['sauce'] = isset($_POST['sauce']) ? $_POST['sauce'] : "";  
$ingredients['cheese'] = isset($_POST['cheese']) ? $_POST['cheese'] : ""; 
$ingredients['meat'] = isset($_POST['meat']) ? $_POST['meat'] : "";
$ingredients['veggies'] = isset($_POST['veggies']) ? $_POST['veggies'] : "";
$ingredients['finishes'] = isset($_POST['finishes']) ? $_POST['finishes'] : "";

if(!isset($_SESSION['customerID'])){
	echo json_encode(
		array("hasError" => true, "message" => "Please register or login!")
	);
	return;
}

if(!isset($_GET['action']) || !isset($_GET['order_type'])){
	echo json_encode(
		array("hasError" => true, "message" => "Something went wrong!")
	);
	return;
}

if($_GET['action'] == "add_to_cart" && isset($_POST['id'])) {

	if($_GET['order_type'] == 1) {

		if(!isset($_POST['dough']) && !isset($_POST['sauce']) && !isset($_POST['cheese']) && !isset($_POST['meat']) && !isset($_POST['veggies']) && !isset($_POST['finishes'])) {
			echo json_encode(
				array("hasError" => true, "message" => "Please select ingredients!")
			);
			return;
		}

		$result = checkCartItemsIfExisting();
		if(is_bool($result) && !$result) {
			saveCartItems();
			saveIngredients();
		} else {
			updateCartItems($result);
		}

		echo json_encode(
			array("hasError" => false, "message" => "Added to cart!")
		);

	}

}

function checkCartItemsIfExisting(){

	global $conn, $ingredients;

	$orderitemcart = $conn->prepare("SELECT * FROM `orderitemcart` WHERE productID = ? AND customerID = ?");
    $orderitemcart->execute([$_POST['id'], $_SESSION['customerID']]);

    if($orderitemcart->rowCount() > 0) {
    	while($fetch_cart = $orderitemcart->fetch(PDO::FETCH_ASSOC)) {

    		$ingredients_itemcart = $conn->prepare("SELECT * FROM `orderingredientscart` WHERE OICartID = ?");
	    	$ingredients_itemcart->execute([$fetch_cart['OICartID']]);

	    	if($ingredients_itemcart->rowCount() > 0) {
	    		while($fetch_ingredients = $ingredients_itemcart->fetch(PDO::FETCH_ASSOC)) {

	    			if($fetch_ingredients['OICDough'] == $ingredients['dough'] && $fetch_ingredients['OICSauce'] == $ingredients['sauce']
						&& $fetch_ingredients['OICCheese'] == $ingredients['cheese'] && $fetch_ingredients['OICMeat'] == $ingredients['meat']
						&& $fetch_ingredients['OICVeggies'] == $ingredients['veggies'] && $fetch_ingredients['OICFinishes'] == $ingredients['finishes']) {
	    				
	    				$total = $fetch_cart['OICartQty'] + $_POST['quantity'];
	    				$result['OICartID'] = $fetch_cart['OICartID'];
	    				$result['total'] = $total;
	    				return $result;
	    			} 

	    		}

	    	}

    	}

    } 
    	
    return false;

}

function saveCartItems() {

	global $conn;

	$add_to_cart = $conn->prepare("
			INSERT INTO `orderitemcart`(
				productID, 
				customerID, 
				OICartQty) 
			VALUES(?,?,?)");

 	$add_to_cart->execute([
 		$_POST['id'],
 		$_SESSION['customerID'], 
 		$_POST['quantity']
	]);
	
}

function updateCartItems($result) {

	global $conn;

    $update_cart = $conn->prepare("
    	UPDATE `orderitemcart` 
    	SET OICartQty = ? WHERE OICartID = ? AND productID = ? AND customerID = ?");
    $a = $update_cart->execute([$result['total'], $result['OICartID'], $_POST['id'], $_SESSION['customerID']]);
   
}

function saveIngredients() {

	global $conn, $ingredients;

 	$add_ingredients = $conn->prepare("
 		INSERT INTO `orderingredientscart`(
 		`OICartID`, 
 		`OICDough`, 
 		`OICSauce`, 
 		`OICCheese`, 
 		`OICMeat`, 
 		`OICVeggies`, 
 		`OICFinishes`, 
 		`customerID`) 
 		VALUES (?,?,?,?,?,?,?,?)");

  	$add_ingredients->execute([
  		$conn->lastInsertId(), 
  		$ingredients['dough'], 
  		$ingredients['sauce'], 
  		$ingredients['cheese'], 
  		$ingredients['meat'], 
  		$ingredients['veggies'], 
  		$ingredients['finishes'],
  		$_SESSION['customerID']
  	]);

}

?>