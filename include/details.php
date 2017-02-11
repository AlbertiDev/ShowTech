<?php
	require_once '../assets/conn.php';
	$id = $_POST['id'];
	$id = (int)$id;
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$res = $db->query($sql);
	$product = mysqli_fetch_assoc($res);
	$brand_id = $product['brand'];
	$sql = "SELECT * FROM brand WHERE id = '$brand_id'";
	$ress = $db->query($sql);
	$producti = mysqli_fetch_assoc($ress);
	$sizestr = $product['sizes'];
	$size_array = explode(',', $sizestr);
?>

<!-- details modal -->
<?php ob_start();?>
<div class="modal fade details-1" id="details-md" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hiden="true">
	<div class="modal-dialog">
		<div class="modal-content">
				 <div class="modal-header">
			        <button type="button" class="close" onclick="clsModal();return false;" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title text-center">Details</h4>									
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<div class="center-block">
									<img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="single-para simpleCart_shelfItem">
									<h1><?= $producti['brand']; ?> - <?= $product['title']; ?></h1>
									<p><?= $product['description']; ?></p>									
									<div class="clearfix"> </div>
								</div>
								<hr>
								<label  class="add-to item_price">$<?= $product['price']; ?></label>
								
								<form action="add_cart.php" method="post">
									<h4>Available :</h4>
									<?php 
										foreach ($size_array as $sa) {
											$sa_array = explode(':', $sa);
											$size = $sa_array[0];
											$available = $sa_array[1];
										 	echo $available." for the ".$size." model ";
										 } 
									?>								
								    <div class="form-group">								    	
								        <div class="col-xs-6">
									        <label for="quantity" class="control-label" >Quantity:</label>            
									        <input id="quantity" name="quantity" type="text" placeholder="0" class="form-control input-md">
								        </div>								        
								    </div>								    
								</form>									
						</div>
					</div>
				</div>
				<br>
				<div class="modal-footer">
					<button class="btn btn-default"  onclick="clsModal();return false;">Close</button>
					<button class="btn btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</button>
				</div>
		</div>
	</div>	
</div>
<script>
	function clsModal() {
		jQuery('#details-md').modal('hide');
		setTimeout(function(){
			jQuery('#details-md').remove();
			jQuery('.modal-backdrop').remove();
		},500);
	}
</script>
<?= ob_get_clean();?>