<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">My Orders</h2>

<div class="cart-wrapper">

<?php
$res = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE user_id = $user_id 
     ORDER BY id DESC"
);

if (mysqli_num_rows($res) == 0) {
    echo "<p class='empty-cart'>You have not placed any orders yet.</p>";
} else {

    while ($order = mysqli_fetch_assoc($res)) {
?>

<div class="cart-item">

    <div class="cart-details">
        <h4>Order ID: <?php echo $order['id']; ?></h4>

        <p>
            <strong>Order Date:</strong>
            <?php echo date("d M Y", strtotime($order['order_date'])); ?>
        </p>

        <p>
            <strong>Total Amount:</strong>
            ₹<?php echo $order['total_amount']; ?>
        </p>

        <!-- ORDER STATUS -->
        <p>
            <strong>Status:</strong>
            <span class="order-status <?php echo strtolower($order['status']); ?>">
                <?php echo $order['status']; ?>
            </span>
        </p>

        <!-- STATUS MESSAGE -->
        <?php
        if ($order['status'] == 'Pending') {
            echo "<p>Your order is being processed.</p>";
        } elseif ($order['status'] == 'Confirmed') {
            echo "<p>Your order has been confirmed.</p>";
        } elseif ($order['status'] == 'Dispatched') {
            echo "<p>Your order is on the way 🚚</p>";
        } elseif ($order['status'] == 'Delivered') {
            echo "<p>Order delivered successfully ✅</p>";
        } elseif ($order['status'] == 'Cancelled') {
            echo "<p>Order was cancelled.</p>";
        }
        ?>

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
