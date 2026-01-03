<?php
session_start();
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tripsy Goli Soda | Andodagi & Son’s</title>
    <!-- IMPORTANT: correct CSS path -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include("header.php"); ?>



<!-- HERO SECTION (FULL BACKGROUND IMAGE FROM CSS) -->
<section class="hero">
    <div class="hero-text">
        <h1>
            Traditional Taste,<br>
            <span>Modern Refreshment</span>
        </h1>
        <p>Tripsy Goli Soda – Classic Indian Flavours</p>
        <button onclick="location.href='products.php'">Shop Now</button>
    </div>
</section>


<!-- ABOUT CARD -->
<div class="about-card">
    <h3>About Andodagi & Son’s</h3>
    <p>
        Andodagi & Son’s is a small-scale beverage manufacturing company
        located at Kumbhari, South Solapur, Maharashtra.
        We specialize in producing Tripsy Goli Soda with traditional Indian
        flavours using modern hygienic processes.
    </p>
</div>

<!-- WHY CHOOSE + FEEDBACK -->
<section class="why-choose" id="contact">

    <div class="features">
        <h3>Why Choose Tripsy?</h3>
        <ul>
            <li>Traditional Indian taste</li>
            <li>Hygienic manufacturing</li>
            <li>Multiple flavours & combo packs</li>
            <li>Affordable pricing</li>
        </ul>
    </div>

    <div class="feedback">
        <h4>Feedback</h4>
        <form>
            <input type="text" placeholder="Your Name" required>
            <textarea placeholder="Your Feedback" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>

</section>

<!-- POPULAR PRODUCTS -->
<div class="section">
    <h2>Popular Flavors & Packs</h2>

    <div class="products-grid">
        <div class="product-card">
            <img src="uploads/lemon_goli_soda.png" alt="Lemon Goli Soda">
            <p>Lemon Goli Soda</p>
        </div>

        <div class="product-card">
            <img src="uploads/orange_goli_soda.png" alt="Orange Goli Soda">
            <p>Orange Goli Soda</p>
        </div>

        <div class="product-card">
            <img src="uploads/kala_khatta_goli_soda.png" alt="Kala Khatta">
            <p>Kala Khatta</p>
        </div>

        <div class="product-card">
            <img src="uploads/family_pack.png" alt="Family Pack">
            <p>Family Pack</p>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    Andodagi & Son’s | Kumbhari, South Solapur, Maharashtra – 413006
</footer>

</body>
</html>
