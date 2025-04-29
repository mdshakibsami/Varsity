<?php
$conn = mysqli_connect("localhost", "root", "", "image_gallery");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $title = $_POST['title'];
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) mkdir($targetDir);

    $targetFile = $targetDir . basename($imageName);

    if (move_uploaded_file($tmpName, $targetFile)) {
        $sql = "INSERT INTO gallery (title, image_path) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $title, $targetFile);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Image uploaded successfully!";
        } else {
            $message = "Database error.";
        }
    } else {
        $message = "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Upload Image</title></head>
<body>
<h2>Upload Image to Gallery</h2>
<?php if ($message) echo "<p><strong>$message</strong></p>"; ?>

<form method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br><br>
    Select Image: <input type="file" name="image" accept="image/*" required><br><br>
    <input type="submit" value="Upload">
</form>

<br><a href="view_gallery.php">View Gallery</a>
</body>
</html>
