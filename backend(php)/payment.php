<?php
session_start();
require_once 'config.php'; // Include the database connection configuration

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login_register.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id']; // Get user ID from session
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];

    // Encrypt sensitive data (cardNumber, cvv) for added security
    $encryptedCardNumber = password_hash($cardNumber, PASSWORD_BCRYPT);
    $encryptedCVV = password_hash($cvv, PASSWORD_BCRYPT);

    // Insert payment data into the database
    $stmt = $conn->prepare("INSERT INTO payments (user_id, email, amount, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $userId, $email, $amount, $encryptedCardNumber, $expiryDate, $encryptedCVV);

    if ($stmt->execute()) {
        echo "Payment successful!";
    } else {
        echo "Payment failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>