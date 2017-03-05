<?php
$db = mysqli_connect('127.0.0.1','root','','showtdb');
if (mysqli_connect_errno()) {
	echo "Error: ".mysqli_connect_error();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/config.php';
require_once BASEURL.'halpers/halpers.php';

if (isset($_SESSION['User'])) {
	$user_id = $_SESSION['User'];
	$query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
	$AdmUsr = mysqli_fetch_assoc($query); 
}

if (isset($_SESSION['success_flash'])) {
	echo '<div class="alert alert-success" role="alert">
        <p class="text-center">'.$_SESSION['success_flash'].'</p>
      </div>';	
   unset($_SESSION['success_flash']);
}

if (isset($_SESSION['error_flash'])) {
	echo '<div class="alert alert-danger" role="alert">
        <p class="text-center">'.$_SESSION['error_flash'].'</p>
      </div>';	
   unset($_SESSION['error_flash']);
}


