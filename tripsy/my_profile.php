<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">My Profile</h2>

<div class="cart-wrapper">

<div class="billing-form">
    <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Mobile:</strong> <?php echo $user['mobile']; ?></p>
    <p><strong>Joined On:</strong>
        <?php echo date("d M Y", strtotime($user['created_at'])); ?>
    </p>
</div>

</div>

</body>
</html>
