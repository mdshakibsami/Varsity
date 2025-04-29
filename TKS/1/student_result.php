<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$roll_no = $_POST['roll_no'];
$address = $_POST['address'];

// Basic validation in PHP (for safety even if JS fails)
if (empty($name) || empty($email) || empty($phone) || empty($dob) ||
    empty($gender) || empty($department) || empty($roll_no) || empty($address)) {
    die("All fields are required.");
}

// Prepared statement for security
$sql = "INSERT INTO students (name, email, phone, dob, gender, department, roll_no, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phone, $dob, $gender, $department, $roll_no, $address);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h2>Student Data Saved Successfully!</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Attribute</th><th>Value</th></tr>";
        echo "<tr><td>Name</td><td>$name</td></tr>";
        echo "<tr><td>Email</td><td>$email</td></tr>";
        echo "<tr><td>Phone</td><td>$phone</td></tr>";
        echo "<tr><td>Date of Birth</td><td>$dob</td></tr>";
        echo "<tr><td>Gender</td><td>$gender</td></tr>";
        echo "<tr><td>Department</td><td>$department</td></tr>";
        echo "<tr><td>Roll No</td><td>$roll_no</td></tr>";
        echo "<tr><td>Address</td><td>$address</td></tr>";
        echo "</table>";
    }    
     else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
