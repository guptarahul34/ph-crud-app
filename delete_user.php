<?php
ob_start();
include 'config.php'; // Include database connection

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare delete statement
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: index.php?message=User Deleted Successfully");
        exit();
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
ob_end_flush();
?>
