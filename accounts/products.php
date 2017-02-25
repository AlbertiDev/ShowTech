<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';

if(isset($_GET['add']) || isset($_GET['edit'])) {
        $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
        $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");

        $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitaze($_POST['title']) : '');
        $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitaze($_POST['brand']) : '');
        $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitaze($_POST['child']) : '');
        $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitaze($_POST['parent']) : '');

        if(isset($_GET['edit'])) {
            $edit_id = (int)$_GET['edit'];
            $productResults = $db->query("SELECT * FROM products WHERE id = '{$edit_id}'");
            $product = mysqli_fetch_assoc($productResults);
            
            $title = ((isset($_POST['title']) && !empty($_POST['title']))?sanitaze($_POST['title']) : $product['title']);
            $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitaze($_POST['brand']) : $product['brand']);
            $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitaze($_POST['child']) : $product['categories']);

            $parentQ = $db->query("SELECT * FROM categories WHERE id = '{$category}'");
            $parentResult = mysqli_fetch_assoc($parentQ);
            $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitaze($_POST['parent']) : $parentResult['parent']);
        }

        if($_POST) {
            //$title = sanitaze($_POST['title']);
            //$brand = sanitaze($_POST['brand']);
            $categories = sanitaze($_POST['child']);
            $price = sanitaze($_POST['price']);
            $list_price = sanitaze($_POST['list_price']);
            $sizes = sanitaze($_POST['sizes']);
            $description = sanitaze($_POST['description']);
            $dbpath = '';

            $errors = array();
            if(!empty($_POST['sizes'])) {
                $sizeString = sanitaze($_POST['sizes']);
                $sizeString = rtrim($sizeString, ',');
                $sizesArray = explode(',', $sizeString);
                $sArray = array();
                $qArray = array();
                foreach($sizesArray as $ss) {
                    $s = explode(':', $ss);
                    $sArray = $s[0];
                    $qArray = $s[1];
                }
            } else {
                $sizesArray = array();
            }
            
            $required = array('title', 'brand', 'price', 'parent', 'child', 'sizes');
            foreach($required as $field) {
                if($_POST[$field] == '') {
                    $errors[] = 'All fields with an anterisk are required!';
                    break;
                }
            }

            if(!empty($_FILES)) {
                $photo = $_FILES['photo'];
                $name = $photo['name'];
                $nameArray = explode('.', $name);
                $fileName = $nameArray[0];
                $fileExt = $nameArray[1];
                $mime = explode('/', $photo['type']);
                $mimeType = $mime[0];
                $mimeExt = $mime[1];
                $tmpLoc = $photo['tmp_name'];
                $fileSize = $photo['size'];

                $allowed = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
                $uploadName = md5(microtime()).'.'.$fileExt;
                $uploadPath = BASEURL.'images/products/'.$uploadName;
                $dbpath = '/showtech/images/products/'.$uploadName;
                if($mimeType != 'image') {
                    $errors[] .= 'The file must be an image.';
                }
                if(!in_array($fileExt, $allowed)) {
                    $errors[] .= 'The file extension must be a png, jpg, jpeg, or gif.';
                }
                if($fileSize > 15000000) {
                    $errors[] .= 'The file size must be under 15 megabytes.';
                }
                if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
                    $errors[] .= 'File extension does not match the file.';
                }
            }
            
            if(!empty($errors)) {
                echo display_errors($errors);
            } else {
                /* Upload file and insert into database. */
                move_uploaded_file($tmpLoc, $uploadPath);
                $insertSql = "INSERT INTO products (title, price, list_price, brand, categories, image, description, sizes) VALUES ('{$title}', '{$price}', '{$list_price}', '{$brand}', '{$categories}', '{$dbpath}', '{$description}', '{$sizes}')";
                $db->query($insertSql);
                header("Location: products.php");
            }
        }
?>

<!-- Form -->
 <div class="container">
    <div class="content-top">        
        <h1><?php echo ((isset($_GET['edit']))?'Edit' : 'Add A New'); ?> Product</h1>
     <hr>
<form class="form" action="products.php?<?php echo ((isset($_GET['edit']))?'edit='.$edit_id : 'add=1'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-3">
        <label for="title">Title*:</label>
        <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>">
    </div>
    <div class="form-group col-md-3">
        <label for="brand">Brand*:</label>
        <select class="form-control" name="brand" id="brand">
            <option value=""<?php echo (($brand == '')?' selected' : ''); ?>></option>
            <?php while($b = mysqli_fetch_assoc($brandQuery)) : ?>
            <option value="<?php echo $b['id']; ?>"<?php echo (($brand == $b['id'])?' selected' : ''); ?>><?php echo $b['brand']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="parent">Parent Category*:</label>
        <select class="form-control" name="parent" id="parent">
            <option value=""<?php echo (($parent == '')?' selected' : ''); ?>></option>
            <?php while($p = mysqli_fetch_assoc($parentQuery)) : ?>
            <option value="<?php echo $p['id']; ?>"<?php echo (($parent == $p['id'])?' selected' : ''); ?>><?php echo $p['category']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="child">Child Category*:</label>
        <select class="form-control" name="child" id="child"></select>
    </div>
    <div class="form-group col-md-3">
        <label for="price">Price*:</label>
        <input class="form-control" type="text" name="price" id="price" value="<?php echo ((isset($_POST['price']))?$_POST['price'] : ''); ?>">
    </div>
    <div class="form-group col-md-3">
        <label for="list_price">List Price:</label>
        <input class="form-control" type="text" name="list_price" id="list_price" value="<?php echo ((isset($_POST['list_price']))?sanitaze($_POST['list_price']) : ''); ?>">
    </div>
    <div class="form-group col-md-3">
        <label>Quantity &amp; Sizes*:</label>
        <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity &amp; Sizes</button>
    </div>
    <div class="form-group col-md-3">
        <label for="sizes">Sizes &amp; Quantity Preview</label>
        <input class="form-control" type="text" name="sizes" id="sizes" value="<?php echo ((isset($_POST['sizes']))?$_POST['sizes'] : ''); ?>" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="photo">Product Photo:</label>
        <input class="form-control" type="file" name="photo" id="photo">
    </div>
    <div class="form-group col-md-6">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="6"><?php echo ((isset($_POST['description']))?sanitaze($_POST['description']) : ''); ?></textarea>
    </div>
    <div class="form-group pull-right clearfix">
        <a class="btn btn-default" href="products.php">Cancel</a>
        <input class="btn btn-success" type="submit" value="<?php echo ((isset($_GET['edit']))?'Edit' : 'Add'); ?> Product">
    </div>
    <div class="clearfix"></div>
</form>
</div></div>
        

<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sizesModalLabel">Size &amp; Quantity</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php for($i = 1; $i <= 12; $i++) : ?>
                    <div class="form-group col-md-4">
                        <label for="size<?php echo $i; ?>">Size:</label>
                        <input class="form-control" type="text" name="size<?php echo $i; ?>" id="size<?php echo $i; ?>" value="<?php echo ((!empty($sArray[$i-1]))?$sArray[$i-1] : ''); ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="qty<?php echo $i; ?>">Quantity:</label>
                        <input class="form-control" type="number" name="qty<?php echo $i; ?>" id="qty<?php echo $i; ?>" value="<?php echo ((!empty($qArray[$i-1]))?$qArray[$i-1] : ''); ?>" min="0">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php
    } else {

    $presults = $db->query("SELECT * FROM products WHERE deleted = 0");
    if(isset($_GET['featured'])) {
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $db->query("UPDATE products SET featured = '{$featured}' WHERE id = '{$id}'");
        header("Location: products.php");
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
        <table class="table table-bordered table-condensed table-striped">
    <thead>
        <th>Edit / Delete</th>
        <th>Product</th>
        <th>Price</th>
        <th>Category</th>
        <th>Featured</th>
        <th>Sold</th>
    </thead>
    <tbody>
        <?php while($product = mysqli_fetch_assoc($presults)) : 
            $childID = $product['categories'];
            $result = $db->query("SELECT * FROM categories WHERE id = '{$childID}'");
            $child = mysqli_fetch_assoc($result);
            $parentID = $child['parent'];
            $presult = $db->query("SELECT * FROM categories WHERE id = '$parentID'");
            $parent = mysqli_fetch_assoc($presult);
            $category = $parent['category'].' ~ '.$child['category'];
        ?>
        <tr>
            <td>
                <a class="btn btn-xs btn-info" href="products.php?edit=<?php echo $product['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a> / 
                <a class="btn btn-xs btn-danger" href="products.php?delete=<?php echo $product['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
            <td><?php echo $product['title']; ?></td>
            <td><?php echo $category; ?></td>
            <td>
                <a class="btn btn-xs btn-default" href="products.php?featured=<?php echo (($product['featured'] == 0)?'1' : '0'); ?>&id=<?php echo $product['id']; ?>"><span class="glyphicon glyphicon-<?php echo (($product['featured'] == 1)?'minus': 'plus'); ?>"></span></a>&nbsp; <?php echo (($product['featured'] == 1)?'Featured Product' : 'Add to Featured Products'); ?>
            </td>
            <td>0</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
    </div>
</div>
<?php } include 'include/footer.php';?>