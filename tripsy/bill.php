<?php
session_start();
include("config.php");

$order_id = $_GET['order_id'];
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

<hr>

<?php
$res = mysqli_query($conn, "
    SELECT p.name, p.flavor, oi.quantity, oi.price
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $order_id
");

$total = 0;

while ($row = mysqli_fetch_assoc($res)) {
    $line = $row['quantity'] * $row['price'];
    $total += $line;
?>

<p>
<?php echo $row['name']; ?> (<?php echo $row['flavor']; ?>)  
× <?php echo $row['quantity']; ?>  
= ₹<?php echo $line; ?>
</p>

<?php } ?>

<hr>

<h3>Total Paid: ₹<?php echo $total; ?></h3>

<br>

<a href="products.php" class="add-cart-btn">Continue Shopping</a>

</div>

</body>
</html>
