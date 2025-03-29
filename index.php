<?php
$host = "db";
$username = "root"; // Change if using a different MySQL user
$password = "rahulgupta"; // Set the password if applicable
$database = "student";

// Create a database connection (Using MySQLi)
$conn = new mysqli($host, $username, $password, $database);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all students
$sql = "SELECT id, name, age, email FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Student Records</h2>
    <h3><a href="create_student.php">Add Record</a></h3>
    <div class="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Edit Record </th>
            <th>Delete Record </th>
        </tr>

        <?php
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Loop through and display each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['email']}</td>
                        <td><a href='edit_student.php?id={$row['id']}'>Edit Record</a></td>
                        <td>
                         <a href='delete_user.php?id={$row['id']}'
                          onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                           Delete
                         </a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </table>
   </div>
</body>
</html>
