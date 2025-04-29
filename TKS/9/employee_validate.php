<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "employee_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$name = $email = $phone = $designation = $department = $salary = $address = "";
$errors = [];
$showData = false; // Track if "Show Data" button is clicked

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Handle form submission

        // Validate each input
        if (empty($_POST["name"])) {
            $errors[] = "Name is required";
        } else {
            $name = htmlspecialchars(trim($_POST["name"]));
        }

        if (empty($_POST["email"])) {
            $errors[] = "Email is required";
        } else {
            $email = trim($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
        }

        if (empty($_POST["phone"])) {
            $errors[] = "Phone is required";
        } else {
            $phone = trim($_POST["phone"]);
            if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
                $errors[] = "Phone must be 10-15 digits";
            }
        }

        if (empty($_POST["designation"])) {
            $errors[] = "Designation is required";
        } else {
            $designation = htmlspecialchars(trim($_POST["designation"]));
        }

        if (empty($_POST["department"])) {
            $errors[] = "Department is required";
        } else {
            $department = htmlspecialchars(trim($_POST["department"]));
        }

        if (empty($_POST["salary"])) {
            $errors[] = "Salary is required";
        } else {
            $salary = trim($_POST["salary"]);
            if (!is_numeric($salary) || $salary <= 0) {
                $errors[] = "Salary must be a positive number";
            }
        }

        if (empty($_POST["address"])) {
            $errors[] = "Address is required";
        } else {
            $address = htmlspecialchars(trim($_POST["address"]));
        }

        // If no errors, insert into database
        if (empty($errors)) {
            $sql = "INSERT INTO employees9 (name, email, phone, designation, department, salary, address)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $phone, $designation, $department, $salary, $address);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p style='color:green'>Employee added successfully.</p>";
            } else {
                echo "<p style='color:red'>Error: " . mysqli_error($conn) . "</p>";
            }

            mysqli_stmt_close($stmt);
        }
    }
    elseif (isset($_POST['show'])) {
        // If "Show Data" button is clicked
        $showData = true;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Validation Form (PHP)</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        input, textarea { width: 300px; padding: 5px; margin: 5px 0; }
        label { display: block; margin-top: 10px; }
        .form-box { border: 1px solid #ccc; padding: 20px; width: 400px; }
        .error { color: red; }
        .show-data { margin-top: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
    </style>
</head>
<body>

<h2>Employee Profile Form</h2>

<div class="form-box">
    <?php
    if (!empty($errors)) {
        echo "<div class='error'><ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">

        <label>Email:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>">

        <label>Designation:</label>
        <input type="text" name="designation" value="<?= htmlspecialchars($designation) ?>">

        <label>Department:</label>
        <input type="text" name="department" value="<?= htmlspecialchars($department) ?>">

        <label>Salary:</label>
        <input type="text" name="salary" value="<?= htmlspecialchars($salary) ?>">

        <label>Address:</label>
        <textarea name="address"><?= htmlspecialchars($address) ?></textarea>

        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="show" value="Show All Employees">
    </form>
</div>

<?php
if ($showData) {
    $conn = mysqli_connect("localhost", "root", "", "employee_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM employees9";
    $result = mysqli_query($conn, $sql);

    echo "<div class='show-data'>";
    echo "<h2>All Employees</h2>";

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Designation</th><th>Department</th><th>Salary</th><th>Address</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['designation']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['salary']}</td>
                    <td>{$row['address']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No data found.</p>";
    }

    echo "</div>";

    mysqli_close($conn);
}
?>

</body>
</html>
