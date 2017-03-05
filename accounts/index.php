<?php 
require_once '../assets/conn.php';
if (!is_logged_in()) {
		login_error_ridirect();
	}

header('location: view.php'); 

?>