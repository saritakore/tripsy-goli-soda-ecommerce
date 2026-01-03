<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$order_id = (int)$_GET['order_id'];
$user_id = $_SESSION['user_id'];

/* Security check: order must belong to user */
$check = mysqli_query($conn,
    "SELECT * FROM orders WHERE id=$order_id AND user_id=$user_id");

if (mysqli_num_rows($check) == 0) {
    echo "Invalid Order";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">Order Details</h2>

<div class="cart-wrapper">

<?php
$res = mysqli_query($conn,
    "SELECT p.name, p.flavor, oi.quantity, oi.price
     FROM order_items oi
     JOIN products p ON oi.product_id = p.id
     WHERE oi.order_id = $order_id");

$total = 0;

while ($row = mysqli_fetch_assoc($res)) {
    $line = $row['quantity'] * $row['price'];
    $total += $line;
?>

<div class="cart-item">
    <div class="cart-details">
        <h4><?php echo $row['name']; ?> (<?php echo $row['flavor']; ?>)</h4>
        <p>Quantity: <?php echo $row['quantity']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
        <p><strong>Subtotal: ₹<?php echo $line; ?></strong></p>
    </div>
</div>

<?php } ?>

<div class="cart-total">
    Total Paid: ₹<?php echo $total; ?>
</div>

<br>

<a href="my_orders.php" class="add-cart-btn">← Back to My Orders</a>

</div>

</body>
</html>
