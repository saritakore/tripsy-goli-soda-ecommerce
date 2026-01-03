<?php
session_start();
include("config.php");

/* Initialize cart */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$isLoggedIn = isset($_SESSION['user_id']);

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

<!-- Continue Shopping -->
<div class="continue-shopping">
    <a href="products.php">← Continue Shopping</a>
</div>

<!-- Cart Total -->
<div class="cart-total">
    <h3>Total: ₹<?php echo $total; ?></h3>
</div>

<!-- LOGIN OR BILLING SECTION -->
<div class="cart-wrapper">

<?php if (!$isLoggedIn && !empty($_SESSION['cart'])) { ?>

    <!-- Not logged in -->
    <div class="login-required">
        <p>Please login to continue checkout</p>
        <a href="login.php" class="checkout-btn">Login to Continue</a>
    </div>

<?php } elseif ($isLoggedIn && !empty($_SESSION['cart'])) { ?>

    <!-- Logged in → Billing Form -->
    <form method="POST" action="checkout.php" class="billing-form">

        <h3>Billing Details</h3>

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <textarea name="address" placeholder="Full Address" required></textarea>

        <div class="billing-row">
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="pincode" placeholder="Pincode" required>
        </div>

        <input type="hidden" name="total" value="<?php echo $total; ?>">

        <button type="submit" class="checkout-btn">
            Proceed to Place Order
        </button>

    </form>

<?php } ?>

</div>

</body>
</html>
