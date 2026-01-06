<?php
session_start();
include("config.php");

/* Initialize cart */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$isLoggedIn = isset($_SESSION['user_id']);

/* Fetch user details if logged in */
$userData = null;
if ($isLoggedIn) {
    $uid = $_SESSION['user_id'];
    $userRes = mysqli_query(
        $conn,
        "SELECT name, email, mobile FROM users WHERE id = $uid"
    );
    $userData = mysqli_fetch_assoc($userRes);
}

/* Handle add / remove */
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] === 'add') {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }

    if ($_GET['action'] === 'remove') {
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id] > 1) {
                $_SESSION['cart'][$id]--;
            } else {
                unset($_SESSION['cart'][$id]);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">My Cart</h2>

<div class="cart-wrapper">

<?php
$total = 0;

if (empty($_SESSION['cart'])) {
    echo "<p class='empty-cart'>Cart is empty</p>";
} else {

    foreach ($_SESSION['cart'] as $id => $qty) {

        $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
        $row = mysqli_fetch_assoc($res);

        $subTotal = $row['price'] * $qty;
        $total += $subTotal;
?>

<div class="cart-item">

    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">

    <div class="cart-details">
        <h4><?php echo $row['name']; ?></h4>
        <p><?php echo $row['flavor']; ?></p>
        <p>₹<?php echo $row['price']; ?></p>

        <div class="qty-box">
            <a href="cart.php?action=remove&id=<?php echo $id; ?>">−</a>
            <span><?php echo $qty; ?></span>
            <a href="cart.php?action=add&id=<?php echo $id; ?>">+</a>
        </div>
    </div>

    <div class="cart-price">
        ₹<?php echo $subTotal; ?>
    </div>

</div>

<?php } } ?>

</div>

<?php
/* DELIVERY CHARGE LOGIC */
if ($total >= 499) {
    $delivery = 0;
    $deliveryText = "<span class='free-delivery'>FREE</span>";
} else {
    $delivery = 49;
    $deliveryText = "₹49";
}

$finalTotal = $total + $delivery;
?>

<!-- Continue Shopping -->
<div class="continue-shopping">
    <a href="products.php">← Continue Shopping</a>
</div>

<!-- BILL SUMMARY -->
<div class="cart-total">
    <p>Subtotal: ₹<?php echo $total; ?></p>
    <p>Delivery Charges: <?php echo $deliveryText; ?></p>
    <hr>
    <h3>Total Payable: ₹<?php echo $finalTotal; ?></h3>
</div>

<!-- LOGIN OR CHECKOUT -->
<div class="cart-wrapper">

<?php if (!$isLoggedIn && !empty($_SESSION['cart'])) { ?>

    <div class="login-required">
        <p>Please login to continue checkout</p>
        <a href="login.php" class="checkout-btn">Login to Continue</a>
    </div>

<?php } elseif ($isLoggedIn && !empty($_SESSION['cart'])) { ?>

    <form method="POST" action="checkout.php" class="billing-form">

        <h3>Billing Details</h3>

        <input type="text"
               value="<?php echo $userData['name']; ?>"
               readonly>

        <input type="email"
               value="<?php echo $userData['email']; ?>"
               readonly>

        <input type="text"
               value="<?php echo $userData['mobile']; ?>"
               readonly>

        <textarea name="address" placeholder="Full Address" required></textarea>

        <div class="billing-row">
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="pincode" placeholder="Pincode" required>
        </div>

        <h3>Payment Method</h3>
        <div class="payment-options">

            <label class="payment-option">
                <input type="radio" name="payment_method" value="COD" required>
                Cash on Delivery
            </label>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="Online">
                Online Payment
            </label>

        </div>

        <!-- HIDDEN TOTALS -->
        <input type="hidden" name="subtotal" value="<?php echo $total; ?>">
        <input type="hidden" name="delivery_charge" value="<?php echo $delivery; ?>">
        <input type="hidden" name="total" value="<?php echo $finalTotal; ?>">

        <button type="submit" class="checkout-btn">
            Place Order
        </button>

    </form>

<?php } ?>

</div>

</body>
</html>
