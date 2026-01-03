<?php
include("../config.php");
$res = mysqli_query($conn,"SELECT * FROM products");
?>



<h2>Manage Products</h2>

<table border="1" cellpadding="8">
<tr>
  <th>Image</th>
  <th>Flavor</th>
  <th>Price</th>
  <th>Stock</th>
  <th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
  <td>
    <img src="../uploads/<?php echo $row['image']; ?>" width="60">
  </td>
  <td><?php echo $row['flavor']; ?></td>
  <td>₹<?php echo $row['price']; ?></td>
  <td><?php echo $row['stock']; ?></td>
  <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>
