<?php
include("auth.php");
include("../config.php");

/* Get order ID safely */
if (!isset($_GET['order_id'])) {
    header("Location: orders.php");
    exit;
}
$order_id = (int)$_GET['order_id'];

/* Update order status */
if (isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    mysqli_query($conn,
        "UPDATE orders SET status='$new_status' WHERE id=$order_id"
    );
}

/* Fetch current order status */
$orderRes = mysqli_query($conn,
    "SELECT status FROM orders WHERE id=$order_id"
);
$orderData = mysqli_fetch_assoc($orderRes);
$currentStatus = $orderData['status'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">Order Details (Order ID: <?php echo $order_id; ?>)</h2>

<div class="cart-wrapper">

<!-- ORDER STATUS -->
<div class="billing-form">
    <h3>Order Status</h3>
    <form method="POST">
        <select name="status" required>
            <option value="Pending" <?php if($currentStatus=="Pending") echo "selected"; ?>>Pending</option>
            <option value="Confirmed" <?php if($currentStatus=="Confirmed") echo "selected"; ?>>Confirmed</option>
            <option value="Dispatched" <?php if($currentStatus=="Dispatched") echo "selected"; ?>>Dispatched</option>
            <option value="Delivered" <?php if($currentStatus=="Delivered") echo "selected"; ?>>Delivered</option>
            <option value="Cancelled" <?php if($currentStatus=="Cancelled") echo "selected"; ?>>Cancelled</option>
        </select>
        <button name="update_status">Update Status</button>
    </form>
</div>

<br>

<!-- BILLING DETAILS -->
<?php
$bill = mysqli_query($conn,
    "SELECT * FROM billing_details WHERE order_id=$order_id"
);
$billing = mysqli_fetch_assoc($bill);
?>

<?php if ($billing) { ?>
<div class="billing-form">
    <h3>Billing Information</h3>
    <p><strong>Name:</strong> <?php echo $billing['full_name']; ?></p>
    <p><strong>Mobile:</strong> <?php echo $billing['mobile']; ?></p>
    <p><strong>Address:</strong> <?php echo $billing['address']; ?></p>
    <p><strong>City:</strong> <?php echo $billing['city']; ?></p>
    <p><strong>Pincode:</strong> <?php echo $billing['pincode']; ?></p>
</div>
<?php } ?>

<br>

<!-- ORDER ITEMS -->
<?php
$res = mysqli_query($conn,
    "SELECT p.name, p.flavor, oi.quantity, oi.price
     FROM order_items oi
     JOIN products p ON oi.product_id = p.id
     WHERE oi.order_id=$order_id"
);

$total = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $sub = $row['quantity'] * $row['price'];
    $total += $sub;
?>
<div class="cart-item">
    <div class="cart-details">
        <h4><?php echo $row['name']; ?> (<?php echo $row['flavor']; ?>)</h4>
        <p>Quantity: <?php echo $row['quantity']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
        <p><strong>Subtotal: ₹<?php echo $sub; ?></strong></p>
    </div>
</div>
<?php } ?>

<div class="cart-total">
    Total Order Amount: ₹<?php echo $total; ?>
</div>

<br>
<a href="orders.php" class="add-cart-btn">← Back to Orders</a>

</div>

</body>
</html>
