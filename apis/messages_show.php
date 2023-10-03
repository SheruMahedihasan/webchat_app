<?php
session_start();
include '../config/mysql.config.php';
$login_user_id = $_SESSION['login_user_id'];
if (isset($_SESSION['header_id']) && $_SESSION['header_id'] != '') {
    $show_id = $_SESSION['header_id'];
} else {
    $show_id = '';
}
$query_join = "SELECT * FROM messages LEFT JOIN user ON user.id = messages.sender_id
            WHERE (sender_id = {$login_user_id} AND receiver_id = {$show_id})
            OR (sender_id = {$show_id} AND receiver_id = {$login_user_id})";

$result = $conn->query($query_join);
if ($result) {
    foreach ($result as $key => $value) {
        $msg = $value['message'];
        $time = $value['send_on_date'];
        $time1 = date("H:i A", strtotime($time));
        $senderId = $value['sender_id'];

        ob_start();

        if ($senderId == $login_user_id) {
?>
            <div class="message-box my-message" id="sender_msg">
                <p><?php echo $msg; ?><br><span><?php echo $time1; ?></span></p>
            </div>
        <?php
        } else {
        ?>
            <div class="message-box friend-message" id="receiver_msg">
                <p><?php echo $msg; ?><br><span><?php echo $time1; ?></span></p>
            </div>
    <?php
        }
    }

    $output = ob_get_clean();
    echo $output;
} else {
    ob_start();
    ?>
    <div class="right-container">
        <img src="../assets/img/chat.png" alt="">
    </div>
<?php
    $output = ob_get_clean();
    echo $output;
}
?>