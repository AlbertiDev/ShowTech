<!-- include head scripts -->
<?php
	require_once '/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 

?>
<!-- //head scripts -->

<!-- body -->
<?php 
	if ($cart_id != '') {
		$sqlCart = $db->query("SELECT * FROM `cart` WHERE id = '{$cart_id}'");
		$products_on_cart = mysqli_fetch_assoc($sqlCart);
		$items = json_decode($products_on_cart['items'],true);
		$i = 1;
		//$sub_total = 0;
		$total = 0;
		//$item_count = 0;
	}
	
?>
<!-- include header banner-->
<?php include 'include/header.php';  include 'include/menu.php'; ?>
	
<!--//header banner-->

<!--content-->
<!---->
<div class="container">
	<div class="check-out">
		<h1>Checkout</h1>
		<?php if($cart_id==''){ ?>
			<h3>Shopping cart is empty!</h3>
		<?php } else { ?>
    	    <table>
				  <tr>
				  	<th>#</th>
					<th>Item</th>
					<th>Title</th>
					<th>Prices</th>
					<th>Qty</th>		
					<th>Size</th>		
					<th>Subtotal</th>
					<th>Delete From Cart</th>
				  </tr>
				  <?php foreach ($items as $item) {
				  	$product_id = $item['id'];
				  	$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
				  	$product = mysqli_fetch_assoc($productQ);
				  	$sizeArray = explode(',', $product['sizes']);
				  	
				  	foreach ($sizeArray as $sizeStr) {
				  	 	$size = explode(":", $sizeStr);
				  	 	if ($size[0]== $item['size']) {
				  	 		$available = $size[1];
				  	 	}
				  	 }?>				  
					  <tr>
					  	<td><?= $i; ?></td>
						<td class="ring-in"><img src="<?= $product['image'];?>" class="img-responsive" alt="<?= $product['title'];?>"></td>
						<td><?= $product['title'];?></td>
						<td><?= $product['price'];?> €</td>
						<td class="check"><input type="text" value="<?= $item['quantity']; ?>" readonly></td>		
						<td><?= $item['size'];?></td>
						<td><?php echo number_format($item['quantity'] * $product['price'],2); ?> €</td>
						<td><a href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
					  </tr>				  
				  <?php
				  	$i++;
				  	$total = $total + ($product['price'] * $item['quantity']);
				   } ?>
				  <tr class="with-border">
				  	<td></td><td></td><td></td><td></td><td></td><td>Total</td>
				  	<td>
				  		<?php  echo number_format($total,2); ?>
				  	 €</td><td></td>
				  </tr>
				  <!-- <tr>
				  	<td></td><td></td><td></td><td></td><td>15000.00 €</td><td></td>
				  </tr> -->
		
	</table>
	<a href="#" class=" to-buy">PROCEED TO BUY</a>
	<?php } ?>
	<div class="clearfix"> </div>
    </div>
</div>

<!--//content-->

<!-- include footer Details-Modal-->
<?php include 'include/footer.php';?>
<!--//footer Details-Modal-->

<!-- //body -->
<!-- //html -->