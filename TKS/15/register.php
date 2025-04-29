<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <script>
        function validateForm() {
            var username = document.forms["regForm"]["username"].value;
            var password = document.forms["regForm"]["password"].value;
            var email = document.forms["regForm"]["email"].value;
            var name = document.forms["regForm"]["full_name"].value;
            var contact = document.forms["regForm"]["contact"].value;

            if (username == "" || password == "" || email == "" || name == "" || contact == "") {
                alert("All fields must be filled out.");
                return false;
            }

            if (!email.includes("@")) {
                alert("Enter a valid email.");
                return false;
            }

            if (contact.length < 10) {
                alert("Enter a valid contact number.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h2>Register</h2>
    <form name="regForm" action="register_process.php" method="POST" onsubmit="return validateForm();">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        Email: <input type="text" name="email"><br><br>
        Full Name: <input type="text" name="full_name"><br><br>
        Contact: <input type="text" name="contact"><br><br>
        <input type="submit" value="Register">
    </form>
    <br><a href="login.php">Already have an account? Login</a>
</body>
</html>
