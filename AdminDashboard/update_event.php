<?php
include '../dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["oldTitle"])) {
    $oldTitle = $_POST["oldTitle"];
    $newTitle = $_POST["eventTitle"];
    $category = $_POST["eventCategory"];
    $venue = $_POST["eventVenue"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $eventType = $_POST["eventType"];
    $eventPrice = $_POST["eventPrice"] ?? 0;
    $description = $_POST["eventDescription"];

    $stmt = $conn->prepare("UPDATE events SET title=?, category=?, venue=?, start_time=?, end_time=?, start_date=?, end_date=?, type=?, price=?, description=? WHERE title=?");
    $stmt->bind_param("ssssssssds", $newTitle, $category, $venue, $startTime, $endTime, $startDate, $endDate, $eventType, $eventPrice, $description, $oldTitle);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update event"]);
    }
}
?>
