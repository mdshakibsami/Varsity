<?php
$conn = mysqli_connect("localhost", "root", "", "employee_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $salary     = $_POST['salary'];
    $hire_date  = $_POST['hire_date'];
    $address    = $_POST['address'];

    $sql = "INSERT INTO employees (name, email, phone, department, designation, salary, hire_date, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssdss", $name, $email, $phone, $department, $designation, $salary, $hire_date, $address);

        if (mysqli_stmt_execute($stmt)) {
            echo "<h2>Employee Data Saved Successfully</h2>";
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><td>Name</td><td>$name</td></tr>";
            echo "<tr><td>Email</td><td>$email</td></tr>";
            echo "<tr><td>Phone</td><td>$phone</td></tr>";
            echo "<tr><td>Department</td><td>$department</td></tr>";
            echo "<tr><td>Designation</td><td>$designation</td></tr>";
            echo "<tr><td>Salary</td><td>$salary</td></tr>";
            echo "<tr><td>Hire Date</td><td>$hire_date</td></tr>";
            echo "<tr><td>Address</td><td>$address</td></tr>";
            echo "</table><br>";
            echo '<a href="employee_form.php">Add Another Employee</a>';
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>
