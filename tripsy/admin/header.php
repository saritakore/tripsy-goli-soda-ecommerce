<?php
include("auth.php"); // protect admin pages
?>

<header style="background:#0b1a5e; padding:15px;">
    <nav style="display:flex; justify-content:space-between; align-items:center; color:white;">

        <h3>Admin Panel – Tripsy Goli Soda</h3>

        <div style="display:flex; gap:20px;">
            <a href="dashboard.php" style="color:white;">Dashboard</a>
            <a href="products.php" style="color:white;">Products</a>
            <a href="orders.php" style="color:white;">Orders</a>
            <a href="customers.php" style="color:white;">Customers</a>
            <a href="company_details.php" style="color:white;">Company</a>
            <a href="logout.php" style="color:white;">Logout</a>
        </div>

    </nav>
</header>
