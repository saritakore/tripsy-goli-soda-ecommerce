<?php
session_start();
include("config.php");

/* ===== SEARCH LOGIC ===== */
$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if ($search != "") {
    $query = "
        SELECT * FROM products
        WHERE status='Active'
        AND stock > 0
        AND (name LIKE '%$search%' OR flavor LIKE '%$search%')
    ";
} else {
    $query = "
        SELECT * FROM products
        WHERE status='Active'
        AND stock > 0
    ";
}

$res = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="products-container">
    <h2>Tripsy Goli Soda – Products</h2>

    <?php if ($search != "") { ?>
        <p style="margin-bottom:15px;">
            Showing results for: <strong><?php echo htmlspecialchars($search); ?></strong>
        </p>
    <?php } ?>

    <div class="products-grid">

        <?php
        if (mysqli_num_rows($res) == 0) {
            echo "<p>No products found.</p>";
        }

        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <div class="product-card">
                <img src="uploads/<?php echo $row['image']; ?>"
                     alt="<?php echo $row['flavor']; ?>">

                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['flavor']; ?></p>
                <p>₹<?php echo $row['price']; ?></p>

                <a href="cart.php?action=add&id=<?php echo $row['id']; ?>"
                   class="add-cart-btn">
                    Add to Cart
                </a>
            </div>
        <?php } ?>

    </div>
</div>

</body>
</html>
