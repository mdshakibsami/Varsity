<!DOCTYPE html>
<html>
<head>
    <title>Student Profile Form</title>
    <script>
        function validateForm() {
            const name = document.forms["studentForm"]["name"].value;
            const email = document.forms["studentForm"]["email"].value;
            const phone = document.forms["studentForm"]["phone"].value;
            const dob = document.forms["studentForm"]["dob"].value;
            const gender = document.forms["studentForm"]["gender"].value;
            const department = document.forms["studentForm"]["department"].value;
            const roll_no = document.forms["studentForm"]["roll_no"].value;
            const address = document.forms["studentForm"]["address"].value;

            if (name == "" || email == "" || phone == "" || dob == "" || gender == "" ||
                department == "" || roll_no == "" || address == "") {
                alert("All fields must be filled out.");
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Invalid email format.");
                return false;
            }

            const phonePattern = /^[0-9]{10,15}$/;
            if (!phonePattern.test(phone)) {
                alert("Invalid phone number.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<h2>Student Profile Form</h2>
<form name="studentForm" action="student_result.php" method="post" onsubmit="return validateForm();">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Phone: <input type="text" name="phone"><br><br>
    Date of Birth: <input type="date" name="dob"><br><br>
    Gender: 
    <select name="gender">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br><br>
    Department: <input type="text" name="department"><br><br>
    Roll No: <input type="text" name="roll_no"><br><br>
    Address: <textarea name="address"></textarea><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>


<!-- Code for DB -->

<!-- CREATE DATABASE if not EXISTS student_db;

USE student_db;

CREATE TABLE if not EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    dob DATE,
    gender VARCHAR(10),
    department VARCHAR(50),
    roll_no VARCHAR(50),
    address TEXT
); -->
