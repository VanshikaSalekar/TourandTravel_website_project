<?php
session_start();
header('Content-Type: application/json');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login_register.html");
    exit;
}

include 'config.php';

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $user_id = $_SESSION['user']['id'];

    // File information
    $file = $_FILES['profile_picture'];
    $fileTmpPath = $file['tmp_name'];
    $fileName = uniqid() . '-' . basename($file['name']);
    $uploadDir = 'uploads/profile_pictures/';
    $uploadPath = $uploadDir . $fileName;

    // Move the file to the uploads directory
    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        // Update the database with the file path
        $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $uploadPath, $user_id);
        $stmt->execute();

        echo json_encode(["success" => true, "profile_picture" => $uploadPath]);
    } else {
        echo json_encode(["error" => "Failed to upload file"]);
    }
}
?>
