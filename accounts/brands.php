<!-- include head scripts -->
<?php
	require_once '../assets/conn.php';
	include 'include/head.php'; include 'include/scripts.php'; 
	/*//head scripts*/
 /*body*/ 
/*include header banner*/
 include 'include/header.php';
 /*get brends forn DB*/
  $sql = "SELECT * FROM brand ORDER BY brand ASC";
  $res = $db->query($sql);
  ?>
<!--//header banner-->
<div class="container">
<div class="content-top">
<h1>Brands</h1>
<table class="table table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>
				
			</th>
			<th>
				Brand
			</th>
			<th>
				
			</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($brand = mysqli_fetch_assoc($res)): ?>
		<tr>
			<td>
				<a href="brands.php?edit=<?= $brand['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
			</td>
			<td>
				<?= $brand['brand'];?>
			</td>
			<td>
				<a href="brands.php?delete=<?= $brand['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		<?php endwhile; ?>		
	</tbody>
</table>
</div>
</div>

<!-- include footer Details-Modal-->
<?php include 'include/footer.php';?>
<!--//footer Details-Modal-->

<!-- //body -->
<!-- //html -->