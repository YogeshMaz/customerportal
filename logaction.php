<?php
session_start();
include 'logfunction.php'; // Include the log function

if (isset($_SESSION['email']) && isset($_POST['action'])) {
    $user = $_SESSION['email'];
    $action = $_POST['action'];
    log_user_activity("Customer Email : {$user} \n triggered Page action : {$action}");
    $reportName = "machinemaze-project-management";
    $formName = "Customer_Portal_Logs";
    $current_time = date('d-M-Y H:i:s');
    $addData = array(
        "data" => array(
            "Page" => $action,
            "Customer_Email" => $user,
            "Date_Time" => $current_time
        )
    );
    $json_data = json_encode($addData);
    updateLogRecord($reportName, $formName, $json_data);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

?>
