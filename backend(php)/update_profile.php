<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

// Validate and sanitize input data
$field = $data['field'];
$value = $data['value'];
$allowed_fields = ["email", "name", "bio"];  // Fields that can be updated

// Check if the provided field is valid
if (!in_array($field, $allowed_fields)) {
    echo json_encode(["error" => "Invalid field"]);
    exit;
}

$user_id = $_SESSION['user']['id'];  // Get user ID from session

// Prepare SQL query based on the field
// For other fields, sanitize value (e.g., escape strings)
if ($field === 'email') {
    // Validate email if it's the email field
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Invalid email format"]);
        exit;
    }
}

// For text fields (email, name, bio), bind as string
$sql = "UPDATE users SET $field = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $value, $user_id); // For email, name, and bio (all strings)

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to update profile"]);
}

$stmt->close();
$conn->close();
?>
