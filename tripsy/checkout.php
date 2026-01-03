<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* Save billing details */
mysqli_query($conn, "
    INSERT INTO billing_details
    (user_id, full_name, mobile, address, city, pincode)
    VALUES (
        '$user_id',
        '{$_POST['name']}',
        '{$_POST['mobile']}',
        '{$_POST['address']}',
        '{$_POST['city']}',
        '{$_POST['pincode']}'
    )
");

/* Create order */
$total = $_POST['total'];
mysqli_query($conn, "
    INSERT INTO orders (user_id, total_amount)
    VALUES ('$user_id', '$total')
");

$order_id = mysqli_insert_id($conn);

/* Insert order items */
foreach ($_SESSION['cart'] as $pid => $qty) {

    $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$pid");
    $row = mysqli_fetch_assoc($res);

    $price = $row['price'];

    mysqli_query($conn, "
        INSERT INTO order_items
        (order_id, product_id, quantity, price)
        VALUES ('$order_id', '$pid', '$qty', '$price')
    ");
}

/* Clear cart */
unset($_SESSION['cart']);

/* Redirect to bill */
header("Location: bill.php?order_id=$order_id");
exit;
