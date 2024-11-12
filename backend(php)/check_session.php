<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "logged_out"]);
} else {
    echo json_encode(["status" => "logged_in"]);
}
?>