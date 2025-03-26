<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location: ../Sign_in/signin.html");
    exit();
}

include '../dbConnection.php';

$full_name = $_SESSION['name'];

$registered_events_query = "
    SELECT e.* 
    FROM events e
    INNER JOIN event_registrations er ON e.title = er.event_title
    WHERE er.full_name = '$full_name'
    ORDER BY e.start_date ASC
";
$registered_events_result = $conn->query($registered_events_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User - Event Management</title>
    <link rel="stylesheet" href="user-dashboard.css" />
</head>

<body>
    <header class="header">
        <a href="../Home/home.php" style="cursor: pointer; text-decoration: none">
            <h1>Event<span class="header-text">Hive</span></h1>
        </a>
        <nav>
            <a href="../allEvents/all-events.html">All Events</a>
            <a href="../logout.php" class="signup">Sign out</a>
        </nav>
    </header>

    <main class="container">
        <h2>My Registered Events</h2>

        <div class="event-table">
            <div class="event-row header-row">
                <div>Event Name</div>
                <div>Venue</div>
                <div>Start Date & Time</div>
                <div>Type</div>
            </div>

            <?php if ($registered_events_result->num_rows > 0): ?>
                <?php while ($event = $registered_events_result->fetch_assoc()): ?>
                    <div class="event-row">
                        <div><?php echo htmlspecialchars($event['title']); ?></div>
                        <div><?php echo htmlspecialchars($event['venue']); ?></div>
                        <div><?php echo date("F j, Y, g:i A", strtotime($event['start_date'] . ' ' . $event['start_time'])); ?>
                        </div>
                        <div>
                            <?php echo ($event['price'] == 0) ? "Free" : "Paid - " . htmlspecialchars($event['price']) . " OMR" ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="event-row no-events">
                    <div class="full-row-message">You have not registered for any events yet.</div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>