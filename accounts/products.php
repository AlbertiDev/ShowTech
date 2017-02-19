<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';
if (isset($_GET['add'])) { 
    $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
    $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category ASC");
    
    if ($_POST) {
        if (!empty($_POST['sizes'])) {
            $sizeStr = sanitaze($_POST['sizes']);
            $sizeStr = rtrim($sizeStr,',');
            $sizesArray = explode(',', $sizeStr);
            $sArray = array();
            $qArray = array();    
            foreach ($sizesArray as $size) {
                $s = explode(':', $size);
                $sArray[] = $s[0];
                $qArray[] = $s[1];
            }
        }else{$sizesArray = array();}
    }
?>
<div class="container">
    <div class="content-top">
        <h1>
            Add Product
        </h1>
        <hr>
        <form action="products.php?add=1" method="POST" enctype="multipart/form.data">
            <fieldset>
                <div class="form-group col-md-3">
                    <label for="title">Title*:</label>
                    <input type="text" name="title" class="form-control" id="title" value="
<?=((isset($_POST['title']))?sanitaze($_POST['title']):'');?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="brand">Brand*:</label>
                    <select class="form-control" id="brand" name="brand">
                        <option value=""<?=((isset($_POST['brand']) && $_POST['brand'] == '')?'selected':'');?>></option>
                        <?php while($brand = mysqli_fetch_assoc($brandQuery)): ?>
                        <option value = "<?=$brand['id'];?>"<?=((isset($_POST['brand'])&& $_POST['brand'] == $brand['id'])?' selected':'');?>><?=$brand['brand'];?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="brand">Parent Category*:</label>
                    <select class="form-control" id="parent" name="parent">
                        <option value=""<?=((isset($_POST['parent']) && $_POST['parent'] == '')?'selected':'');?>></option>
                        <?php while($parent = mysqli_fetch_assoc($parentQuery)): ?>
                        <option value=" <?=$parent['id'];?>"<?=((isset($_POST['parent']) && $_POST['parent'] == $parent['id'])?' select':'');?>><?=$parent['category'];?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="child">Child Category*:</label>
                    <select id="child" name="child" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="price">Price*:</label>
                    <input type="text" id="price" name="price" class="form-control" value="
<?=((isset($_POST['price']))?sanitaze($_POST['price']):'');?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="price">List Price*:</label>
                    <input type="text" id="list_price" name="list_price" class="form-control" value="
<?=((isset($_POST['list_price']))?sanitaze($_POST['list_price']):'');?>">
                </div>
                <div class ="form-group col-md-3">
                    <label>Quantity & Sizes*:</label>
                    <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
                </div>
                <div class="form-group col-md-3">
                    <label for="sizes">Sizes & Qty Preview</label>
                    <input type="text" class="form-control" name="sizes" id="sizes" value="
<?=((isset($_POST['sizes']))?$_POST['sizes']:'');?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="photo">Product Photo:</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="6"><?=((isset($_POST['description']))?sanitaze($_POST['description']):'');?></textarea>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" value="Add Product" class="form-control btn btn-success">
                </div>
                <div class="clearfix">
                </div>
            </fieldset>
        </form>

        <!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Quantity & Sizes</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <?php for ($i=1; $i <=3 ; $i++) : ?> 
            <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Product <?= $i; ?></h3>
            </div>
            <div class="panel-body">
              <div class="form-group col-md-4">
                    <label for="qty<?= $i; ?>">Quantity*:</label>
                    <input type="number" id="qty<?= $i; ?>" name="qty<?= $i; ?>" class="form-control" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0">
                </div>
             <div class="form-group col-md-8">
                    <label for="size<?= $i; ?>">Size*:</label>
                    <input type="text" id="size<?= $i; ?>" name="size<?= $i; ?>" class="form-control" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>">
                </div>
            </div>
          </div>
        <?php endfor; ?>
      </div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>
<?php		
}else{
    $sql = "SELECT * FROM products WHERE deleted = 0";
    $products = $db->query($sql);
    // isset featured GET
    if (isset($_GET['featured'])) {
        $featured = (int)$_GET['featured'];
        $featured = sanitaze($featured);
        $id = (int)$_GET['id'];
        $id = sanitaze($id);
        $sql_ft = "UPDATE products SET featured= $featured WHERE id = $id";
        $db->query($sql_ft);
        header('location: products.php');
    }
?>
<div class="container">
    <div class="content-top">
        <h1>
            Products
        </h1>
        <a href="products.php?add=1" class="btn btn-success pull-right">Add Product</a>
        <div class="clearfix">
        </div>
        <hr>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>
                        Edit / Delete
                    </th>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Featured
                    </th>
                    <th>
                        Sold
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($products)): 
    $childID = $product['categories'];
    $catSql = "SELECT  * FROM categories WHERE id = '$childID'";
    $result = $db->query($catSql);
    $cat = mysqli_fetch_assoc($result);
    $parentID = $cat['parent'];
    $qul = "SELECT * FROM categories WHERE id = '$parentID'";
    $presult = $db->query($qul);
    $parent = mysqli_fetch_assoc($presult);
    $category = $parent['category'].' - '.$cat['category'];
                ?>
                <tr>
                    <td>
                        <a href="products.php?edit=
<?= $product['id']; ?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        / 
                        <a href="products.php?delete=
<?= $product['id']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                    <td>
                        <?= $product['title']; ?>
                    </td>
                    <td>
                        <?= $product['price']; ?> 
                        <span class="glyphicon glyphicon-euro"></span>
                    </td>
                    <td>
                        <?= $category; ?>
                    </td>
                    <td>
                        <a href="products.php?featured=
<?= (($product['featured'] == 0)? '1': '0'); ?>&id=
<?= $product['id'] ?>" class="btn btn-xs btn-default">
                            <span class="glyphicon glyphicon-<?= (($product['featured'] == 0)? 'plus': 'minus'); ?>">
                            </span></a>
                        <?= (($product['featured'] == 1)? 'Featured Product': 'Add to Featured Products'); ?>						
                    </td>
                    <td>
                        sold
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } include 'include/footer.php';?>