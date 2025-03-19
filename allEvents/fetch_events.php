<?php
include '../dbConnection.php';
session_start();

$is_logged_in = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
$user_email = $is_logged_in ? $_SESSION['email'] : null;

$sql = "SELECT id, title, venue, start_time, end_time, start_date, end_date, type, price, description, image FROM events";
$result = $conn->query($sql);

$events = [];
$registered_events = [];

if ($is_logged_in && $user_email) {
    $reg_sql = "SELECT event_title FROM event_registrations WHERE email = ?";
    $stmt = $conn->prepare($reg_sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $reg_result = $stmt->get_result();

    while ($reg_row = $reg_result->fetch_assoc()) {
        $registered_events[] = $reg_row['event_title'];
    }
    $stmt->close();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event_title = $row['title'];
        $reg_count_sql = "SELECT COUNT(*) as registration_count FROM event_registrations WHERE event_title = ?";
        $reg_stmt = $conn->prepare($reg_count_sql);
        $reg_stmt->bind_param("s", $event_title);
        $reg_stmt->execute();
        $reg_count_result = $reg_stmt->get_result();
        $reg_count_row = $reg_count_result->fetch_assoc();
        $row['registration'] = $reg_count_row['registration_count'];
        $reg_stmt->close();

        $row['is_registered'] = in_array($row['title'], $registered_events);
        $events[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>