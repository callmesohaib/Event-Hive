<?php
session_start();
include '../dbConnection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Email and password are required"]);
    exit;
}

$sql = "SELECT * FROM user_tbl WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
    exit;
}

// Check if the password is "admin" (for admin users)
if ($email === "admin@gmail.com") {
    $_SESSION['user_id'] = $user['u_id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    
    $_SESSION['is_logged_in'] = true;
    $_SESSION['role'] = "admin"; // Store user role

    echo json_encode(["success" => true, "redirect" => "/Event-Hive/AdminDashboard/admin-dashboard.html"]);
} elseif (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['u_id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['is_logged_in'] = true;
    $_SESSION['role'] = "user"; // Store user role

    echo json_encode(["success" => true, "redirect" => "/Event-Hive/Home/home.php"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
}

$stmt->close();
$conn->close();
?>