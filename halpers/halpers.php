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