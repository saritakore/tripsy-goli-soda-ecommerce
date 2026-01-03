<?php
include("auth.php");
include("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">All Orders</h2>

<div class="cart-wrapper">

<?php
$res = mysqli_query($conn, "
    SELECT o.id, o.order_date, o.total_amount, u.name
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
");

if (mysqli_num_rows($res) == 0) {
    echo "<p class='empty-cart'>No orders found.</p>";
} else {

    while ($order = mysqli_fetch_assoc($res)) {
?>
    <div class="cart-item">
        <div class="cart-details">
            <h4>Order ID: <?php echo $order['id']; ?></h4>
            <p>Customer: <?php echo $order['name']; ?></p>
            <p>Date: <?php echo date("d M Y", strtotime($order['order_date'])); ?></p>
            <p>Total: ₹<?php echo $order['total_amount']; ?></p>

            <a href="order_details.php?order_id=<?php echo $order['id']; ?>"
               class="add-cart-btn">
               View Details
            </a>
        </div>
    </div>
<?php } } ?>

</div>

</body>
</html>
