<?php
// Include database configuration
include('config.php');

// Start session
session_start();

// Function to validate email format
function validateEmail($email) {
    return preg_match('/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|outlook|hotmail)\.com$/', $email);
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validate email format
    if (!validateEmail($email)) {
        echo "<script>alert('Please enter a valid email address (e.g., example@gmail.com).'); window.location.href = 'login_register.html';</script>";
        exit;
    }

    // Check if the user is already registered
    $checkUserSql = "SELECT * FROM users WHERE email = ?";
    $checkUserStmt = $conn->prepare($checkUserSql);
    $checkUserStmt->bind_param('s', $email);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows > 0) {
        // User already registered
        echo "<script>alert('You might be already registered! Try loging in!'); window.location.href = 'login_register.html';</script>";
        exit;
    }

    // Insert into the database if the user is not already registered
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $name, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('You have successfully registered. Please login!'); window.location.href = 'login_register.html';</script>";
        exit;
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.location.href = 'login_register.html';</script>";
        exit;
    }
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!validateEmail($email)) {
        echo "<script>alert('Please enter a valid email address (e.g., example@gmail.com).'); window.location.href = 'login_register.html';</script>";
        exit;
    }

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("location:profile.html");
        exit;
    } else {
        echo "<script>alert('Invalid email or password!'); window.location.href = 'login_register.html';</script>";
        exit;
    }
}
?>