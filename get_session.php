<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    echo json_encode([
        "name" => $_SESSION['name'],
        "email" => $_SESSION['email']
    ]);
} else {
    echo json_encode(["error" => "No session data found"]);
}
?>
