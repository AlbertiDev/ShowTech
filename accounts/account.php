<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
if (!is_logged_in()) {
		login_error_ridirect();
	}
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php'; 

$password1 = ((isset($_POST['password1']))?sanitaze($_POST['password1']):'');
$password2 = ((isset($_POST['password2']))?sanitaze($_POST['password2']):'');

$password1 = trim($password1);
$password2 = trim($password2);
//$hashed = password_hash($password, PASSWORD_DEFAULT);
$hash_pass = password_hash($password2, PASSWORD_DEFAULT);
$id = $user_id;
$errors = [];
if ($_POST) {
	// form validation
	if (empty($_POST['password1']) || empty($_POST['password2'])) {
		$errors[] = 'You most enter the new password.';
	}

	if ($password2 != $password1) {
		$errors[] = 'You most confirm the new password.';
	}
	
	if (strlen($password2)<=5) {
		$errors[] = 'The new password must have at least 6 characters';
	}

	
	// error check
	if (!empty($errors)) {
		echo display_errors($errors);
	}else{
		global $db;
		$db->query("UPDATE users SET password = '$hash_pass' WHERE id = '$user_id'");
		$_SESSION['success_flash'] = 'You changed the password';
		header("location: view.php");
	}
}
?>

<div class="container">
	<div class="register">
		<h1>Account</h1>
		  	  <form action="account.php" method="post"> 
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Full Name</span>
						<input type="text" value="<?= $AdmUsr['full_name'];?>" readonly> 
					 
						 <span>Email Address</span>
						 <input type="email" value="<?= $AdmUsr['email'];?>" readonly> 
					</div>
					 <div class="clearfix"> </div>
					   <!-- <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
					   </a> -->
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>New Password</span>
								<input type="password" name="password1" id="password1">
								<span>Confirm New Password</span>
								<input type="password" name="password2" id="password2">
							</div>							
					 </div>
					 <div class="clearfix"> </div>
				
				<div class="register-but">
				   
						<input type="submit" value="Edit Account">
					   <div class="clearfix"> </div>
				    

				</div>
				</form>
		   </div>
</div>

<?php include 'include/footer.php';?>