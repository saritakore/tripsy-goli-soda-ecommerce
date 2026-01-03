<?php
include("auth.php");
include("../config.php");

if (isset($_POST['add'])) {

    $name   = $_POST['name'];
    $flavor = $_POST['flavor'];
    $price  = $_POST['price'];
    $stock  = $_POST['stock'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/".$image
    );

    mysqli_query($conn,"
        INSERT INTO products
        (name, flavor, price, stock, status, image)
        VALUES
        ('$name','$flavor','$price','$stock','$status','$image')
    ");

    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include("header.php"); ?>

<h2 class="cart-title">Add Product</h2>

<form method="POST" enctype="multipart/form-data" class="billing-form">

    <input type="text" name="name" placeholder="Product Name" required>

    <input type="text" name="flavor" placeholder="Flavor" required>

    <input type="number" name="price" placeholder="Price" required>

    <input type="number" name="stock" placeholder="Stock" required>

    <select name="status" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select>

    <input type="file" name="image" required>

    <button name="add">Add Product</button>

</form>

</body>
</html>
