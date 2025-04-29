<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "product_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $manufacturer = $_POST["manufacturer"];
    $added_on = $_POST["added_on"];

    $sql = "INSERT INTO products (name, category, price, quantity, description, manufacturer, added_on) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdisss", $name, $category, $price, $quantity, $description, $manufacturer, $added_on);
        mysqli_stmt_execute($stmt);
        echo "<h3>Product inserted successfully.</h3>";
    } else {
        echo "Error preparing statement.";
    }

    mysqli_close($conn);
}
?>

<h2>Insert Product</h2>
<form method="post" action="">
    Name: <input type="text" name="name" required><br><br>
    Category: <input type="text" name="category" required><br><br>
    Price: <input type="number" name="price" required><br><br>
    Quantity: <input type="number" name="quantity" required><br><br>
    Description: <input type="text" name="description" required><br><br>
    Manufacturer: <input type="text" name="manufacturer" required><br><br>
    Date Added: <input type="date" name="added_on" required><br><br>
    <input type="submit" value="Insert Product">
</form>

<br>
<button><a href="product_list.php">View All Products</a></button>
