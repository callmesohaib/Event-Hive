<?php
session_start();
include '../dbConnection.php'; 

header('Content-Type: application/json');

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in'] || strpos($_SESSION['email'], "admin") === false) {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$sql = "SELECT u_id, name, email, 
            CASE 
                WHEN email LIKE '%organizer%' THEN 'Organizer' 
                ELSE 'User' 
            END AS role
        FROM user_tbl
        WHERE email NOT LIKE '%admin%' 
        ORDER BY 
            CASE 
                WHEN email LIKE '%organizer%' THEN 1  -- Organizers first
                ELSE 2  -- Users second
            END, name ASC"; 

$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);
?>
