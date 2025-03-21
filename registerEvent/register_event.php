<?php
header("Content-Type: application/json");
include '../dbConnection.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$full_name = $data['full_name'] ?? null;
$email = $data['email'] ?? null;
$event_title = $data['event_title'] ?? null;
$event_type = $data['event_type'] ?? null;
$charges = $data['charges'] ?? null;
$payment_method = $data['payment_method'] ?? null;
$transaction_id = $data['transaction_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null; 

if (empty($full_name) || empty($email) || empty($event_title) || empty($event_type)) {
    echo json_encode(["success" => false, "message" => "Full Name, Email, Event Title, and Event Type are required"]);
    exit;
}

$valid_event_types = ['free', 'paid'];
if (!in_array($event_type, $valid_event_types)) {
    echo json_encode(["success" => false, "message" => "Invalid event type"]);
    exit;
}

if ($event_type === 'paid' && (empty($charges) || empty($payment_method) || empty($transaction_id))) {
    echo json_encode(["success" => false, "message" => "Payment details are required for paid events"]);
    exit;
}

if ($event_type === 'paid' && $user_id) {
    $sql = "SELECT bonus FROM user_tbl WHERE u_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $user['bonus'] >= $charges) {
        $new_bonus = $user['bonus'] - $charges;

        $update_sql = "UPDATE user_tbl SET bonus = ? WHERE u_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("di", $new_bonus, $user_id);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Insufficient balance"]);
        exit;
    }
    $stmt->close();
}

$sql = "INSERT INTO event_registrations (full_name, email, event_title, event_type, charges, payment_method, transaction_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssdss", $full_name, $email, $event_title, $event_type, $charges, $payment_method, $transaction_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed"]);
}

$stmt->close();
$conn->close();
?>