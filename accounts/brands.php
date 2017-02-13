<!-- include head scripts -->
<?php
	require_once '../assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
	/*//head scripts*/
 /*body*/ 
/*include header banner*/
 include 'include/header.php';
 /*get brends forn DB*/
  $sql = "SELECT * FROM brand ORDER BY brand ASC";
  $res = $db->query($sql);

  $errors = array();
  //delete brand
  if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  	$del_id = (int)$_GET['delete'];
  	$del_id = sanitaze($del_id);
  	$sqldel = "DELETE FROM brand WHERE id = $del_id";
  	$db->query($sqldel);
  	header('location: brands.php');
  }
 


  /*if add brand is submited*/
  if (isset($_POST['add_submit'])) {
  	$brand = sanitaze($_POST['brand']);
  	// if not empty
  	if ($_POST['brand']=='') {
  		$errors[] .= "You most add a brand";
  	}
  	// if exist in db
  	$sql = "SELECT * FROM brand WHERE brand = '$brand'";
  	$res1 = $db->query($sql);
  	$nr = mysqli_num_rows($res1);
  	if ($nr > 0) {
  		$errors[].= "$brand already exists in database";
  	}
  	// display error
  	if (!empty($errors)) {
  		echo display_errors($errors);
  	} else{
  		// add to db
  		$sqli = "INSERT INTO brand (brand) VALUES ('$brand')";
  		$db->query($sqli);
  		header('location: brands.php');
  	}
  }
  ?>

  
<!--//header banner-->
<div class="container">
<div class="content-top">
<h1>Brands</h1>
<!-- form inline for brands -->
<div class="text-center">
	<form class="form-inline" action="brands.php" method="post">
		<fieldset>
			<div class="form-group">
			  <label for="brand">Add a Brand:</label>			  
			  <input id="brand" name="brand" type="text" placeholder="Type brand name" class="form-control input-md" value="<?= ((isset($_POST['brand']))? $_POST['brand'] : '');?>">
			  <input type="submit" name="add_submit" class="btn btn-success" value="Add Brand">	 
			</div>
		</fieldset>
</form>
</div>
<hr>
<table class="table table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>
				Edit
			</th>
			<th>
				Brand
			</th>
			<th>
				Delete
			</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($brand = mysqli_fetch_assoc($res)): ?>
		<tr>
			<td>
				<a href="brands.php?edit=<?= $brand['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
			</td>
			<td>
				<?= $brand['brand'];?>
			</td>
			<td>
				<a href="brands.php?delete=<?= $brand['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		<?php endwhile; ?>		
	</tbody>
</table>
</div>
</div>

<!-- include footer Details-Modal-->
<?php include 'include/footer.php';?>
<!--//footer Details-Modal-->

<!-- //body -->
<!-- //html