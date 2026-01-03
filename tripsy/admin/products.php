<?php
include("auth.php");
include("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">Manage Products</h2>

<a href="add_product.php" class="add-cart-btn">+ Add New Product</a>

<br><br>

<table border="1" width="100%" cellpadding="10">
    <tr style="background:#f2f2f2;">
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Flavor</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM products");

while ($row = mysqli_fetch_assoc($res)) {
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td>
        <img src="../uploads/<?php echo $row['image']; ?>" width="60">
    </td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['flavor']; ?></td>
    <td>₹<?php echo $row['price']; ?></td>
    <td><?php echo $row['stock']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete_product.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete this product?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
