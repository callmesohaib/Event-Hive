<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location: signin.html");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EventHive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        /* Header Styles - Your Provided Code */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0px 53px;
            padding: 20px 0;
        }

        .header h1 {
            font-size: 40px;
            font-weight: 700;
            color: black;
        }

        .header h1 span {
            color: #7848f4;
        }

        .header nav {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .header nav a {
            color: #131315;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .header nav a:hover {
            color: #7848f4;
        }

        .header nav .signup {
            background: #7848f4;
            padding: 15px 40px;
            border-radius: 5px;
            color: white;
            transition: all 0.3s ease;
        }

        .header nav .signup:hover {
            background: #5f3ac4;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(120, 72, 244, 0.3);
        }

        /* Contact Section */
        .contact-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: stretch;
        }

        .contact-image {
            flex: 1;
            min-width: 300px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .contact-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .contact-image:hover img {
            transform: scale(1.03);
        }

        .contact-form-container {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .contact-form-container:hover {
            transform: translateY(-5px);
        }

        .contact-form {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .contact-form h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #333;
            position: relative;
        }

        .contact-form h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 4px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            outline: none;
            border-color: #7848f4;
            box-shadow: 0 0 0 3px rgba(120, 72, 244, 0.2);
            background-color: white;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn-send {
            background: linear-gradient(135deg, #7848f4, #5f3ac4);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(120, 72, 244, 0.4);
            margin-top: auto;
            /* Pushes button to bottom */
        }

        .btn-send i {
            margin-left: 8px;
        }

        .btn-send:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(120, 72, 244, 0.6);
        }

        .btn-send:active {
            transform: translateY(0);
        }

        /* Floating Labels Animation */
        .form-group.focused label {
            /* transform: translateY(-25px); */
            /* font-size: 0.8rem; */
            color: #7848f4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }

            .contact-image,
            .contact-form-container {
                width: 100%;
            }

            .header {
                margin: 0 20px;
                flex-direction: column;
                gap: 20px;
            }

            .header nav {
                gap: 20px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-form-container {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .form-group.error .form-control {
            border-color: #ff6b6b;
        }

        .form-group.success .form-control {
            border-color: #51cf66;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }

        .form-group.error .error-message {
            display: block;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="../Home/home.php" style="cursor: pointer; text-decoration: none">
            <h1>Event<span class="header-text" >Hive</span></h1>
        </a>
        <nav>
            <a href="../logout.php" class="signup">Signup</a>
        </nav>
    </header>

    <div class="contact-container">
        <div class="contact-form-container">
            <form action="https://api.web3forms.com/submit" method="POST" autocomplete="off">
                <input type="hidden" name="access_key" value="c78a4719-97db-455a-9609-16b7cef884e0" />
                <h2>Get in Touch</h2>

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name"
                        required>
                    <span class="error-message">Please enter your full name</span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email"
                        required>
                    <span class="error-message">Please enter a valid email address</span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control"
                        placeholder="Enter your phone number">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="What's this about?"
                        required>
                    <span class="error-message">Please enter a subject</span>
                </div>

                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."
                        required></textarea>
                    <span class="error-message">Please enter your message</span>
                </div>

                <button type="submit" class="btn-send">
                    Send Message <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
        <div class="contact-image">
            <img src="https://i.pinimg.com/736x/0c/ab/44/0cab44a11943fae955ba8c1880c4f799.jpg" alt="Contact Us">
        </div>

    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            const form = this;

            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error');
            });

            const fullname = form.elements['fullname'];
            if (!fullname.value.trim()) {
                fullname.closest('.form-group').classList.add('error');
                isValid = false;
            }

            const email = form.elements['email'];
            if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                email.closest('.form-group').classList.add('error');
                isValid = false;
            }

            const subject = form.elements['subject'];
            if (!subject.value.trim()) {
                subject.closest('.form-group').classList.add('error');
                isValid = false;
            }

            const message = form.elements['message'];
            if (!message.value.trim()) {
                message.closest('.form-group').classList.add('error');
                isValid = false;
            }

            if (isValid) {
                alert('Thank you for your message! We will get back to you soon.');
                form.reset();

                const btn = form.querySelector('.btn-send');
                btn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
                btn.style.background = 'linear-gradient(135deg, #51cf66, #40c057)';

                setTimeout(() => {
                    btn.innerHTML = 'Send Message <i class="fas fa-paper-plane"></i>';
                    btn.style.background = 'linear-gradient(135deg, #7848f4, #5f3ac4)';
                }, 3000);
            }
        });

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function () {
                this.closest('.form-group').classList.add('focused');
            });

            input.addEventListener('blur', function () {
                if (!this.value) {
                    this.closest('.form-group').classList.remove('focused');
                }
            });

            if (input.value) {
                input.closest('.form-group').classList.add('focused');
            }
        });

        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function (e) {
            const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
    </script>
</body>

</html>