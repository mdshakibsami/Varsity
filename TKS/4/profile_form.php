<!DOCTYPE html>
<html>
<head>
    <title>Personal Profile Form</title>
</head>
<body>
    <h2>Enter Your Personal Profile</h2>
    <form method="post" action="save_profile.php">
        Full Name: <input type="text" name="full_name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        Date of Birth: <input type="date" name="dob" required><br><br>
        Gender:
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female"> Female<br><br>
        Nationality: <input type="text" name="nationality" required><br><br>
        Address: <textarea name="address" required></textarea><br><br>
        Hobby: <input type="text" name="hobby" required><br><br>
        <input type="submit" value="Save Profile">
    </form>
</body>
</html>
