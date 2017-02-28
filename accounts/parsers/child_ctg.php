<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
$parentID = (int)$_POST['parentID'];
$selected = sanitaze($_POST['selected']);
$childQuery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category"); ?>

<option value =""></option>
 <?php while($child = mysqli_fetch_assoc($childQuery)): ?>
 <option value="<?=$child['id'];?>" <?=(($selected == $child['id'])?' selected':'')?>><?=$child['category'];?></option>
 <?php endwhile; ?>