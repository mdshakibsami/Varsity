<?php
$conn = mysqli_connect("localhost", "root", "", "user_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing
$email = $_POST['email'];
$full_name = $_POST['full_name'];
$contact = $_POST['contact'];

$sql = "INSERT INTO users (username, password, email, full_name, contact)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $username, $password, $email, $full_name, $contact);

if (mysqli_stmt_execute($stmt)) {
    echo "Registration successful! <a href='login.php'>Login now</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
