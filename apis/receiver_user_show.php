<?php
session_start();
include '../config/mysql.config.php';
$userid = $_POST['user_id'];
$date_status = $status = $user_select_image = "";
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);
$sql = "select * from user where id=$userid";
$sql_con = $conn->query($sql);
$row = $sql_con->fetch_assoc();
$userid = $row['id'];
$_SESSION['select_user_id'] = $userid;

if ($sql_con) {
    $response['status'] = 1;
    $response['message'] = "$userid";
}
echo json_encode($response);
