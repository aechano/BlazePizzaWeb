<?php

include 'config.php';
if(!isset($_SESSION)) { 
  session_start(); 
} 

if(!isset($_POST['discount-token']) || !isset($_SESSION['customerID'])){
	$_SESSION['promo'] = 0;
	echo 0;
	return;
}

$promo = $conn->prepare("SELECT * FROM `promos` WHERE LOWER(promoCode) = ?");
$promo->execute([strtolower($_POST['discount-token'])]);

if($promo->rowCount() > 0) {
   for($i=0;$i<$promo->rowCount();$i++){   
        $fetch_promo = $promo->fetch(PDO::FETCH_ASSOC);
        $_SESSION['promo'] = $fetch_promo['rewards'];
        echo $fetch_promo['rewards'];
		return;
   }
} else {
	 $_SESSION['promo'] = 0;
	 echo 0;
	 return;
}

?>