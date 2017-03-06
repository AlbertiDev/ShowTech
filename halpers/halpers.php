<?php
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach ($errors as $error) {
		$display .= '<li class="text-danger text-center">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

function sanitaze($tags){
	return htmlentities($tags,ENT_QUOTES,"UTF-8");
}

function login($user_id){
	$_SESSION['User'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login = '$date' WHERE id= '$user_id'");
	$_SESSION['success_flash'] = 'You are now logged in!';
	header("location: /showtech/accounts/view.php");
	
}

function is_logged_in(){
	if (isset($_SESSION['User']) && $_SESSION['User'] > 0) {
		return true;
	} return false;
}

function login_error_ridirect($url = '/showtech/login.php'){
	$_SESSION['error_flash'] = 'You must be logged in to access that page!';
	header("location: $url");
}

function has_permissions($permission = 'editor'){
	global $AdmUsr;
	$permissions = explode(',', $AdmUsr['permissions']);
	if (in_array($permission, $permissions)) {
		return true;
	} return false;
}

function permission_error_ridirect($url = 'view.php'){
	$_SESSION['error_flash'] = 'You do not have permission to access that page!';
	header("location: $url");
}

/*showtech/*/