<?php
function log_user_activity($message) {
    $log_file = 'user_activity.log';
    $current_time = date('Y-m-d H:i:s');
    $log_message = "[{$current_time}] {$message}\n";
    file_put_contents($log_file, $log_message, FILE_APPEND);
}
?>
