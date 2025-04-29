<?php
$conn = mysqli_connect("localhost", "root", "", "graduate_admission");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM applications WHERE id = $id");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head><title>Application Profile</title></head>
<body>
    <h2>Applicant Profile</h2>
    <table border="1" cellpadding="10">
        <tr><th>Full Name</th><td><?= htmlspecialchars($data['full_name']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($data['email']) ?></td></tr>
        <tr><th>Phone</th><td><?= htmlspecialchars($data['phone']) ?></td></tr>
        <tr><th>Date of Birth</th><td><?= $data['dob'] ?></td></tr>
        <tr><th>Gender</th><td><?= $data['gender'] ?></td></tr>
        <tr><th>Department</th><td><?= htmlspecialchars($data['department']) ?></td></tr>
        <tr><th>Previous Degree</th><td><?= htmlspecialchars($data['previous_degree']) ?></td></tr>
        <tr><th>CGPA</th><td><?= $data['cgpa'] ?></td></tr>
        <tr><th>Photo</th>
            <td>
                <?php if ($data['photo']) echo "<img src='{$data['photo']}' width='150'>"; else echo "No photo"; ?>
            </td>
        </tr>
    </table>

    <br><a href="apply.php">Submit Another Application</a>
</body>
</html>
