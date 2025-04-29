<?php
$conn = mysqli_connect("localhost", "root", "", "student_management");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name']; $email = $_POST['email']; $phone = $_POST['phone'];
    $dob = $_POST['dob']; $gender = $_POST['gender']; $department = $_POST['department'];
    $roll_no = $_POST['roll_no']; $address = $_POST['address'];

    $sql = "UPDATE students SET name=?, email=?, phone=?, dob=?, gender=?, department=?, roll_no=?, address=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $phone, $dob, $gender, $department, $roll_no, $address, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: student_list.php");
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
<h2>Edit Student Profile</h2>
<form method="post" action="">
    Name: <input type="text" name="name" value="<?= $data['name'] ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>
    Phone: <input type="text" name="phone" value="<?= $data['phone'] ?>" required><br><br>
    DOB: <input type="date" name="dob" value="<?= $data['dob'] ?>" required><br><br>
    Gender: 
    <select name="gender" required>
        <option value="Male" <?= $data['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $data['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select><br><br>
    Department: <input type="text" name="department" value="<?= $data['department'] ?>" required><br><br>
    Roll No: <input type="text" name="roll_no" value="<?= $data['roll_no'] ?>" required><br><br>
    Address: <textarea name="address" required><?= $data['address'] ?></textarea><br><br>
    <input type="submit" name="update" value="Update Student">
</form>
<br>
<a href="student_list.php">← Back to List</a>
</body>
</html>
