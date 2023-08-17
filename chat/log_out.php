<?php
include '../config/mysql.config.php';
session_start();
$login_user_id = $_SESSION['login_user_id'];
$date = date('Y-m-d H:i:s');
$sql = $conn->query("update user set is_online='0',last_time='$date' where id=$login_user_id");
session_unset();
session_destroy();
header('Location: http://localhost:8080/php-chat-app/auth/index.php');
