<?php
include("auth.php");
include("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<h2 class="cart-title">Registered Customers</h2>

<div class="cart-wrapper">

<table border="1" width="100%" cellpadding="10">
    <tr style="background:#f2f2f2;">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Registered On</th>
    </tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($res)) {
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['mobile']; ?></td>
    <td><?php echo date("d M Y", strtotime($row['created_at'])); ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
