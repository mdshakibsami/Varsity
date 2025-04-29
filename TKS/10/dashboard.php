<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        .logout { float: right; }
    </style>
</head>
<body>

<h1>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?>!</h1>

<a class="logout" href="logout.php">Logout</a>

<hr>

<h2>Demo Page</h2>
<p>This is a protected page accessible only after login.</p>

</body>
</html>
