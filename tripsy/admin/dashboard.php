<?php
include("auth.php");
include("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include("header.php"); ?>

<h2 class="cart-title">Admin Dashboard</h2>

<div class="products-grid">

    <div class="product-card">📦 Products<br>
        <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM products")); ?>
    </div>

    <div class="product-card">👥 Customers<br>
        <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users")); ?>
    </div>

    <div class="product-card">🧾 Orders<br>
        <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders")); ?>
    </div>

</div>

<br>
<a href="products.php" class="add-cart-btn">Manage Products</a>
<a href="orders.php" class="add-cart-btn">Manage Orders</a>
<a href="company_details.php" class="add-cart-btn">Company Details</a>
<a href="logout.php" class="add-cart-btn">Logout</a>

</body>
</html>
