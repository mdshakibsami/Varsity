<!DOCTYPE html>
<html>
<head>
    <title>Employee Profile Form</title>
</head>
<body>
    <h2>Employee Profile Entry</h2>
    <form method="post" action="save_employee.php">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        Department: <input type="text" name="department" required><br><br>
        Designation: <input type="text" name="designation" required><br><br>
        Salary: <input type="number" name="salary" step="0.01" required><br><br>
        Hire Date: <input type="date" name="hire_date" required><br><br>
        Address: <textarea name="address" required></textarea><br><br>
        <input type="submit" value="Save Employee">
    </form>
</body>
</html>
