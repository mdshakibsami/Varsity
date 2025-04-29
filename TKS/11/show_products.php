<?php
$conn = mysqli_connect("localhost", "root", "", "electronics_store");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM electronics");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Electronics Products</title>
</head>
<body>
<h2>Electronics Products List</h2>
<a href="electronics_form.php">← Back to Product Entry</a><br><br>

<?php if (mysqli_num_rows($result) > 0): ?>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Name</th><th>Brand</th><th>Model</th><th>Price</th><th>Quantity</th>
        <th>Description</th><th>Warranty</th><th>Added On</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['brand']) ?></td>
            <td><?= htmlspecialchars($row['model']) ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= $row['warranty_years'] ?> years</td>
            <td><?= $row['added_on'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

</body>
</html>

<?php mysqli_close($conn); ?>
