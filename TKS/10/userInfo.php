<?php
$conn = mysqli_connect("localhost", "root", "", "admin_panel_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert demo admin (username: admin, password: 12345)
$username = "admin";
$password = password_hash("12345", PASSWORD_DEFAULT); // Encrypt password

$sql = "INSERT INTO admin_users (username, password) VALUES ('$username', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "Demo admin inserted.";
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
