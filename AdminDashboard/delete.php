<?php
session_start();
require_once "../dbConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

    // Check if the user is an admin
    if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in'] || strpos($_SESSION['email'], "admin") === false) {
        echo json_encode(["error" => "Unauthorized access"]);
        exit;
    }

    // Delete user from database
    $stmt = $conn->prepare("DELETE FROM user_tbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => "User deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete user"]);
    }

    $stmt->close();
    $conn->close();
}
?>
