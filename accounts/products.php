<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
 	include 'include/header.php';
 	if (isset($_GET['add'])) { 
 		$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
 		$parentQuery = $db->query("SELECT * FROM categories WHERE parent == 0 ORDER BY category");
 		?>
 	<div class="container">
	    <div class="content-top">        
	        <h1>
	            Add Product
	        </h1>
	        <hr>
	        <form action="products.php?add=1" method="POST" enctype="multipart/form-data">
	        	<fieldset>

					<!-- Text input-->
					<div class="form-group col-md-3">
					  <label class="control-label" for="title">Title*:</label>
					  <input id="title" name="title" type="text" placeholder="Type a title" 
					  class="form-control input-md" required="" value="<?= isset($_POST['title'])?sanitaze($_POST['title']):'' ?>">
					</div>
					<div class="form-group col-md-3">
						<label class="control-label" for="brand">Brand*:</label>
						<select id="brand" name="brand" class="form-control">
					      <option value="<?= ((isset($_POST['brand']) && $_POST['brand'] == '')?' selected':''); ?>"></option>
					      <?php while($brand = mysqli_fetch_assoc($brandQuery)): ?>
					      	<option value="<?= $brand['id'] ?>" <?= ((isset($_POST['brand']) && $_POST['brand'] == $brand['id'])?' selected':''); ?>><?= $brand['brand'] ?></option>
					      <?php endwhile; ?>
					    </select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label" for="category">category*:</label>
						<select id="category" name="category" class="form-control">
					      <option value="<?= ((isset($_POST['category']) && $_POST['category'] == '')?' selected':''); ?>"></option>
					      <?php while($category = mysqli_fetch_assoc($parentQuery)): ?>
					      	<option value="<?= $category['id'] ?>" <?= ((isset($_POST['category']) && $_POST['category'] == $category['id'])?' selected':''); ?>><?= $category['category'] ?></option>
					      <?php endwhile; ?>
					    </select>
					</div>
				</fieldset>
	        </form>
	     </div>
     </div>

 <?php		
 	}else{
 		
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
        <a href="products.php?add=1" class="btn btn-success pull-right">Add Product</a><div class="clearfix"> </div>
        <hr>
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

 <?php } include 'include/footer.php';?>