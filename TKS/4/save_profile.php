<?php
$conn = mysqli_connect("localhost", "root", "", "profile_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $hobby = $_POST['hobby'];

    $sql = "INSERT INTO personal_profile (full_name, email, phone, dob, gender, nationality, address, hobby)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $full_name, $email, $phone, $dob, $gender, $nationality, $address, $hobby);

    if (mysqli_stmt_execute($stmt)) {
        echo "<h2>Your Profile</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Attribute</th><th>Value</th></tr>";
        echo "<tr><td>Full Name</td><td>$full_name</td></tr>";
        echo "<tr><td>Email</td><td>$email</td></tr>";
        echo "<tr><td>Phone</td><td>$phone</td></tr>";
        echo "<tr><td>Date of Birth</td><td>$dob</td></tr>";
        echo "<tr><td>Gender</td><td>$gender</td></tr>";
        echo "<tr><td>Nationality</td><td>$nationality</td></tr>";
        echo "<tr><td>Address</td><td>$address</td></tr>";
        echo "<tr><td>Hobby</td><td>$hobby</td></tr>";
        echo "</table><br>";
        echo '<a href="profile_form.php">Go Back to Form</a>';
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
