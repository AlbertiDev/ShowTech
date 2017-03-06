<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';?>
</div>
</div>
<?php
$email = ((isset($_POST['email']))?sanitaze($_POST['email']):'');
$password = ((isset($_POST['password']))?sanitaze($_POST['password']):'');
$email = trim($email);
$password = trim($password);
//$hashed = password_hash($password, PASSWORD_DEFAULT);
$errors = [];
if ($_POST) {
	// form validation
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$errors[] = 'You most enter email and password.';
	}

	//valid email
	if(!filter_var( $email , FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'You must enter a valid email';
	}

	if (strlen($password)<=5) {
		$errors[] = 'Password must have at least 6 characters';
	}

	// check if email exists in db
	$query = $db->query("SELECT * FROM users WHERE email Like '$email'");
	$user = mysqli_fetch_assoc($query);
	$userCount = mysqli_num_rows($query);
	
/*	if ($userCount > 0) {
		$errors[] = 'This email already exist in database.';
	}*/
	if ($userCount < 1) {
		
		$errors[] = 'Your email address has not been registered, please register it.';
	}

	if (!password_verify($password,$user['password'])) {
		$errors[] = 'Password incorrect.';
	}

	// error check
	if (!empty($errors)) {
		echo display_errors($errors);
	}else{
		// user log  in
		$user_id = $user['id'];
		login($user_id);
	}
}
?>

<div class="account">
	<div class="container">
		<h1>Login</h1>
		<div class="account_grid">
			   <div class="col-md-6 login-right">
				<form action="login.php" method="post">

					<span>Email Address</span>
					<input type="email" id="email" name="email" value="<?= $email;?>"> 
				
					<span>Password</span>
					<input type="password" id="password" name="password" value="<?= $password;?>"> 
					<div class="word-in">
				  		<!-- <a class="forgot" href="#">Forgot Your Password?</a> -->
				 		 <input type="submit" value="Login">
				  	</div>
			    </form>
			   </div>	
			    <div class="col-md-6 login-left">
			  	 <h4>NEW USER</h4>
				 <p>If you don't have a account click the button CREATE AN ACCOUNT to register.</p>
				 <a class="acount-btn" href="register.php">Create an Account</a>
			   </div>
			   <div class="clearfix"> </div>
			 </div>
	</div>
</div>

</div>
</div>
<?php include 'include/footer.php';?>