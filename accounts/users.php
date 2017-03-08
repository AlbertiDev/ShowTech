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

	$errors = [];  	

	
	//delete users
	if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	    $del_id = (int)$_GET['delete'];
	    $del_id = sanitaze($del_id);	    

	    	$db->query("DELETE FROM products WHERE user = '$del_id'");
	    	
	    	$db->query("DELETE FROM users WHERE id = '$del_id'");
	    	$_SESSION['success_flash'] = 'User has been deleted';
	    	header('location: users.php');	    
	}

	// edit premission
	if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	    $edit_id = (int)$_GET['edit'];
	    $edit_id = sanitaze($edit_id);
	    $sqle = "SELECT * FROM users WHERE id = '$edit_id'";
	    $edit_res = $db->query($sqle);
	    $eUser = mysqli_fetch_assoc($edit_res);
	

	/*if edit permission is submited*/
		if (isset($_POST['edit_submit'])) {
		    $permission = sanitaze($_POST['permission']);
		    // if not empty
		    if ($_POST['permission'] == '' || trim($_POST['permission']) == '') {
		        $errors[] .= "You most add a permission";
		    }

		    		    
		    // display error
		    if (!empty($errors)) {
		        echo display_errors($errors);
		    } else{
		        // edit in db
		       
		            $sqli = "UPDATE users SET permissions = '$permission' WHERE id = $edit_id";
		        
		        $db->query($sqli);
		        header('location: users.php');
		    	}
			}	
}

	?>

	<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<h1>Users <?=((isset($_GET['edit']))?'Permission':'');?></h1>

	<?php if (isset($_GET['edit']) && !empty($_GET['edit'])) : ?>
		<div class="text-center mation">
            <form class="form-inline" action="users.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
                <fieldset>
                    <div class="form-group">
                    	<?php if (isset($_GET['edit'])) {
                                $permission_value = $eUser['permissions'];
                                $emailF = explode('@', $eUser['email']);
                                $Femail = $emailF [0];
                            }
                        ?>
                        <label for="permission"><?=  $Femail.'\'s '; ?>Permission:</label>
                        <input id="permission" name="permission" type="text" placeholder="Type permission name" class="form-control input-md" value="<?= $permission_value; ?>">
                        	<a href="users.php" class="btn btn-default">Cancel</a>                                                
                        <input type="submit" name="edit_submit" class="btn btn-success" value="Edit Permission">
                    </div>
                </fieldset>
            </form>
        </div>
			<hr>
	<?php endif; ?>
			
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
							Permission
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
						<td><?php if ($user['id'] != $usr_id ){ ?>
							<a href="users.php?edit=
			<?= $user['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span> <?= ' '.$user['permissions']; ?></a>
							<?php } 
							else { echo '<a class="btn btn-xs btn-success"><span class="glyphicon glyphicon-user"></span>'.' '.$user['permissions'].'</a>'; }
							?>
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