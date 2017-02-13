<?php
$db = mysqli_connect('127.0.0.1','root','','showtdb');
if (mysqli_connect_errno()) {
	echo "Error: ".mysqli_connect_error();
	die();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/config.php';
require_once BASEURL.'halpers/halpers.php';