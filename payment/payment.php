<?php
include '../dbConnection.php';
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: /Event-Hive/Sign_in/signin.html");
    exit;
}

$bonus = isset($_SESSION['bonus']) ? $_SESSION['bonus'] : 0;
$user_id = $_SESSION['user_id'];

// Get the amount and payment method from the URL parameters
$eventPrice = isset($_GET['event_price']) ? $_GET['event_price'] : 0;
$paymentMethod = isset($_GET['payment_method']) ? $_GET['payment_method'] : 'creditCard';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Payment Page</title>
    <link rel="stylesheet" href="payment.css">
</head>

<body>
    <div class="payment-container">
        <div class="balance-section">
            <h2>Your Balance</h2>
            <p id="userBalance"><?php echo $bonus .
                " OMR" ?></p>
        </div>

        <div class="payment-method-section">
            <h2>Select Payment Method</h2>
            <div class="payment-methods">
                <label class="payment-method <?php echo $paymentMethod === 'Credit Card' ? 'selected' : ''; ?>">
                    <input type="radio" name="paymentMethod" value="Credit Card" <?php echo $paymentMethod === 'Credit Card' ? 'checked' : ''; ?>>
                    <div class="method-content">
                        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Credit Card">
                        <span>Credit Card</span>
                    </div>
                </label>
                <label class="payment-method <?php echo $paymentMethod === 'PayPal' ? 'selected' : ''; ?>">
                    <input type="radio" name="paymentMethod" value="PayPal" <?php echo $paymentMethod === 'PayPal' ? 'checked' : ''; ?>>
                    <div class="method-content">
                        <img src="https://img.icons8.com/color/48/000000/paypal.png" alt="PayPal">
                        <span>PayPal</span>
                    </div>
                </label>
                <label class="payment-method <?php echo $paymentMethod === 'Crypto' ? 'selected' : ''; ?>">
                    <input type="radio" name="paymentMethod" value="Crypto" <?php echo $paymentMethod === 'Crypto' ? 'checked' : ''; ?>>
                    <div class="method-content">
                        <img src="https://img.icons8.com/color/48/000000/bitcoin.png" alt="Crypto">
                        <span>Crypto</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="payment-details-section">
            <h2>Payment Details</h2>
            <form id="paymentForm">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" value="<?php echo $eventPrice; ?>" disabled required>
                </div>
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiry Date</label>
                    <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                </div>
                <button type="submit" class="pay-button">Pay Now</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const fullName = urlParams.get("full_name");
            const email = urlParams.get("email");
            const eventTitle = urlParams.get("event_title");
            const eventPrice = parseFloat(urlParams.get("event_price"));
            const paymentMethod = urlParams.get("payment_method");
            const transactionId = urlParams.get("transaction_id");
            const selectedPaymentMethod = document.querySelector(`input[name="paymentMethod"][value="${paymentMethod}"]`);

            document.getElementById("paymentForm").addEventListener("submit", function (e) {
                e.preventDefault();

                const amount = parseFloat(document.getElementById("amount").value.trim());
                const cardNumber = document.getElementById("cardNumber").value.trim();
                const expiryDate = document.getElementById("expiryDate").value.trim();
                const cvv = document.getElementById("cvv").value.trim();
                const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

                if (!amount || !cardNumber || !expiryDate || !cvv) {
                    alert("Please fill in all fields.");
                    return;
                }

                if (!/^\d{4} \d{4} \d{4} \d{4}$/.test(cardNumber)) {
                    alert("Invalid card number format. Use 1234 5678 9012 3456");
                    return;
                }
                if (amount < eventPrice) {
                    alert("Insufficient balance");
                    return;
                }


                console.log(selectedPaymentMethod);
                const formData = {
                    full_name: fullName,
                    email: email,
                    event_title: eventTitle,
                    event_type: "paid",
                    charges: eventPrice,
                    payment_method: selectedPaymentMethod,
                    transaction_id: transactionId,
                };


                // Send data to register_event.php
                fetch("../registerEvent/register_event.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(formData),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert("Payment and registration successful!");
                            window.location.href = "/Event-Hive/allEvents/all-events.html"; // Redirect after success
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch((error) => console.error("Error:", error));
            });
        }); </script>
</body>

</html>