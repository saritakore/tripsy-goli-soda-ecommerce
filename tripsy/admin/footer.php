<?php
include("config.php");
$res = mysqli_query($conn, "SELECT * FROM company_details LIMIT 1");
$company = mysqli_fetch_assoc($res);
?>

<footer>
    <p>
        <?php echo $company['company_name']; ?> |
        <?php echo $company['address']; ?>
    </p>
    <p>
        Contact: <?php echo $company['contact']; ?> |
        Email: <?php echo $company['email']; ?>
    </p>
</footer>
