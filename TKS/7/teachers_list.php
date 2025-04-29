<?php
$conn = mysqli_connect("localhost", "root", "", "teacher_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM teachers";
$result = mysqli_query($conn, $sql);

echo "<h2>Teachers List</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Department</th><th>Address</th><th>Action</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['subject']}</td>
            <td>{$row['department']}</td>
            <td>{$row['address']}</td>
            <td><a href='edit_teacher.php?id={$row['id']}'>Edit</a></td>
          </tr>";
}

echo "</table>";

mysqli_close($conn);
?>
