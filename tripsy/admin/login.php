<?php
session_start();
include("../config.php");

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $res = mysqli_query($conn,
        "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    if (mysqli_num_rows($res) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="form-box">
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
</div>

</body>
</html>
