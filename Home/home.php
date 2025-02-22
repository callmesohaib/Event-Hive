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
        <a href="logout.php" class="signup">Logout</a>
      <?php else: ?>
        <a href="../Sign_in/signin.html">Login</a>
        <a href="../Sign_up/signup.html" class="signup">Signup</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="hero">
    <img src="../resources/hero_section_img2.png" alt="Hero Image" />
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
      <div class="event-filters">
        <div class="filter">
          <span>Weekdays</span>
          <svg width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9L12 15L18 9" stroke="#131315" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
        <div class="filter">
          <span>Event Type</span>
          <svg width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9L12 15L18 9" stroke="#131315" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
        <div class="filter">
          <span>Any Category</span>
          <svg width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9L12 15L18 9" stroke="#131315" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
      </div>
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
        <img src="../resources/event_3_img_updated.png" alt="Event Image" />
        <div class="event-info">
          <span class="event-tag">FREE</span>
          <h3>BestSeller Book Bootcamp - Write, Market & Publish</h3>
          <p class="event-date">Saturday, March 18, 9:30 PM</p>
          <p class="event-location">ONLINE EVENT - Attend Anywhere</p>
        </div>
      </div>
    </div>

    <button class="load-more-events">Load More...</button>
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

  <section>
    <div class="brands-section">
      <div class="brands-title">
        <span class="black-text">Join these </span>
        <span class="purple-text">brands</span>
      </div>
      <div class="brands-description">
        We've had the pleasure of working with industry-defining brands. These
        are just some of them.
      </div>
      <div class="brands-logos">
        <img src="../resources/brand_1.png" alt="Brand 1" />
        <img src="../resources/brand_2.png" alt="Brand 2" />
        <img src="../resources/brand_3.png" alt="Brand 3" />
        <img src="../resources/brand_4.png" alt="Brand 4" />
        <img src="../resources/brand_5.png" alt="Brand 5" />
        <img src="../resources/brand_6.png" alt="Brand 6" />
        <img src="../resources/brand_7.png" alt="Brand 7" />
        <img src="../resources/brand_8.png" alt="Brand 8" />
        <img src="../resources/brand_9.png" alt="Brand 9" />
      </div>
    </div>
  </section>

  <section class="trend">
    <div class="trending-colleges">
      <div class="title">
        <span class="black-text">Trending</span>
        <span class="purple-text">colleges</span>
      </div>
      <div class="colleges-grid">
        <!-- College Card 1 -->
        <div class="college-card">
          <div class="college-image" style="background-image: url(../resources/college_img_1.png)">
            <div class="rating">
              <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10 4L12.472 8.93691L18 9.73344L14 13.5741L14.944 19L10 16.4369L5.056 19L6 13.5741L2 9.73344L7.528 8.93691L10 4Z"
                  fill="#EBD402" stroke="#EBD402" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span>4.8</span>
            </div>
            <div class="exclusive">
              <span>EXCLUSIVE</span>
            </div>
          </div>
          <div class="college-name">Harvard University</div>
          <div class="college-location">
            <span>Cambridge, Massachusetts, UK</span>
            <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.666992" width="50" height="50" rx="25" fill="#F2F2F2" />
              <path
                d="M25.6673 26.3333C26.4037 26.3333 27.0007 25.7364 27.0007 25C27.0007 24.2636 26.4037 23.6667 25.6673 23.6667C24.9309 23.6667 24.334 24.2636 24.334 25C24.334 25.7364 24.9309 26.3333 25.6673 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M35.0003 26.3333C35.7367 26.3333 36.3337 25.7364 36.3337 25C36.3337 24.2636 35.7367 23.6667 35.0003 23.6667C34.2639 23.6667 33.667 24.2636 33.667 25C33.667 25.7364 34.2639 26.3333 35.0003 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M16.3333 26.3333C17.0697 26.3333 17.6667 25.7364 17.6667 25C17.6667 24.2636 17.0697 23.6667 16.3333 23.6667C15.597 23.6667 15 24.2636 15 25C15 25.7364 15.597 26.3333 16.3333 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
        </div>

        <!-- College Card 2 -->
        <div class="college-card">
          <div class="college-image" style="background-image: url(../resources/college_img_2.png)">
            <div class="rating">
              <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10 4L12.472 8.93691L18 9.73344L14 13.5741L14.944 19L10 16.4369L5.056 19L6 13.5741L2 9.73344L7.528 8.93691L10 4Z"
                  fill="#EBD402" stroke="#EBD402" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span>4.8</span>
            </div>
            <div class="exclusive">
              <span>EXCLUSIVE</span>
            </div>
          </div>
          <div class="college-name">Stanford University</div>
          <div class="college-location">
            <span>Stanford, California</span>
            <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.666992" width="50" height="50" rx="25" fill="#F2F2F2" />
              <path
                d="M25.6673 26.3333C26.4037 26.3333 27.0007 25.7364 27.0007 25C27.0007 24.2636 26.4037 23.6667 25.6673 23.6667C24.9309 23.6667 24.334 24.2636 24.334 25C24.334 25.7364 24.9309 26.3333 25.6673 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M35.0003 26.3333C35.7367 26.3333 36.3337 25.7364 36.3337 25C36.3337 24.2636 35.7367 23.6667 35.0003 23.6667C34.2639 23.6667 33.667 24.2636 33.667 25C33.667 25.7364 34.2639 26.3333 35.0003 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M16.3333 26.3333C17.0697 26.3333 17.6667 25.7364 17.6667 25C17.6667 24.2636 17.0697 23.6667 16.3333 23.6667C15.597 23.6667 15 24.2636 15 25C15 25.7364 15.597 26.3333 16.3333 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
        </div>

        <!-- College Card 3 -->
        <div class="college-card">
          <div class="college-image" style="background-image: url(../resources/college_img_3.png)">
            <div class="rating">
              <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10 4L12.472 8.93691L18 9.73344L14 13.5741L14.944 19L10 16.4369L5.056 19L6 13.5741L2 9.73344L7.528 8.93691L10 4Z"
                  fill="#EBD402" stroke="#EBD402" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span>4.8</span>
            </div>
            <div class="exclusive">
              <span>EXCLUSIVE</span>
            </div>
          </div>
          <div class="college-name">Nanyang University</div>
          <div class="college-location">
            <span>Nanyang Ave, Singapura</span>
            <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.666992" width="50" height="50" rx="25" fill="#F2F2F2" />
              <path
                d="M25.6673 26.3333C26.4037 26.3333 27.0007 25.7364 27.0007 25C27.0007 24.2636 26.4037 23.6667 25.6673 23.6667C24.9309 23.6667 24.334 24.2636 24.334 25C24.334 25.7364 24.9309 26.3333 25.6673 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M35.0003 26.3333C35.7367 26.3333 36.3337 25.7364 36.3337 25C36.3337 24.2636 35.7367 23.6667 35.0003 23.6667C34.2639 23.6667 33.667 24.2636 33.667 25C33.667 25.7364 34.2639 26.3333 35.0003 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M16.3333 26.3333C17.0697 26.3333 17.6667 25.7364 17.6667 25C17.6667 24.2636 17.0697 23.6667 16.3333 23.6667C15.597 23.6667 15 24.2636 15 25C15 25.7364 15.597 26.3333 16.3333 26.3333Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
        </div>
      </div>
      <div class="load-more-trend">
        <button>Load more...</button>
      </div>
    </div>
  </section>

  <section>
    <div class="blogs-section">
      <div class="blogs-title">
        <span class="black-text">Our </span>
        <span class="purple-text">Blogs</span>
      </div>
      <div class="blogs-grid">
        <!-- Blog Card 1 -->
        <div class="blog-card">
          <div class="blog-image">
            <img src="../resources/blog_img_1.jpeg" alt="Blog Image" />
          </div>
          <div class="blog-tag">
            <span>FREE</span>
          </div>
          <div class="blog-content">
            <div class="blog-name">
              BestSeller Book Bootcamp - Write, Market & Publish Your Book -
              Lucknow
            </div>
            <div class="blog-date">Saturday, March 18, 9.30PM</div>
            <div class="blog-location">ONLINE EVENT - Attend anywhere</div>
          </div>
        </div>

        <!-- Blog Card 2 -->
        <div class="blog-card">
          <div class="blog-image">
            <img src="../resources/blog_img_2.jpeg" alt="Blog Image" />
          </div>
          <div class="blog-tag">
            <span>FREE</span>
          </div>
          <div class="blog-content">
            <div class="blog-name">
              BestSeller Book Bootcamp - Write, Market & Publish Your Book -
              Lucknow
            </div>
            <div class="blog-date">Saturday, March 18, 9.30PM</div>
            <div class="blog-location">ONLINE EVENT - Attend anywhere</div>
          </div>
        </div>

        <!-- Blog Card 3 -->
        <div class="blog-card">
          <div class="blog-image">
            <img src="../resources/blog_img_3.jpeg" alt="Blog Image" />
          </div>
          <div class="blog-tag">
            <span>FREE</span>
          </div>
          <div class="blog-content">
            <div class="blog-name">
              BestSeller Book Bootcamp - Write, Market & Publish Your Book -
              Lucknow
            </div>
            <div class="blog-date">Saturday, March 18, 9.30PM</div>
            <div class="blog-location">ONLINE EVENT - Attend anywhere</div>
          </div>
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
        <div class="footer-logo">
          <svg width="124" height="31" viewBox="0 0 124 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- SVG Paths Here (Copy from your original code) -->
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