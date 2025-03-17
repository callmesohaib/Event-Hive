<?php
header("Content-Type: application/json");

include '../dbConnection.php';
// Get JSON input from fetch request
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$name = $data['name'];
$event_title = $data['event_title'];
$event_type = $data['event_type'];
$event_start = $data['event_start'];
$event_end = $data['event_end'];

if (empty($email) || empty($name)) {
    echo json_encode(["success" => false, "message" => "Email and Name are required"]);
    exit;
}

// Insert into database
$sql = "INSERT INTO registrations (email, name, event_title, event_type, event_start, event_end) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $email, $name, $event_title, $event_type, $event_start, $event_end);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Registration Failed"]);
}

$stmt->close();
$conn->close();
?>
