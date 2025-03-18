<?php
header("Content-Type: application/json");

include '../dbConnection.php';

$data = json_decode(file_get_contents("php://input"), true);

$full_name = $data['full_name'] ?? null;
$email = $data['email'] ?? null;
$event_title = $data['event_title'] ?? null;
$event_type = $data['event_type'] ?? null;
$charges = $data['charges'] ?? null;
$payment_method = $data['payment_method'] ?? null;
$transaction_id = $data['transaction_id'] ?? null;

if (empty($full_name) || empty($email) || empty($event_title) || empty($event_type)) {
    echo json_encode(["success" => false, "message" => "Full Name, Email, Event Title, and Event Type are required"]);
    exit;
}

$valid_event_types = ['free', 'paid'];
if (!in_array($event_type, $valid_event_types)) {
    echo json_encode(["success" => false, "message" => "Invalid event type"]);
    exit;
}

if ($event_type === 'paid') {
    if (empty($charges) || empty($payment_method) || empty($transaction_id)) {
        echo json_encode(["success" => false, "message" => "Payment details are required for paid events"]);
        exit;
    }
} else {
    $charges = null;
    $payment_method = null;
    $transaction_id = null;
}

// Insert into database
$sql = "INSERT INTO event_registrations (full_name, email, event_title, event_type, charges, payment_method, transaction_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $full_name, $email, $event_title, $event_type, $charges, $payment_method, $transaction_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed"]);
}

$stmt->close();
$conn->close();
?>