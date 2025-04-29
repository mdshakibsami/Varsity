<?php
$conn = mysqli_connect("localhost", "root", "", "student_management");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name']; $email = $_POST['email']; $phone = $_POST['phone'];
    $dob = $_POST['dob']; $gender = $_POST['gender']; $department = $_POST['department'];
    $roll_no = $_POST['roll_no']; $address = $_POST['address'];

    $sql = "INSERT INTO students (name, email, phone, dob, gender, department, roll_no, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phone, $dob, $gender, $department, $roll_no, $address);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Student profile saved successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Student</title></head>
<body>
<h2>Add Student Profile</h2>
<?php if ($message) echo "<p><strong>$message</strong></p>"; ?>

<form method="post" action="">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    Date of Birth: <input type="date" name="dob" required><br><br>
    Gender: 
    <select name="gender" required>
        <option value="">Select</option>
        <option value="Male">Male</option><option value="Female">Female</option>
    </select><br><br>
    Department: <input type="text" name="department" required><br><br>
    Roll No: <input type="text" name="roll_no" required><br><br>
    Address: <textarea name="address" required></textarea><br><br>
    <input type="submit" value="Save Student">
</form>

<br>
<a href="student_list.php">View Student List</a>
</body>
</html>
