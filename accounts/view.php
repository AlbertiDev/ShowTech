<!-- include head scripts -->
<?php
	require_once '../assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; ?>
<!-- //head scripts -->

<!-- body -->

<!-- include header banner-->
<?php include 'include/header.php'; 
		$sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0";
		$featuredp = $db->query($sql);
?>
<!--//header banner-->

<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<h1>View Products</h1>
			<div class="content-top1">
				<?php while ($product = mysqli_fetch_assoc($featuredp)): ?>
					<div class="col-md-3 col-md2">
						<div class="col-md1 simpleCart_shelfItem">						
								<a href="javascript:void(0)" onclick="detailsmodal(<?= $product['id']; ?>);return false;"><img class="img-responsive same" src="<?php echo $product['image']; ?>" alt="<?= $product['title']; ?>"/></a>		
							<h3><?= $product['title']; ?></h3>
							<div class="price">
									<h5 class="item_price"><?= $product['price']; ?> <span class="glyphicon glyphicon-euro"></span></h5>
									<a href="javascript:void(0)" class="item_add" onclick="detailsmodal(<?= $product['id']; ?>);return false;">More details</a>
									<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>					
				<div class="clearfix"> </div>
			</div>				
		</div>
	</div>
</div>
<!--//content-->

<!-- include footer Details-Modal-->
<?php include 'include/footer.php';?>
<!--//footer Details-Modal-->

<!-- //body -->
<!-- //html -->