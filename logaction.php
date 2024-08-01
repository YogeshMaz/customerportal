<?php
session_start();
include 'logfunction.php'; // Include the log function

if (isset($_SESSION['email']) && isset($_POST['action'])) {
    $user = $_SESSION['email'];
    $action = $_POST['action'];
    log_user_activity("User {$user} triggered action: {$action}");
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
