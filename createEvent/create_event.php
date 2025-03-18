<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
    include '../dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
        exit();
    }

    // Ensure database connection
    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "Database connection failed."]);
        exit();
    }
    $category = $_POST["eventCategory"];
    $title = trim($_POST["eventTitle"]);
    $venue = trim($_POST["eventVenue"]);
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $type = $_POST["eventType"];
    $price = ($type === "paid" && isset($_POST["eventPrice"])) ? floatval($_POST["eventPrice"]) : 0.00;
    $description = trim($_POST["eventDescription"]);

    if (empty($category) || empty($title) || empty($venue) || empty($startTime) || empty($endTime) || empty($startDate) || empty($endDate) || empty($description)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Handle image upload
    $imagePath = null;
    if (!empty($_FILES["eventImage"]["name"])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["eventImage"]["name"]);
        $imagePath = $targetDir . $fileName;

        if (!move_uploaded_file($_FILES["eventImage"]["tmp_name"], $imagePath)) {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit();
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO events (category, title, venue, start_time, end_time, start_date, end_date, type, price, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Prepare statement failed: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("ssssssssdss", $category, $title, $venue, $startTime, $endTime, $startDate, $endDate, $type, $price, $description, $imagePath);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event created successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error creating event: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Exception: " . $e->getMessage()]);
}

?>
