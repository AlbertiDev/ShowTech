<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
$parentID = (int)$_POST['parentID'];
$childQuery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category");
?>
 <option value =""></option>
 <?php while($child = mysqli_fetch_assoc($childQuery)): ?>
 <option value="<?=$child['id'];?>"><?=$child['category'];?></option>
 <?php endwhile; ?>