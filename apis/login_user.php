<?php
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

    if ($sql_con) {
        $response['status'] = 1;
        $response['message'] = 'Login successfully!';
    }
}
echo json_encode($response);
