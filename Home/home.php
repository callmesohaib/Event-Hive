<?php
session_start();
$is_logged_in = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
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
        <a href="../logout.php" class="signup">Logout</a>
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

  <section class="search-bar">
    <div class="search-input">
      <label for="search">Looking for</label>
      <input type="text" placeholder="Choose event type" disabled />
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 9L12 15L18 9" stroke="#10107B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="search-input">
      <label for="search">Location</label>
      <input type="text" placeholder="Choose location" disabled />
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 9L12 15L18 9" stroke="#10107B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="search-input">
      <label for="search">When</label>
      <input type="text" placeholder="Choose date and time" disabled />
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 9L12 15L18 9" stroke="#10107B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="search-icon">
      <svg width="50" height="50" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="70" height="70" rx="5" fill="#7848F4" />
        <path
          d="M34 42C38.4183 42 42 38.4183 42 34C42 29.5817 38.4183 26 34 26C29.5817 26 26 29.5817 26 34C26 38.4183 29.5817 42 34 42Z"
          stroke="#F8F8FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M43.9999 43.9999L39.6499 39.6499" stroke="#F8F8FA" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </div>
  </section>

  <section class="events">
    <div class="events-header">
      <h2>Upcoming <span class="highlight">Events</span></h2>
    </div>

    <div class="event-cards">
      <div class="event-card">
        <img src="../resources/event_1_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_2_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_4_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>
    </div>

  </section>

  <section class="events">
    <div class="events-header">
      <h2>Past <span class="highlight">Events</span></h2>
    </div>

    <div class="event-cards">
      <div class="event-card">
        <img src="../resources/event_1_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_2_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_4_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>
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


  <section class="events">
    <div class="events-header">
      <h2>Upcoming <span class="highlight">Conferences</span></h2>
    </div>

    <div class="event-cards">
      <div class="event-card">
        <img src="../resources/event_1_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_2_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_4_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>
    </div>

  </section>


  <section class="events">
    <div class="events-header">
      <h2>Past <span class="highlight">Conferences</span></h2>
    </div>

    <div class="event-cards">
      <div class="event-card">
        <img src="../resources/event_1_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_2_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>

      <div class="event-card">
        <img src="../resources/event_4_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>
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
        <a href="../allEvents/all-events.html" class="footer-link">About</a>
        <a href="#" class="footer-link">Services</a>
        <a href="#" class="footer-link">Get in touch</a>
        <a href="#" class="footer-link">FAQs</a>
      </div>
      <div class="footer-divider"></div>
      <div class="footer-bottom">
        <div class="footer-copyright">
          Non Copyrighted © 2023 Upload by EventHive
        </div>
        <div class="footer-logo">
          <svg width="124" height="31" viewBox="0 0 124 31" fill="none" xmlns="http://www.w3.org/2000/svg">
          </svg>
        </div>
        <div class="footer-languages">
          <button class="language-button">English</button>
          <button class="language-button">French</button>
          <button class="language-button">Hindi</button>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>