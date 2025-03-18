<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
    echo json_encode([
        "is_logged_in" => true,
        "name" => $_SESSION['name'],
        "email" => $_SESSION['email']
    ]);
} else {
    echo json_encode(["is_logged_in" => false]);
}
?>
