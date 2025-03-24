<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include '../dbConnection.php';

// Check if the request method is POST and if the ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Extract form data
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
    $description = $_POST["eventDescription"] ?? '';

    // Validate required fields
    if (empty($newTitle)) {
        echo json_encode(["status" => "error", "message" => "Missing event title"]);
        exit;
    }

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Check if the event exists
        $checkStmt = $conn->prepare("SELECT title, image FROM events WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkStmt->bind_result($oldTitle, $oldImage);
        $checkStmt->fetch();
        $checkStmt->close();

        if (empty($oldTitle)) {
            throw new Exception("Event with the given ID does not exist.");
        }

        // Handle file upload
        $image = $oldImage;
        if (isset($_FILES["eventImage"]) && $_FILES["eventImage"]["error"] == 0) {
            $targetDir = "../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
            }
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

        // Update the event in the database
        $stmt = $conn->prepare("UPDATE events 
                                SET title=?, category=?, venue=?, start_time=?, end_time=?, start_date=?, end_date=?, type=?, price=?, image=?, description=? 
                                WHERE id=?");
        $stmt->bind_param("ssssssssdssi", $newTitle, $category, $venue, $startTime, $endTime, $startDate, $endDate, $eventType, $eventPrice, $image, $description, $id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update the event: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode(["status" => "success", "message" => "Event updated successfully!"]);
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>