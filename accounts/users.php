<!-- include head scripts -->
<?php
	require_once '../assets/conn.php';
	if (!is_logged_in()) {
		login_error_ridirect();
	}
	if (!has_permissions('admin')) {
		permission_error_ridirect('index.php');
	}
	include 'include/head.php'; include 'include/scripts.php'; include 'include/header.php';  include 'include/menu.php'; 

	$query = $db->query("SELECT * FROM `users` ORDER BY `full_name` ASC");
	
	$usr_id = $AdmUsr['id'];
	
	//delete categories
	if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	    $del_id = (int)$_GET['delete'];
	    $del_id = sanitaze($del_id);	    

	    	$db->query("DELETE FROM products WHERE user = '$del_id'");
	    	
	    	$db->query("DELETE FROM users WHERE id = '$del_id'");
	    	$_SESSION['success_flash'] = 'User has been deleted';
	    	header('location: users.php');	    
	}	

	?>

	<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<h1>Users</h1>
			<table class="table table-bordered table-striped table-hover table-responsive">
	<thead>
		<tr>
			<th>
				User
			</th>
			<th>
				Email
			</th>
			<th>
				Join Date
			</th>
			<th>
				Last Login
			</th>
			<th>
				Delete
			</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($user = mysqli_fetch_assoc($query)) :  ?>
		<tr>
			<td>
				<?= $user['full_name']; ?>
			</td>
			<td>
				<?= $user['email']; ?>
			</td>
			<td>
				<?= $user['date']; ?>
			</td>
			<td>
				<?= $user['last_login']; ?>
			</td>
			<td>
				<?php if ($user['id'] != $usr_id ){ ?>								
					<a href="users.php?delete=<?= $user['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
				<?php } 
				else { echo '<a class="btn btn-xs btn-success"><span class="glyphicon glyphicon-user"></span></a>'; }
				?>
			</td>
		</tr>
		<?php  endwhile; ?>
	</tbody>
</table>
		</div>
	</div>
</div>

	<?php include 'include/footer.php';?>