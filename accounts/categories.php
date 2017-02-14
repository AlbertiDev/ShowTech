<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
 	include 'include/header.php';

 	$sql = "SELECT * FROM categories WHERE parent = 0";
 	$res = $db->query($sql);
 	$errors = array();

 	//delete brand
	if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	    $del_id = (int)$_GET['delete'];
	    $del_id = sanitaze($del_id);
	    $sql = "SELECT * FROM categories WHERE id = '$del_id'";
	    $result = $db->query($sql);
	    $category = mysqli_fetch_assoc($result);
	    if ($category['parent'] == 0) {
	    	$sqldel = "DELETE FROM categories WHERE parent = '$del_id'";
	    	$db->query($sqldel);
	    	header('location: categories.php');
	    }
	    $sqldel = "DELETE FROM categories WHERE id = '$del_id'";
	    $db->query($sqldel);
	    header('location: categories.php');
	}	

 	// proces form data
 	if(isset($_POST) && !empty($_POST)){
 		$parent = sanitaze($_POST['parent']);
 		$category = sanitaze($_POST['category']);
 		$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent ='$parent'";
 		$fres = $db->query($sqlform);
 		$count = mysqli_num_rows($fres);
 		// if category is empty
 		if ($category == '' || $category ==' ') {
        	$errors[] .= "You most add a category";
    	}
    	// if exist in db
    	if ($count > 0) {
        	$errors[].= "$category already exists in database";
    	}
    	//show error or update db
    	if (!empty($errors)) {
        echo display_errors($errors);
    	} else{
    		// update db
    		$updatedb = "INSERT INTO categories(category, parent) VALUES ('$category','$parent')";
    		$db->query($updatedb);
    		header('location: categories.php');
    	}
 	}
 	?>
 <div class="container">
    <div class="content-top">        
        <h1>
            Categories
        </h1>
        <div class="row">
        	<div class="col-md-6">
        		<form class="form" action="categories.php" method="post">
	                <fieldset>
	                	<legend>Add a Category</legend>
	                    <div class="form-group">
	                    	<label class=" control-label" for="parent">Parent</label>
							  <div>
							    <select id="parent" name="parent" class="form-control">
							      <option value="0">Parent</option>
							      <?php
							      $sqlp = "SELECT * FROM categories WHERE parent = 0"; $resp = $db->query($sqlp);
							       while ($parent = mysqli_fetch_assoc($resp)) : ?>
							      <option value="<?= $parent['id'];?>"><?= $parent['category'];?></option>
							      <?php endwhile;?>							      	
							    </select>
							  </div>
	                    </div>
	                    <div class="form-group">
						  <label class="control-label" for="category">Category</label>  
						  <input id="category" name="category" type="text" placeholder="Type a category" class="form-control input-md">						  
						</div>
						<div class="form-group">
						  <input type="submit" value="Add Category" class="btn btn-success">						  
						</div>						   
	                </fieldset>
            	</form>
        	</div>

        	<div class="col-md-6">
        		<table class="table table-bordered table-hover table-responsive">
					<thead>
						<tr>
							<th>
								Categories
							</th>
							<th>
								Parent
							</th>
							<th>
								Edit / Delete
							</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($catg = mysqli_fetch_assoc($res)):
							$part_id = (int)$catg['id'];
							$sql2 = "SELECT * FROM categories WHERE parent = '$part_id'";
							$resc = $db->query($sql2);
						?>							
						<tr>
							<td>
								<?= $catg['category']; ?>
							</td>
							<td>
								Parent
							</td>
							<td>
								<a href="categories.php?edit=
				<?= $catg['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a> / <a href="categories.php?delete=
				<?= $catg['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
						<?php while ($child = mysqli_fetch_assoc($resc)):?>
							<tr class="bg-warning">
								<td>
									<?= $child['category']; ?>
								</td>
								<td><?= $catg['category']; ?></td>
								<td>
								<a href="categories.php?edit=
				<?= $child['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a> / <a href="categories.php?delete=
				<?= $child['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
							</td>
							</tr>
						<?php endwhile; ?>
						<?php endwhile; ?>		
					</tbody>
				</table>
        	</div>        	
        </div>
     </div>
 </div>


 <?php include 'include/footer.php';?>