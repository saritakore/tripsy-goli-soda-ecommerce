<?php
session_start();
include("config.php");

/* Security check */
if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* ======================
   GET DATA FROM CHECKOUT
   ====================== */
$name     = $_POST['name'];
$mobile   = $_POST['mobile'];
$address  = $_POST['address'];
$city     = $_POST['city'];
$pincode  = $_POST['pincode'];

$subtotal = $_POST['subtotal'];
$delivery = $_POST['delivery_charge'];
$total    = $_POST['total'];
$payment  = $_POST['payment_method'];

/* ======================
   SAVE BILLING DETAILS
   ====================== */
mysqli_query($conn, "
    INSERT INTO billing_details
    (user_id, full_name, mobile, address, city, pincode)
    VALUES (
        '$user_id',
        '$name',
        '$mobile',
        '$address',
        '$city',
        '$pincode'
    )
");

/* ======================
   CREATE ORDER
   ====================== */
mysqli_query($conn, "
    INSERT INTO orders
    (user_id, subtotal, delivery_charge, total_amount, payment_method, status)
    VALUES (
        '$user_id',
        '$subtotal',
        '$delivery',
        '$total',
        '$payment',
        'Pending'
    )
");

$order_id = mysqli_insert_id($conn);

/* ======================
   SAVE ORDER ITEMS
   ====================== */
foreach ($_SESSION['cart'] as $pid => $qty) {

    $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$pid");
    $row = mysqli_fetch_assoc($res);

    $price = $row['price'];

    mysqli_query($conn, "
        INSERT INTO order_items
        (order_id, product_id, quantity, price)
        VALUES (
            '$order_id',
            '$pid',
            '$qty',
            '$price'
        )
    ");
}

/* ======================
   CLEAR CART
   ====================== */
unset($_SESSION['cart']);

/* ======================
   REDIRECT TO BILL PAGE
   ====================== */
header("Location: bill.php?order_id=$order_id");
exit;
