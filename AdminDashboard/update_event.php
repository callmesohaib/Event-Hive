<?php
include '../dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $newTitle = $_POST["eventTitle"] ?? '';
    $category = $_POST["eventCategory"] ?? '';
    $venue = $_POST["eventVenue"] ?? '';
    $startTime = $_POST["startTime"] ?? '';
    $endTime = $_POST["endTime"] ?? '';
    $startDate = $_POST["startDate"] ?? '';
    $endDate = $_POST["endDate"] ?? '';
    $eventType = $_POST["eventType"] ?? '';
    $eventPrice = $_POST["eventPrice"] ?? 0;
    $eventImage = $_POST["eventImage"] ?? '';
    $description = $_POST["eventDescription"] ?? '';

    if (empty($newTitle)) {
        echo json_encode(["status" => "error", "message" => "Missing event title"]);
        exit;
    }

    $conn->begin_transaction();

    try {
        $checkStmt = $conn->prepare("SELECT title, image FROM events WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkStmt->bind_result($oldTitle, $oldImage);
        $checkStmt->fetch();
        $checkStmt->close();

        if (empty($oldTitle)) {
            throw new Exception("Event with the given ID does not exist.");
        }

        $image = $oldImage;

        if (isset($_FILES["eventImage"]) && $_FILES["eventImage"]["error"] == 0) {
            $targetDir = "uploads/";
            $imageFileType = strtolower(pathinfo($_FILES["eventImage"]["name"], PATHINFO_EXTENSION));
            $imageName = uniqid("event_", true) . "." . $imageFileType;
            $targetFilePath = $targetDir . $imageName;

            $allowedTypes = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowedTypes)) {
                throw new Exception("Invalid image format. Allowed types: JPG, JPEG, PNG, GIF.");
            }

            if (!move_uploaded_file($_FILES["eventImage"]["tmp_name"], $targetFilePath)) {
                throw new Exception("Failed to upload the image.");
            }

            $image = $targetFilePath;
        }

        $stmt = $conn->prepare("UPDATE events 
                                SET title=?, category=?, venue=?, start_time=?, end_time=?, start_date=?, end_date=?, type=?, price=?, image=?, description=? 
                                WHERE id=?");
        $stmt->bind_param("ssssssssdssi", $newTitle, $category, $venue, $startTime, $endTime, $startDate, $endDate, $eventType, $eventPrice, $image, $description, $id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update the event.");
        }

        if ($stmt->affected_rows === 0) {
            throw new Exception("No changes were made to the event.");
        }

        $updateRegStmt = $conn->prepare("UPDATE event_registrations 
                                         SET event_title=?, event_type=?, charges=? 
                                         WHERE event_title=?");
        $updateRegStmt->bind_param("ssds", $newTitle, $eventType, $eventPrice, $oldTitle);

        if (!$updateRegStmt->execute()) {
            throw new Exception("Failed to update the event_registrations table.");
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

    $stmt->close();
    if (isset($updateRegStmt)) {
        $updateRegStmt->close();
    }
    $conn->close();
}
?>