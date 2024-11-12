<?php
// Include database configuration
include('config.php');

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $hotel_name = $conn->real_escape_string($_POST['hotel_name']);
    $name = $conn->real_escape_string($_POST['name']);  
    $email = $conn->real_escape_string($_POST['email']); 
    $phone = $conn->real_escape_string($_POST['phone']); 
    $checkin_date = $conn->real_escape_string($_POST['checkin_date']);
    $checkout_date = $conn->real_escape_string($_POST['checkout_date']);
    $rooms = (int)$_POST['guests'];
    $guests = (int)$_POST['rooms'];
    $special_requests = $conn->real_escape_string($_POST['special_requests']);

    // Validate dates to ensure check-in is before check-out
    if (strtotime($checkin_date) >= strtotime($checkout_date)) {
        echo "<script>alert('Check-in date must be before the check-out date.'); window.history.back();</script>";
        exit;
    }

    // Validate required fields
    if (empty($hotel_name) || empty($name) || empty($email) || empty($phone) || empty($checkin_date) || empty($checkout_date)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO hotel_reservations (hotel_name, name, email, phone, checkin_date, checkout_date, guests, rooms, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiis", $hotel_name, $name, $email, $phone, $checkin_date, $checkout_date, $guests, $rooms, $special_requests);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Hotel reservation successful!'); window.location.href = 'home.html';</script>";
    } else {
        echo "<script>alert('Reservation failed. Please try again.'); window.location.href = 'hotel_reservation_form.html';</script>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>