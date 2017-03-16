<!-- include head scripts -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
	$product_id = sanitaze($_POST['product_id']);
$available = sanitaze($_POST['available']);
$quantity = sanitaze($_POST['quantity']);
$size = sanitaze($_POST['size']);
$item = array();
$item[] = array(
 'id' => $product_id,
 'size' => $size,
 'quantity' => $quantity,
);

//$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
$domain = false;
$query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_cart'] = $product['title']. ' has been added to your cart.'; 

//check if cookie exist
if($cart_id != ''){
 $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
 $cart = mysqli_fetch_assoc($cartQ);
 $previous_items = json_decode($cart['items'],true);
 $item_match = 0;
 $new_items = array();
 foreach($previous_items as $pitem){
  if($item[0]['id'] == $pitem['id'] && $item[0]['size'] == $pitem['size']){
   $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
   if($pitem['quantity'] > $available){
    $pitem['quantity'] = $available;
   }
   $item_match = 1;
  }
  $new_items[] = $pitem;
 }
 if($item_match != 1){
  $new_items = array_merge($item,$previous_items);
 }
 $items_jason = json_encode($new_items);
 $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
 $db->query("UPDATE cart SET items = '{$items_jason}', `expiration_date` = '{$cart_expire}' WHERE id = '{$cart_id}'");
 setcookie(CART_COOKIE.'',1,"/",$domain,false);
 setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
}else{
 //add the cart to the database and set cookie
 $items_jason = json_encode($item);
 $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
 $db->query("INSERT INTO cart (items,expiration_date) VALUES ('{$items_jason}','{$cart_expire}')");
 $cart_id = $db->insert_id;
 setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
}
?>﻿
	