<?php
$conn = mysqli_connect("localhost", "root", "", "image_gallery");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <style>
        .gallery { display: flex; flex-wrap: wrap; gap: 20px; }
        .item { border: 1px solid #ccc; padding: 10px; width: 200px; }
        .item img { width: 100%; height: auto; }
    </style>
</head>
<body>
<h2>Image Gallery</h2>
<a href="upload_image.php">Upload New Image</a><br><br>

<div class="gallery">
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="item">
        <img src="<?= $row['image_path'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
        <p><strong><?= htmlspecialchars($row['title']) ?></strong></p>
    </div>
<?php endwhile; ?>
</div>
</body>
</html>
