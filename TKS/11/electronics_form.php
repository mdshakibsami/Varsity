<?php
$conn = mysqli_connect("localhost", "root", "", "electronics_store");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $warranty = $_POST['warranty'];

    $sql = "INSERT INTO electronics (name, brand, model, price, quantity, description, warranty_years) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssdisi", $name, $brand, $model, $price, $quantity, $description, $warranty);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Product added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Electronics Product</title>
</head>
<body>
<h2>Electronics Product Entry</h2>
<?php if ($message) echo "<p><strong>$message</strong></p>"; ?>

<form method="post" action="">
    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Brand:</label><br>
    <input type="text" name="brand" required><br><br>

    <label>Model:</label><br>
    <input type="text" name="model" required><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Warranty (Years):</label><br>
    <input type="number" name="warranty" required><br><br>

    <input type="submit" name="submit" value="Add Product">
</form>

<br>
<form method="get" action="show_products.php">
    <button type="submit">Show All Products</button>
</form>
</body>
</html>

<?php mysqli_close($conn); ?>
