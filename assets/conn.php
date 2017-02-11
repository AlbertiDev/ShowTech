<?php
$db = mysqli_connect('127.0.0.1','root','','showtdb');
if (mysqli_connect_errno()) {
	echo "Error: ".mysqli_connect_error();
	die();
}

define('BASEURL', '/ShowTech/');