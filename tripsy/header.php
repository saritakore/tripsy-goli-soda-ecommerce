<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<header>
    <div class="navbar">

        <!-- Logo -->
        <div class="logo">
            <img src="uploads/logo.png" alt="Tripsy Logo">
            <h2>Tripsy Goli Soda</h2>
        </div>

        <!-- Right Side -->
        <div class="nav-right">

            <!-- Search -->
            <form class="search-box" action="products.php" method="GET">
                <input type="text" name="search" placeholder="Search products...">
            </form>

            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="products.php">Products</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>

            </div>

            <!-- My Account -->
            <div class="account-menu">
                <span class="account-icon">👤</span>
                <div class="account-dropdown">
                    <?php if (!isset($_SESSION['user_id'])) { ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php } else { ?>
                        <a href="my_profile.php">My Profile</a>
                        <a href="cart.php">My Cart</a>
                        <a href="my_orders.php">My Orders</a>
                        <a href="logout.php">Logout</a>
                    <?php } ?>
                </div>
            </div>

            <!-- Cart -->
            <a href="cart.php" class="cart-icon">
                🛒 <span class="cart-count"><?php echo $cartCount; ?></span>
            </a>

        </div>
    </div>
</header>
