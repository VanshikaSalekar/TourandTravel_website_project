<?php
// Include database configuration
include('config.php');

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $flight = $conn->real_escape_string($_POST['flight']);
    $travel_date = $conn->real_escape_string($_POST['date']);
    $passengers = (int)$_POST['passengers'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, flight, travel_date, passengers) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $phone, $flight, $travel_date, $passengers);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href = 'home.html';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>