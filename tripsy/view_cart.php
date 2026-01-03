<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="top-bar">
    Welcome, <?php echo $_SESSION['user_name']; ?> |
    <a href="products.php" style="color:white;">Products</a> |
    <a href="logout.php" style="color:white;">Logout</a>
</div>

<div class="products-container">
    <h2>My Cart</h2>

<?php
if(empty($_SESSION['cart'])){
    echo "<p>Your cart is empty.</p>";
} else {

    $total = 0;

    foreach($_SESSION['cart'] as $pid){
        $res = mysqli_query($conn,
            "SELECT * FROM products WHERE id=$pid");
        $row = mysqli_fetch_assoc($res);

        $total += $row['price'];
?>
        <div class="product-card">
            <img src="uploads/<?php echo $row['image']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['flavor']; ?></p>
            <p>₹<?php echo $row['price']; ?></p>
        </div>
<?php
    }
    echo "<h3>Total: ₹$total</h3>";
}
?>

</div>

</body>
</html>
