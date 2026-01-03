<?php
include("auth.php");
include("../config.php");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {

    $name   = $_POST['name'];
    $flavor = $_POST['flavor'];
    $price  = $_POST['price'];
    $stock  = $_POST['stock'];
    $status = $_POST['status'];

    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    } else {
        $image = $product['image'];
    }

    mysqli_query($conn,"
        UPDATE products SET
        name='$name',
        flavor='$flavor',
        price='$price',
        stock='$stock',
        status='$status',
        image='$image'
        WHERE id=$id
    ");

    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include("header.php"); ?>

<h2 class="cart-title">Edit Product</h2>

<form method="POST" enctype="multipart/form-data" class="billing-form">

    <input type="text" name="name"
           value="<?php echo $product['name']; ?>" required>

    <input type="text" name="flavor"
           value="<?php echo $product['flavor']; ?>" required>

    <input type="number" name="price"
           value="<?php echo $product['price']; ?>" required>

    <input type="number" name="stock"
           value="<?php echo $product['stock']; ?>" required>

    <select name="status">
        <option value="Active" <?php if($product['status']=="Active") echo "selected"; ?>>
            Active
        </option>
        <option value="Inactive" <?php if($product['status']=="Inactive") echo "selected"; ?>>
            Inactive
        </option>
    </select>

    <input type="file" name="image">

    <button name="update">Update Product</button>

</form>

</body>
</html>
