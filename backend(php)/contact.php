<?php
// Include the database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please enter a valid email.');</script>";
    } else {
        // Prepare SQL query to insert the data into the database
        $query = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('sss', $name, $email, $message);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully! We will get back to you soon.'); window.location.href='contact.html'</script>";
        } else {
            echo "<script>alert('Error sending message. Please try again later.');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
