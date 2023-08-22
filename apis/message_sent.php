<?php
session_start();
if (!isset($_SESSION['login_user_id']) && !isset($_SESSION['receiver_id'])) {
    header('Location: http://localhost:8080/php-chat-app/auth/index.php');
}
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);
$login_user_id = $_SESSION['login_user_id'];
$show_id = $_SESSION['header_id'];
$receiver_id = $_SESSION['receiver_id'];
include '../config/mysql.config.php';
$sent_msg = $_POST['send_msg'];
if (isset($sent_msg)) {

    $sql = "INSERT INTO messages (sender_id,receiver_id,message) VALUES ('$login_user_id','$show_id','$sent_msg')";
    // print_r($sql);
    // exit;
    $sql_con = $conn->query($sql);
    // print_r($sql_con);
    // exit;
    if ($sql_con) {
        $response['status'] = 1;
        $response['message'] = "message sent";
    } else {
        $response['message'] = "message sent failed";
    }
}
echo json_encode($response);
