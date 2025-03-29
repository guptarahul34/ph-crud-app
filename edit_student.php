<?php
ob_start();
include 'config.php'; // Include database connection

// Check if an ID is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch student details
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit();
    }
}

// Handle form submission for updating the student record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    // Update query
    $update_sql = "UPDATE students SET name = ?, age = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sisi", $name, $age, $email, $student_id);

    if ($update_stmt->execute()) {
        header("Location: index.php?message=Student Updated Successfully");
        exit();
    } else {
        echo "Error updating record: " . $update_stmt->error;
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Record</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br><br>

        <label>Age:</label>
        <input type="number" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Back to Student List</a>
</body>
</html>
