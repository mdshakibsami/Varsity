<?php
$conn = mysqli_connect("localhost", "root", "", "product_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

echo "<h2>Product List</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Quantity</th>
        <th>Description</th><th>Manufacturer</th><th>Date Added</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>{$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['description']}</td>
            <td>{$row['manufacturer']}</td>
            <td>{$row['added_on']}</td>
          </tr>";
}

echo "</table>";
echo "<br>";
echo "<button><a href='product_form.php'>Back to Home</a></button>";

mysqli_close($conn);
?>
