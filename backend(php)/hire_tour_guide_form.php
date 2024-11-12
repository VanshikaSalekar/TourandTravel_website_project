<?php
// Include the database connection
include('config.php');

// Get form data
$guide_name = $_POST['guide_name'];
$destination = $_POST['destination'];
$hire_date = $_POST['hire_date'];
$duration = $_POST['duration'];
$price_per_day = $_POST['price'];
$total_price = $_POST['total_price'];

// Validate data
if (empty($guide_name) || empty($destination) || empty($hire_date) || empty($duration) || empty($price_per_day) || empty($total_price)) {
    die("All fields are required.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO hired_guides (guide_name, destination, hire_date, duration, price_per_day, total_price) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssidd", $guide_name, $destination, $hire_date, $duration, $price_per_day, $total_price);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Hired Guide successfully!'); window.location.href = 'home.html';</script>";
} else {
    echo "<script>alert('Something went wrong! Try Again!; window.location.href = 'hire_tour_guide_form.html';</script>";
}

// Close connections
$stmt->close();
$conn->close();
?>