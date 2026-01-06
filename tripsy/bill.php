<?php
session_start();
include("config.php");

if (!isset($_GET['order_id'])) {
    header("Location: products.php");
    exit;
}

$order_id = (int)$_GET['order_id'];

/* Fetch order summary */
$orderRes = mysqli_query($conn, "
    SELECT subtotal, delivery_charge, total_amount, payment_method, status
    FROM orders
    WHERE id = $order_id
");
$order = mysqli_fetch_assoc($orderRes);

if (!$order) {
    echo "Invalid Order ID";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Bill</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="cart-page">

<?php include("header.php"); ?>

<h2 class="cart-title">Order Bill</h2>

<div class="cart-wrapper">

<p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
<p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
<p><strong>Order Status:</strong> <?php echo $order['status']; ?></p>

<hr>

<h3>Order Items</h3>

<?php
$res = mysqli_query($conn, "
    SELECT p.name, p.flavor, oi.quantity, oi.price
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $order_id
");

while ($row = mysqli_fetch_assoc($res)) {
    $line = $row['quantity'] * $row['price'];
?>
<p>
<?php echo $row['name']; ?> (<?php echo $row['flavor']; ?>)  
× <?php echo $row['quantity']; ?>  
= ₹<?php echo $line; ?>
</p>
<?php } ?>

<hr>

<p>Subtotal: ₹<?php echo $order['subtotal']; ?></p>

<p>
Delivery Charges:
<?php
if ($order['delivery_charge'] == 0) {
    echo '<span class="free-delivery">FREE</span>';
} else {
    echo "₹" . $order['delivery_charge'];
}
?>
</p>


<h3>Total Paid: ₹<?php echo $order['total_amount']; ?></h3>

<br>

<a href="products.php" class="add-cart-btn">Continue Shopping</a>

</div>

</body>
</html>
