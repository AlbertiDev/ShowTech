<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
 	include 'include/header.php';

 	$sql = "SELECT * FROM categories WHERE parent = 0";
 	$res = $db->query($sql);
 	$errors = array();
 	$category = '';
 	$post_parent = '';

 	//edit categories
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitaze($edit_id);
    $sqle = "SELECT * FROM categories WHERE id = '$edit_id'";
    $edit_res = $db->query($sqle);
    $ecategory = mysqli_fetch_assoc($edit_res);  	
}

 	//delete categories
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
 		$post_parent = sanitaze($_POST['parent']);
 		$category = sanitaze($_POST['category']);
 		$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent ='$post_parent'";
 		if (isset($_GET['edit'])) {
 			$id_e = $ecategory['id'];
        	$sql = "SELECT * FROM categories WHERE category = '$category' AND id != '$id_e' AND parent ='$post_parent'";
    	}
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
    		$updatedb = "INSERT INTO categories(category, parent) VALUES ('$category','$post_parent')";
    		if (isset($_GET['edit'])) {
            $updatedb = "UPDATE categories SET category = '$category', parent = $post_parent WHERE id = $edit_id";
        }
    		$db->query($updatedb);
    		header('location: categories.php');
    	}
 	}
 	$category_value = '';
 	$parent_value = 0;
 	if (isset($_GET['edit'])) {
 		$category_value = $ecategory['category'];
 		$parent_value = $ecategory['parent'];
 	}else{
 		if(isset($_POST)){
 			$category_value = $category;
 			$parent_value = $post_parent;
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
	               <div class="panel panel-<?=((isset($_GET['edit']))?'info':'default');?>">
	                	<div class="panel-heading"><h3 class="panel-title"><?=((isset($_GET['edit']))?'Edit':'Add a');?> Category</h3></div>
	                    <div class="panel-body">
	        				<form class="form" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
			                    <div class="form-group">
			                    	<label class=" control-label" for="parent">Parent</label>
									  <div>
									    <select id="parent" name="parent" class="form-control">
									      <option value="0" <?= (($parent_value==0)?' selected="selected"':''); ?> >Parent</option>
									      <?php
									      $sqlp = "SELECT * FROM categories WHERE parent = 0"; $resp = $db->query($sqlp);
									       while ($parent = mysqli_fetch_assoc($resp)) : ?>
									      <option value="<?= $parent['id'];?>" <?= (($parent_value == $parent['id'])?' selected="selected"':''); ?> ><?= $parent['category'];?></option>
									      <?php endwhile;?>							      	
									    </select>
									  </div>
			                    </div>
			                    <div class="form-group">
								  <label class="control-label" for="category">Category</label>  
								  <input id="category" name="category" type="text" value="<?= $category_value?>" placeholder="Type a category" class="form-control input-md">						  
								</div>
								<div class="form-group">
								  <?php if(isset($_GET['edit'])):?>
		                        		<a href="categories.php" class="btn btn-default">Cancel</a>
		                        	<?php endif;?>
								  <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Category" class="btn btn-success">						  
								</div>
							</form>
						</div>						   
	                </div>            	
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