<?php
session_start();
$is_logged_in = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];

$user_email = $is_logged_in ? $_SESSION['email'] : null;
$user_name = $is_logged_in ? $_SESSION['name'] : null;
$isAdmin = false;
if ($user_email == "admin@gmail.com") {
  $isAdmin = true;
}
include '../dbConnection.php';

$upcoming_events_query = "SELECT * FROM events WHERE start_date >= NOW() AND category = 'event' ORDER BY start_date ASC";
$upcoming_events_result = $conn->query($upcoming_events_query);

$upcoming_conferences_query = "SELECT * FROM events WHERE start_date >= NOW() AND category = 'conference' ORDER BY start_date ASC";
$upcoming_conferences_result = $conn->query($upcoming_conferences_query);

$past_events_query = "SELECT * FROM events WHERE end_date < NOW() AND category = 'event' ORDER BY end_date DESC";
$past_events_result = $conn->query($past_events_query);

$past_conferences_query = "SELECT * FROM events WHERE end_date < NOW() AND category = 'conference' ORDER BY end_date DESC";
$past_conferences_result = $conn->query($past_conferences_query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <title>Event Hive | Made For Those Who Do</title>
</head>

<body>
  <header class="header">
    <h1>Event<span class="header-text">Hive</span></h1>
    <nav>
      <?php if ($is_logged_in): ?>
        <a href="../allEvents/all-events.html" class="signup">All Events</a>
        <div class="dropdown-container">
          <button id="dropdownButton" class="dropdown-button">
            <img src="../resources/avatar.png" class="avatar" alt="User Avatar" />
            <span class="arrow">&#9662;</span>
          </button>

          <div id="dropdownMenu" class="dropdown-menu">
            <div class="dropdown-header">

              <p class="user-name"><?php echo $user_name; ?></p>
              <p class="user-email"><?php echo $user_email; ?></p>
            </div>
            <ul class="dropdown-links">
              <?php if ($isAdmin): ?>
                <li><a href="../AdminDashboard/admin-dashboard.html">Admin Dashboard</a></li>
              <?php endif; ?>
              <li><a href="../userDashboard/user-dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php" id="logout">Sign out</a></li>
            </ul>
          </div>
        </div>
      <?php else: ?>
        <a href="../Sign_in/signin.html">Login</a>
        <a href="../Sign_up/signup.html" class="signup">Signup</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="hero">
    <img src="../resources/hero_section_img2.jpg" alt="Hero Image" />
    <h2>Made for those<br />who do</h2>
  </section>

  <!-- Upcoming Events -->
  <section class="events">
    <div class="events-header">
      <h2>Upcoming <span class="highlight">Events</span></h2>
    </div>
    <div class="event-cards">
      <?php if ($upcoming_events_result->num_rows > 0): ?>
        <?php while ($event = $upcoming_events_result->fetch_assoc()): ?>
          <div class="event-card">
            <img src="../resources/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" />
            <div class="event-info">
              <span class="event-tag">
                <?php echo ($event['price'] == 0) ? "FREE" : "Paid - $" . htmlspecialchars($event['price']); ?>
              </span>
              <h3><?php echo htmlspecialchars($event['title']); ?></h3>
              <p class="event-date">
                <?php echo date("l, F j, g:i A", strtotime($event['start_date'] . ' ' . $event['start_time'])); ?>
              </p>
              <p class="event-location"><?php echo htmlspecialchars($event['venue']); ?></p>
              <p class="event-des"><?php echo htmlspecialchars($event['description']); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-events">No upcoming events available.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Past Events -->
  <section class="events">
    <div class="events-header">
      <h2>Past <span class="highlight">Events</span></h2>
    </div>
    <div class="event-cards">
      <?php if ($past_events_result->num_rows > 0): ?>
        <?php while ($event = $past_events_result->fetch_assoc()): ?>
          <div class="event-card">
            <img src="../resources/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" />
            <div class="event-info">
              <span class="event-tag">
                <?php echo ($event['price'] == 0) ? "FREE" : "Paid - $" . htmlspecialchars($event['price']); ?>
              </span>
              <h3><?php echo htmlspecialchars($event['title']); ?></h3>
              <p class="event-date">
                <?php echo date("l, F j, g:i A", strtotime($event['start_date'] . ' ' . $event['start_time'])); ?>
              </p>
              <p class="event-location"><?php echo htmlspecialchars($event['venue']); ?></p>
              <p class="event-des"><?php echo htmlspecialchars($event['description']); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-events">No past events available.</p>
      <?php endif; ?>
    </div>
  </section>

  <section>
    <div class="event-section">
      <div class="event-background"></div>
      <img class="event-image" src="../resources/make_ur_event_img.png" alt="Event Image" />
      <div class="event-content">
        <div class="event-button-container">
          <div class="event-button">Create Events</div>
        </div>
        <div class="event-title">Make your own Event</div>
        <div class="event-description">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </div>
      </div>
    </div>
  </section>

  <!-- Upcoming Conferences -->
  <section class="events">
    <div class="events-header">
      <h2>Upcoming <span class="highlight">Conferences</span></h2>
    </div>
    <div class="event-cards">
      <?php if ($upcoming_conferences_result->num_rows > 0): ?>
        <?php while ($event = $upcoming_conferences_result->fetch_assoc()): ?>
          <div class="event-card">
            <img src="../resources/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" />
            <div class="event-info">
              <span class="event-tag">
                <?php echo ($event['price'] == 0) ? "FREE" : "Paid - $" . htmlspecialchars($event['price']); ?>
              </span>
              <h3><?php echo htmlspecialchars($event['title']); ?></h3>
              <p class="event-date">
                <?php echo date("l, F j, g:i A", strtotime($event['start_date'] . ' ' . $event['start_time'])); ?>
              </p>
              <p class="event-location"><?php echo htmlspecialchars($event['venue']); ?></p>
              <p class="event-des"><?php echo htmlspecialchars($event['description']); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-events">No upcoming conferences available.</p>
      <?php endif; ?>
    </div>
  </section>


  <!-- Past conferences -->
  <section class="events">
    <div class="events-header">
      <h2>Past <span class="highlight">Conferences</span></h2>
    </div>
    <div class="event-cards">
      <?php if ($past_conferences_result->num_rows > 0): ?>
        <?php while ($event = $past_conferences_result->fetch_assoc()): ?>
          <div class="event-card">
            <img src="../resources/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" />
            <div class="event-info">
              <span class="event-tag">
                <?php echo ($event['price'] == 0) ? "FREE" : "Paid - $" . htmlspecialchars($event['price']); ?>
              </span>
              <h3><?php echo htmlspecialchars($event['title']); ?></h3>
              <p class="event-date">
                <?php echo date("l, F j, g:i A", strtotime($event['start_date'] . ' ' . $event['start_time'])); ?>
              </p>
              <p class="event-location"><?php echo htmlspecialchars($event['venue']); ?></p>
              <p class="event-des"><?php echo htmlspecialchars($event['description']); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-events">No past conferences available.</p>
      <?php endif; ?>
    </div>
  </section>


  <footer class="footer">
    <div class="footer-content">
      <div class="footer-title">
        <span class="white-text">Event</span>
        <span class="blue-text">Hive</span>
      </div>
      <div class="subscribe-section">
        <input type="email" placeholder="Enter your mail" class="email-input" />
        <button class="subscribe-button">Subscribe</button>
      </div>
      <div class="footer-links">
        <a href="#" class="footer-link">Home</a>
        <a href="#" class="footer-link">About</a>
        <a href="#" class="footer-link">Services</a>
        <a href="#" class="footer-link">Get in touch</a>
        <a href="#" class="footer-link">FAQs</a>
      </div>
      <div class="footer-divider"></div>
      <div class="footer-bottom">
        <div class="footer-copyright">
          Non Copyrighted © 2023 Upload by EventHive
        </div>
      </div>
    </div>
  </footer>

</body>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownButton.addEventListener("click", function () {
      dropdownMenu.classList.toggle("show");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
      if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove("show");
      }
    });
  });
</script>

</html>

<?php
$conn->close();
?>