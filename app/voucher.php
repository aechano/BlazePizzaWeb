<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
} 

if(!isset($_POST['discount-token']) || !isset($_SESSION['customerID'])){
	echo 0;
	return;
}

$promo = $conn->prepare("SELECT * FROM `promos` WHERE LOWER(promoCode) = ?");
$promo->execute([strtolower($_POST['discount-token'])]);

if($promo->rowCount() > 0) {
   for($i=0;$i<$promo->rowCount();$i++){   
   		$fetch_promo = $promo->fetch(PDO::FETCH_ASSOC);
   		if($fetch_promo['availability'] != 0) {
	        echo $fetch_promo['rewards'];
			return;
   		} 
   }
} 

echo 0;
return;

?>