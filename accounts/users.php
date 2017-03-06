<!-- include head scripts -->
<?php
	require_once '../assets/conn.php';
	if (!is_logged_in()) {
		login_error_ridirect();
	}
	if (!has_permissions('admin')) {
		permission_error_ridirect('index.php');
	}
	include 'include/head.php'; include 'include/scripts.php'; include 'include/header.php';  include 'include/menu.php'; ?>

	<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<h1>Users</h1>
		</div>
	</div>
</div>

	<?php include 'include/footer.php';?>