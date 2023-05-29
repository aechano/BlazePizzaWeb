<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
} 

$sub_total = 0;
$total = 0;
$tax = 0.05;
$total_tax = 0;
$shipping = 0;


if(!isset($_GET['action']) || !isset($_SESSION['customerID'])){
	echo json_encode(
		array("hasError" => true, "message" => "Something went wrong!")
	);
}

//remove item
if($_GET['action'] == "remove_order" && isset($_POST['id'])) {

	if($_POST['order_type'] == 1) {
		$product = $conn->prepare("DELETE FROM `orderitemcart` WHERE productID = ? AND customerID = ?");
		$product->execute([$_POST['id'], $_SESSION['customerID']]);
	}
	
	echo json_encode(
		array("hasError" => false, "message" => "Success!")
	);
	return;
}

if($_GET['action'] == "order") {

	if($_POST['order_type'] == 1) {

		$cart = $conn->prepare("SELECT * FROM `orderitemcart` WHERE customerID = ?");
		$cart->execute([$_SESSION['customerID']]);
		
		if($cart->rowCount() > 0) {

			while($fetch_orders = $cart->fetch(PDO::FETCH_ASSOC)){    
            	$product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
				$product->execute([$fetch_orders['productID']]);

				if($product->rowCount() > 0) {
					while($fetch_product = $product->fetch(PDO::FETCH_ASSOC)){
						$sub_total = $sub_total + ($fetch_orders['OICartQty'] * $fetch_product['productPrice']);
					}
				}

        	}

        	$total_tax = $sub_total * $tax;
        	$total = ($sub_total + $total_tax + $shipping);
        	$promo = validatePromo($sub_total);

        	if(!$promo) {
        		echo json_encode(
        			array("hasError" => true, "message" => "Does not meet minimum spend!")
        		);
        		return;
        	} 

        	$promo_value = !is_bool($promo) ? $promo['rewards'] : 0;
        	$promo_code = !is_bool($promo) ? $promo['promoCode'] : "";

         	$total = $total - $promo_value;
         	$result = saveOrder($_POST['order_type'], $promo_code, $total, $_POST['payment_option']);
         	echo json_encode($result);
			return;

		}

	} else {

		$product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
		$product->execute([$_POST['id']]);

		if($product->rowCount() > 0) {
			while($fetch_product = $product->fetch(PDO::FETCH_ASSOC)){
				$sub_total = $sub_total + ($_POST['quantity'] * $fetch_product['productPrice']);
			}
		}

		$total_tax = $sub_total * $tax;
    	$total = ($sub_total + $total_tax + $shipping);
    	$promo = validatePromo($sub_total);

    	if(!$promo) {
    		echo json_encode(
    			array("hasError" => true, "message" => "Does not meet minimum spend!")
    		);
    		return;
    	} 

    	$promo_value = !is_bool($promo) ? $promo['rewards'] : 0;
    	$promo_code = !is_bool($promo) ? $promo['promoCode'] : "";

     	$total = $total - $promo_value;
     	$result = saveOrder($_POST['order_type'], $promo_code, $total, $_POST['payment_option']);
     	echo json_encode($result);
		return;

	}

	echo json_encode(
		array("hasError" => false, "message" => "Success")
	);

	return;
}

if($_GET['action'] == "received") {

	if(isset($_POST['order_id'])) {

		$order_info = $conn->prepare("SELECT * FROM `order` WHERE customerID = ? AND orderID = ?");
        $order_info->execute([$_SESSION['customerID'], $_POST["order_id"]]);

       
     	if($order_info->rowCount() > 0) {

     		$fetch_order = $order_info->fetch(PDO::FETCH_ASSOC);

     		if ($fetch_order['paymentType'] == "Blaze Pizza e-Wallet" && $fetch_order['paymentStatus'] == "PAID") {
     			$update_order = $conn->prepare("UPDATE `order` SET orderStatus = ?  WHERE orderID = ?");
	        	$a = $update_order->execute(["COMPLETED", $_POST['order_id']]);

	        	echo json_encode(
					array("hasError" => false, "message" => "Success")
				);

				return;
     		}

     	} 

	}

	echo json_encode(
		array("hasError" => false, "message" => "Success")
	);

	return;
}


function validatePromo($sub_total) {

	global $conn;

	if(isset($_POST['promo_code']) && $_POST['promo_code'] != "") {
		$promo = $conn->prepare("SELECT * FROM `promos` WHERE promoCode = ?");
		$promo->execute([$_POST['promo_code']]);

		while ($fetch_promo = $promo->fetch(PDO::FETCH_ASSOC)) {
			if($sub_total >= $fetch_promo['minPrice']) {
				return $fetch_promo;
			} else {
				return false;
			}
		}

	} else {
		return true;
	}
}

function saveOrder($order_type, $promo_code, $total, $payment_type) {

	global $conn;
	$order_id = round(microtime(true));
	$order_date = date('Y-m-d H:i:s');

	if($order_type == 1) {

		$cart = $conn->prepare("SELECT * FROM `orderitemcart` WHERE customerID = ?");
		$cart->execute([$_SESSION['customerID']]);

		if($cart->rowCount() > 0) {

			$payment_status = "PENDING";
			if($payment_type == "Blaze Pizza e-Wallet") {
				$balance = validateBalance();
				if($balance >= $total) {
					$payment_status = "PAID";
				} else {
					return array("hasError" => true, "message" => "Wallet balance not enough!");
				}
			}

			//save order details
			$saveOrder = $conn->prepare("INSERT INTO `order`(`orderID`, `customerID`, `promoCode`, `orderAmount`, `orderStatus`, `paymentType`, `paymentStatus`, `orderDate`) VALUES(?,?,?,?,?,?,?,?)");
			$result = $saveOrder->execute([$order_id, $_SESSION['customerID'], $promo_code, $total, "ONGOING", $payment_type, $payment_status, $order_date]);	
			//save order items
			if($result) {
				while ($fetch_cart = $cart->fetch(PDO::FETCH_ASSOC)) {
					saveOrderItem($fetch_cart, $order_id, $order_type);
				}
			}

			//delete cart item since already ordered
			$deleteCart = $conn->prepare("DELETE FROM orderitemcart WHERE customerID = ?");
			$deleteCart->execute([$_SESSION['customerID']]);

			updatePromoCodes($promo_code);
			updateWalletBalance($total);

			return array("hasError" => false, "message" => $order_id);

		}

	} else {

		$payment_status = "PENDING";
		if($payment_type == "Blaze Pizza e-Wallet") {
			$balance = validateBalance();
			if($balance >= $total) {
				$payment_status = "PAID";
			} else {
				return array("hasError" => true, "message" => "Wallet balance not enough!");
			}
		}

		$saveOrder = $conn->prepare("INSERT INTO `order`(`orderID`, `customerID`, `promoCode`, `orderAmount`, `orderStatus`, `paymentType`, `paymentStatus`, `orderDate`) VALUES(?,?,?,?,?,?,?,?)");
		$result = $saveOrder->execute([$order_id, $_SESSION['customerID'], $promo_code, $total, "ONGOING", $payment_type, $payment_status, $order_date]);	
		
		//save order items
		if($result) {
			$fetch_cart['productID'] = $_POST['id'];
			$fetch_cart['OICartQty'] = $_POST['quantity'];
			saveOrderItem($fetch_cart, $order_id, $order_type);
		}

		updatePromoCodes($promo_code);
		updateWalletBalance($total);

		return array("hasError" => false, "message" => $order_id);

	}

}


function saveOrderItem($fetch_cart, $order_id, $order_type) {

	global $conn;

	$orderItem = $conn->prepare("INSERT INTO `orderitem`(`productID`, `orderID`, `orderItemQty`) VALUES (?, ?, ?)");
	$orderItem->execute([$fetch_cart['productID'], $order_id, $fetch_cart['OICartQty']]);
	
}

function updatePromoCodes($promo_code) {

	global $conn;

	$promo = $conn->prepare("SELECT * FROM `promos` WHERE promoCode = ?");
	$promo->execute([$promo_code]);
	$availability = 0;

	if($promo->rowCount() > 0) {
		$fetch_promo = $promo->fetch(PDO::FETCH_ASSOC);
		$availability =  $fetch_promo['availability'];

		$orderItem = $conn->prepare("UPDATE `promos` SET `availability`= ? WHERE promoCode = ?");
		$orderItem->execute([$fetch_promo['availability'] - 1, $promo_code]);
	}

}


function validateBalance() {

	global $conn;

	$ewallet = $conn->prepare("SELECT * FROM `ewallet` WHERE customerID = ? and eWalletStatus = 'Activated'");
	$ewallet->execute([$_SESSION['customerID']]);

	if($ewallet->rowCount() > 0) {
		$fetch_balance = $ewallet->fetch(PDO::FETCH_ASSOC);
		return $fetch_balance['balance'];
	}

	return 0;
}


function updateWalletBalance($total) {

	global $conn;

	$ewallet = $conn->prepare("SELECT * FROM `ewallet` WHERE customerID = ? and eWalletStatus = 'Activated'");
	$ewallet->execute([$_SESSION['customerID']]);

	if($ewallet->rowCount() > 0) {
		$fetch_balance = $ewallet->fetch(PDO::FETCH_ASSOC);
		$updateBalance = $conn->prepare("UPDATE `ewallet` SET `balance`= ? WHERE eWalletID = ?");
		$updateBalance->execute([$fetch_balance['balance'] - $total, $fetch_balance['eWalletID']]);
	}

}

?>