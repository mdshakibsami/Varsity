<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data
$sql = "SELECT * FROM students_table";
$result = mysqli_query($conn, $sql);

// Show data
echo "<h2>Student Profiles</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Roll No</th>
            <th>Address</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['department']}</td>
                <td>{$row['roll_no']}</td>
                <td>{$row['address']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No student profiles found.";
}

// Close connection
mysqli_close($conn);
?>
