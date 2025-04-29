<?php
$conn = mysqli_connect("localhost", "root", "", "student_management");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: student_list.php");
}
$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head><title>Student List</title></head>
<body>
<h2>All Student Profiles</h2>
<a href="student_form.php">Add New Student</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th>
        <th>Department</th><th>Roll No</th><th>Address</th><th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td><td><?= $row['name'] ?></td><td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td><td><?= $row['dob'] ?></td><td><?= $row['gender'] ?></td>
            <td><?= $row['department'] ?></td><td><?= $row['roll_no'] ?></td><td><?= $row['address'] ?></td>
            <td>
                <a href="student_edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="student_list.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
