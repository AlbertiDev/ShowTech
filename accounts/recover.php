<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
if (!is_logged_in()) {
    login_error_ridirect();
  }
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';  include 'include/menu.php';

//Recover Products
if(isset($_GET['recover'])){
  $id = sanitaze($_GET['recover']);
  $db->query("UPDATE products SET deleted = 0 WHERE id = '$id'");
  header('Location: products.php');
}

$sql = "SELECT * FROM products WHERE deleted = 1 ORDER BY categories";
$presults = $db->query($sql);
 ?>

<div class="container">
    <div class="content-top">
        <h1>
            Recover Deleted Products
        </h1>
        
        <table class="table table-hover table-bordered table-condensed table-striped">
  <thead><th>Recover</th><th>Product</th><th>Price</th><th>Category</th><th>Sold</th></thead>
  <tbody>
    <?php while($product = mysqli_fetch_assoc($presults)):
        $childID = $product['categories'];
        $catSql = "SELECT * FROM categories WHERE id = '$childID'";
        $result = $db->query($catSql);
        $child = mysqli_fetch_assoc($result);
        $parentID = $child['parent'];
        $pSql =  "SELECT * FROM categories WHERE id = '$parentID'";
        $presult = $db->query($pSql);
        $parent = mysqli_fetch_assoc($presult);
        $category = $parent['category'].'~'.$child['category'];
      ?>
      <tr>
        <td>
          <a href="recover.php?recover=<?=$product['id'];?>" class="btn btn-xs btn-primary "><span class="glyphicon glyphicon-refresh"></span></a>

        </td>
        <td><?=$product['title'];?></td>
        <td><?=$product['price'];?> €</td>
        <td><?=$category;?></td>        
        <td>0</td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
    </div>
</div>
<?php include 'include/footer.php';?>
<script>