<?php
include '../dbConnection.php';

$sql = "SELECT title, venue, start_time, end_time, start_date, end_date, type, price, description, image FROM events";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}


$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>
