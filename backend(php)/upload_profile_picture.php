<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user']['id'];
$upload_dir = "uploads/profile_pictures/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
    $filename = "profile_{$user_id}." . $file_ext;
    $filepath = $upload_dir . $filename;

    if (move_uploaded_file($file_tmp, $filepath)) {
        // Update filepath in database
        $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $filepath, $user_id);
        $stmt->execute();

        echo json_encode(["success" => true, "filepath" => $filepath]);
    } else {
        echo json_encode(["error" => "File upload failed"]);
    }
} else {
    echo json_encode(["error" => "File upload error"]);
}
?>
