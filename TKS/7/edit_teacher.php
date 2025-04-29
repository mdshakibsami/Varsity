<?php
$conn = mysqli_connect("localhost", "root", "", "teacher_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM teachers WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
?>
        <h2>Edit Teacher Profile</h2>
        <form action="edit_teacher.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
            Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
            Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
            Subject: <input type="text" name="subject" value="<?php echo $row['subject']; ?>"><br><br>
            Department: <input type="text" name="department" value="<?php echo $row['department']; ?>"><br><br>
            Address: <textarea name="address"><?php echo $row['address']; ?></textarea><br><br>
            <input type="submit" name="update" value="Update">
        </form>
<?php
    } else {
        echo "Teacher not found.";
    }
} elseif (isset($_POST['update'])) {
    // Update code here
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update_sql = "UPDATE teachers 
                   SET name='$name', email='$email', phone='$phone', subject='$subject', department='$department', address='$address' 
                   WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<h2>Teacher Profile Updated Successfully!</h2>";
        echo "<a href='teachers_list.php'>Go Back to List</a>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request.";
}

mysqli_close($conn);
?>
