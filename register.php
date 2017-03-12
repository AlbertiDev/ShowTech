<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';?>
</div>
</div>
<?php

$full_name = ((isset($_POST['full_name']))?sanitaze($_POST['full_name']):'');
$email = ((isset($_POST['email']))?sanitaze($_POST['email']):'');
$password1 = ((isset($_POST['password1']))?sanitaze($_POST['password1']):'');
$password2 = ((isset($_POST['password2']))?sanitaze($_POST['password2']):'');

$email = trim($email);
$password1 = trim($password1);
$password2 = trim($password2);
//$hashed = password_hash($password, PASSWORD_DEFAULT);
$hash_pass = password_hash($password2, PASSWORD_DEFAULT);
$errors = [];
if ($_POST) {
	// check if email exists in db
	//global $db;
	$query = $db->query("SELECT * FROM `users` WHERE `email` = '$email'");	
	$userCount = mysqli_num_rows($query);
	
	if ($userCount > 0) {
		$errors[] = 'This email already exist in database';
	}

	// form validation
	if (empty($_POST['full_name']) || empty($_POST['email'])  || empty($_POST['password1']) || empty($_POST['password2'])) {
		$errors[] = 'You most enter your full name, email and password.';
	}

	//valid email
	if(!filter_var( $email , FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'You must enter a valid email';
	}

	if (strlen($password2)<=5) {
		$errors[] = 'Password must have at least 6 characters';
	}

	if ($password2 != $password1) {
		$errors[] = 'You most confirm password.';
	}	

	// error check
	if (!empty($errors)) {
		echo display_errors($errors);
	}
	else{
		//global $db;
		$db->query("INSERT INTO `users`(`full_name`, `email`, `password`, `permissions`)
		 VALUES ('$full_name','$email','$hash_pass','editor,')");
	 	$_SESSION['success_flash'] = 'You are registered.';
	 
	

	$queryi = $db->query("SELECT * FROM `users` WHERE `email` = '$email'");
	$user = mysqli_fetch_assoc($queryi);
	$userCount = mysqli_num_rows($queryi);

	if ($userCount < 1) {
		
		$errors[] = 'Your email address has not been registered, please register it.';
	}

	if (!password_verify($password2,$user['password'])) {
		$errors[] = 'Password incorrect.';
	}// error check
	if (!empty($errors)) {
		echo display_errors($errors);
	}else{
		// user log  in
		$user_id = $user['id'];
		login($user_id);
			}
		}
	}

?>
<div class="container">
	<div class="register">
		<h1>Register</h1>
		  	  <form action="register.php" method="post" autocomplete="off"> 
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Full Name</span>
						<input type="text" name="full_name" id="full_name"> 
					 
						 <span>Email Address</span>
						 <input type="email" name="email" id="email"> 
					</div>
					 <div class="clearfix"> </div>
					   <!-- <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
					   </a> -->
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Password</span>
								<input type="password" name="password1" id="password1">
								<span>Confirm Password</span>
								<input type="password" name="password2" id="password2">
							</div>
					 </div>
					 <div class="clearfix"> </div>
				
				<div class="register-but">
				   
					   <input type="submit" value="submit" style="text-transform: uppercase">
					   <div class="clearfix"> </div>
				   
				</div>
				</form>
		   </div>
</div>

</div>
</div>
<?php include 'include/footer.php';?>