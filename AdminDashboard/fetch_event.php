<?php
header('Content-Type: application/json');
include '../dbConnection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "Missing event id"]);
    exit;
}

$id = trim($_GET['id']);

$stmt = $conn->prepare("SELECT category ,title, venue, start_date, start_time, end_time, end_date, type, price, description, image FROM events WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($event = $result->fetch_assoc()) {
    echo json_encode([
        "status" => "success",
        "event" => [
            "category" => $event['category'] ?? "",
            "title" => $event['title'] ?? "",
            "venue" => $event['venue'] ?? "",
            "start_date" => $event['start_date'] ?? "",
            "start_time" => $event['start_time'] ?? "00:00:00",
            "end_date" => $event['end_date'] ?? "", 
            "end_time" => $event['end_time'] ?? "00:00:00",
            "type" => $event['type'] ?? "",
            "price" => $event['price'] ?? "0.00",
            "description" => $event['description'] ?? "",
            "image" => $event['image'] ?? "" 
        ]
    ]);
} else {
    echo json_encode(["error" => "Event not found"]);
}


$stmt->close();
$conn->close();
?>
