<?php
include("auth.php");
include("../config.php");

$res = mysqli_query($conn, "SELECT * FROM company_details LIMIT 1");
$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {

    $company = $_POST['company_name'];
    $brand   = $_POST['brand_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email   = $_POST['email'];

    if ($_FILES['logo']['name'] != "") {
        $logo = $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], "../uploads/".$logo);
    } else {
        $logo = $data['logo'];
    }

    mysqli_query($conn, "
        UPDATE company_details SET
        company_name='$company',
        brand_name='$brand',
        address='$address',
        contact='$contact',
        email='$email',
        logo='$logo'
    ");

    header("Location: company_details.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">Company Details</h2>

<form method="POST" enctype="multipart/form-data" class="billing-form">

    <input type="text" name="company_name"
           value="<?php echo $data['company_name']; ?>" required>

    <input type="text" name="brand_name"
           value="<?php echo $data['brand_name']; ?>" required>

    <textarea name="address" required><?php echo $data['address']; ?></textarea>

    <input type="text" name="contact"
           value="<?php echo $data['contact']; ?>" required>

    <input type="email" name="email"
           value="<?php echo $data['email']; ?>" required>

    <input type="file" name="logo">

    <button name="update">Update Company Details</button>

</form>

</body>
</html>
