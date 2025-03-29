<?php
ob_start();
include 'config.php'; // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Prepare SQL statement
    $sql = "INSERT INTO students (name, age, email) VALUES (?, ?, ?)";

    // Using prepared statements for security
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $name, $age ,$email);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student Record</title>
</head>
<body>
    <h2>Add New Student</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Age:</label>
        <input type="number" name="age" required><br><br>

        <button type="submit">Submit</button>
    </form>
     <br>
    <a href="index.php">Back to Student List</a>
</body>
</html>
