<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
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
<div class="modal fade details-1" id="details-us" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hiden="true">
	<div class="modal-dialog">
		<div class="modal-content">
				 <div class="modal-header single-para ">
			        <button type="button" class="close" onclick="clsModal();return false;" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h1 class="modal-title text-center"><?= $producti['brand'].' '.$product['title']; ?></h1>
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
							<h4>Details</h4>
							<p><?php echo nl2br($product['description']); ?></p>
							<hr>
							<p>Price: <?php echo $product['price']; ?> &euro;</p>
							<p>Brand: <?php echo $producti['brand']; ?></p>

							<hr>
							
							<form action="add_cart.php" method="post">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="quantity">Quantity:</label>
											<input class="form-control" id="quantity" type="number" min="0" name="quantity">
										</div>
									</div>
									<br><br>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="size">Size:</label>
											<select name="size" class="form-control" id="size">
												<option value=""></option>
												<?php foreach($size_array as $string) {
													$string_array = explode(':', $string);
													$size = $string_array[0];
													$quantity = $string_array[1];
													echo '<option value="'.$size.'">'.$size.' ('.$quantity.' Available)</option>';
												} ?>
											</select>
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
				<br>
				<div class="modal-footer">
					<button class="btn btn-default"  onclick="clsModal();return false;">Close</button>
					<button class="btn btn btn-warning" onclick="clsModal();return false;" ><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</button>
				</div>
		</div>
	</div>	
</div>
<script>
	function clsModal() {
		jQuery('#details-us').modal('hide');
		setTimeout(function(){
			jQuery('#details-us').remove();
			jQuery('.modal-backdrop').remove();
		},500);
	}
</script>
<?= ob_get_clean();?>