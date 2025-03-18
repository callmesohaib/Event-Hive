<?php
session_start();
header('Content-Type: application/json');

include '../dbConnection.php';

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in'] || $_SESSION['email'] !== "admin@gmail.com") {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['title']) || empty($data['title'])) {
    echo json_encode(["error" => "Invalid request: Missing event title"]);
    exit;
}

$eventTitle = trim($data['title']);

$conn->begin_transaction(); 

try {
    $deleteRegistrations = $conn->prepare("DELETE FROM event_registrations WHERE event_title = ?");
    $deleteRegistrations->bind_param("s", $eventTitle);
    $deleteRegistrations->execute();
    $deleteRegistrations->close();

    $deleteEvent = $conn->prepare("DELETE FROM events WHERE title = ?");
    $deleteEvent->bind_param("s", $eventTitle);
    $deleteEvent->execute();

    if ($deleteEvent->affected_rows === 0) {
        throw new Exception("Event not found");
    }

    $deleteEvent->close();

    $conn->commit(); 

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["error" => "Failed to delete event", "details" => $e->getMessage()]);
}

$conn->close();
?>