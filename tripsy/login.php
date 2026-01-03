<?php
session_start();
include("config.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email' AND password='$password'");

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];

        header("Location: products.php");
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>User Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
    <h2>User Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>
    </form>

    <p class="center">
        New user? <a href="register.php">Register here</a>
    </p>
</div>

</body>

</html>
