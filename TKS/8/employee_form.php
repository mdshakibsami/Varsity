<?php
// PHP code: Insert data after form submit
$conn = mysqli_connect("localhost", "root", "", "employee_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO employees8 (name, email, phone, designation, department, salary, address) 
            VALUES ('$name', '$email', '$phone', '$designation', '$department', '$salary', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "<h3>Employee Profile Saved Successfully!</h3>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Profile Form</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        input, textarea { width: 300px; margin: 5px; }
        label { display: inline-block; width: 120px; }
        .form-container { border: 1px solid #ccc; padding: 20px; width: 450px; }
    </style>

    <script>
        function validateForm() {
            var name = document.forms["empForm"]["name"].value;
            var email = document.forms["empForm"]["email"].value;
            var phone = document.forms["empForm"]["phone"].value;
            var designation = document.forms["empForm"]["designation"].value;
            var department = document.forms["empForm"]["department"].value;
            var salary = document.forms["empForm"]["salary"].value;
            var address = document.forms["empForm"]["address"].value;

            if (name == "" || email == "" || phone == "" || designation == "" || department == "" || salary == "" || address == "") {
                alert("All fields must be filled out");
                return false;
            }

            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Invalid email address");
                return false;
            }

            var phonePattern = /^[0-9]{10,15}$/;
            if (!phone.match(phonePattern)) {
                alert("Phone number must be 10-15 digits");
                return false;
            }

            if (isNaN(salary) || salary <= 0) {
                alert("Salary must be a positive number");
                return false;
            }
            
            return true;
        }
    </script>

</head>

<body>

    <h2>Employee Profile Form</h2>

    <div class="form-container">
        <form name="empForm" action="" method="POST" onsubmit="return validateForm()">
            <label>Name:</label>
            <input type="text" name="name"><br>

            <label>Email:</label>
            <input type="text" name="email"><br>

            <label>Phone:</label>
            <input type="text" name="phone"><br>

            <label>Designation:</label>
            <input type="text" name="designation"><br>

            <label>Department:</label>
            <input type="text" name="department"><br>

            <label>Salary:</label>
            <input type="text" name="salary"><br>

            <label>Address:</label>
            <textarea name="address"></textarea><br><br>

            <input type="submit" name="submit" value="Save Profile">
        </form>
    </div>

</body>
</html>
