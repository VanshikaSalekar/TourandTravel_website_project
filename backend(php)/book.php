<?php
// Database connection
include 'config.php'; // Ensure this file is set up to connect to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $trip_name = $_POST['trip_name'];
    $trip_price = $_POST['trip_price'];
    $number_of_travelers = $_POST['number_of_travelers'];

    // Prepare SQL query to insert booking details into the database
    $sql = "INSERT INTO package_bookings (trip_name, trip_price, number_of_travelers)
            VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sii", $trip_name, $trip_price, $number_of_travelers);

        if ($stmt->execute()) {
            echo "<script>alert('Booking successful!'); window.location.href='packages.html';</script>";
        } else {
            echo "<script>alert('Error in booking. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Something went wrong. Try again!'); window.history.back();</script>";
    }

    $conn->close();
} else {
    header("Location: packages.html");
    exit;
}
?>