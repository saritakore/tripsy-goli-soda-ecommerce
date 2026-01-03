<?php
session_start();
include("config.php");

if (isset($_POST['register'])) {

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    /* Password match check */
    if ($password != $confirm) {
        $error = "Passwords do not match";
    } else {

        /* Check if email already exists */
        $check = mysqli_query($conn,
            "SELECT id FROM users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {
            $error = "Email already registered";
        } else {

            $hash = md5($password);

            mysqli_query($conn, "
                INSERT INTO users (name, email, mobile, password)
                VALUES ('$name', '$email', '$mobile', '$hash')
            ");

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="form-box">
    <h2>Create Account</h2>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Full Name"
               required>

        <input type="email"
               name="email"
               placeholder="Email Address"
               required>

        <input type="text"
               name="mobile"
               placeholder="Mobile Number"
               pattern="[0-9]{10}"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <input type="password"
               name="confirm_password"
               placeholder="Confirm Password"
               required>

        <button name="register">Register</button>

    </form>

    <p class="center">
        Already registered?
        <a href="login.php">Login here</a>
    </p>
</div>

</body>
</html>
