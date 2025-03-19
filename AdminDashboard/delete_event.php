<?php
session_start();
header('Content-Type: application/json');

include '../dbConnection.php';

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in'] || $_SESSION['email'] !== "admin@gmail.com") {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id']) || empty($data['id']) || !is_numeric($data['id'])) {
    echo json_encode(["error" => "Invalid request: Missing or invalid event ID"]);
    exit;
}

$eventId = intval($data['id']); // Ensure it's an integer

$conn->begin_transaction();

try {
    // Fetch event title using event ID
    $fetchTitle = $conn->prepare("SELECT title FROM events WHERE id = ?");
    $fetchTitle->bind_param("i", $eventId);
    $fetchTitle->execute();
    $result = $fetchTitle->get_result();
    $fetchTitle->close();

    if ($result->num_rows === 0) {
        throw new Exception("Event not found");
    }

    $row = $result->fetch_assoc();
    $eventTitle = $row['title'];

    // Delete registrations linked to this event title
    $deleteRegistrations = $conn->prepare("DELETE FROM event_registrations WHERE event_title = ?");
    $deleteRegistrations->bind_param("s", $eventTitle);
    $deleteRegistrations->execute();
    $deleteRegistrations->close();

    // Delete the event itself
    $deleteEvent = $conn->prepare("DELETE FROM events WHERE id = ?");
    $deleteEvent->bind_param("i", $eventId);
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