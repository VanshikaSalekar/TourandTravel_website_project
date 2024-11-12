<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user']['id'];
$sql = "SELECT name, email, bio, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(["error" => "User data not found"]);
}

$stmt->close();
$conn->close();
?>
