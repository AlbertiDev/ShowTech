<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
 	include 'include/header.php';

$sql = "SELECT * FROM products WHERE deleted = 0";
$products = $db->query($sql);

// isset featured GET
if (isset($_GET['featured'])) {
	$featured = (int)$_GET['featured'];
	$featured = sanitaze($featured);
	$id = (int)$_GET['id'];
	$id = sanitaze($id);
	$sql_ft = "UPDATE products SET featured= $featured WHERE id = $id";
	$db->query($sql_ft);
	header('location: products.php');
}
?>
<div class="container">
    <div class="content-top">        
        <h1>
            Products
        </h1>
        <table class="table table-bordered table-hover table-responsive">
			<thead>
				<tr>
					<th>
						Edit / Delete
					</th>
					<th>
						Product
					</th>
					<th>
						Price
					</th>
					<th>
						Category
					</th>
					<th>
						Featured
					</th>
					<th>
						Sold
					</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($product = mysqli_fetch_assoc($products)): 
						$childID = $product['categories'];

						$catSql = "SELECT  * FROM categories WHERE id = '$childID'";
						$result = $db->query($catSql);

						$cat = mysqli_fetch_assoc($result);

						$parentID = $cat['parent'];

						$qul = "SELECT * FROM categories WHERE id = '$parentID'";
						$presult = $db->query($qul);

						$parent = mysqli_fetch_assoc($presult);

						$category = $parent['category'].' - '.$cat['category'];

					?>
					<tr>
						<td>
							<a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a> / 
							<a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
						<td>
							<?= $product['title']; ?>
						</td>
						<td>
							<?= $product['price']; ?> <span class="glyphicon glyphicon-euro"></span>
						</td>
						<td>
							<?= $category; ?>
						</td>
						<td>
							<a href="products.php?featured=<?= (($product['featured'] == 0)? '1': '0'); ?>&id=<?= $product['id'] ?>" class="btn btn-xs btn-default">
								<span class="glyphicon glyphicon-<?= (($product['featured'] == 0)? 'plus': 'minus'); ?>">
								</span></a>	<?= (($product['featured'] == 1)? 'Featured Product': 'Add to Featured Products'); ?>						
						</td>
						<td>
							sold
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
    </div>
</div>

 <?php include 'include/footer.php';?>