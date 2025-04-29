<?php
$conn = mysqli_connect("localhost", "root", "", "graduate_admission");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $previous_degree = $_POST['previous_degree'];
    $cgpa = $_POST['cgpa'];

    // Upload photo
    $photo = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $photo = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
    }

    $sql = "INSERT INTO applications (full_name, email, phone, dob, gender, department, previous_degree, cgpa, photo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssss", $full_name, $email, $phone, $dob, $gender, $department, $previous_degree, $cgpa, $photo);


    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($conn);
        header("Location: show_application.php?id=$last_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Graduate Admission Form</title>
</head>
<body>
    <h2>Online Graduate Admission Form</h2>
    <form method="post" enctype="multipart/form-data">
        Full Name: <input type="text" name="full_name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        Date of Birth: <input type="date" name="dob" required><br><br>
        Gender: 
        <select name="gender" required>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select><br><br>
        Department: <input type="text" name="department" required><br><br>
        Previous Degree: <input type="text" name="previous_degree" required><br><br>
        CGPA: <input type="text" name="cgpa" required><br><br>
        Photo: <input type="file" name="photo" accept="image/*"><br><br>

        <input type="submit" value="Submit Application">
    </form>
</body>
</html>
