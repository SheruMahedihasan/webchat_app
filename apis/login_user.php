<?php
session_start();
include '../config/mysql.config.php';
$response = array(
    'status' => 0,
    'message' => 'Useer login failed, please try again.'
);

if (isset($_POST['phone']) && isset($_POST['password']) != "") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password1 = md5($password);

    $sql = "select * from user where phone='$phone' and password='$password1'";
    $sql_con = $conn->query($sql);
    $row = $sql_con->fetch_assoc();
    // $id = $row['id'];
    if (mysqli_num_rows($sql_con) <= 0) {
        $response['message'] = 'Login faield!';
    } else {
        $login_user_id = $row['id'];
        $sql_status = "update user set is_online=1 where id=$login_user_id";
        $sql_status_conn = $conn->query($sql_status);
        $_SESSION['login_user_id'] = $login_user_id;
        $response['status'] = 1;
        $response['message'] = 'Login successfully!';
    }
}
echo json_encode($response);
