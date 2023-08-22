<?php
// Include your database connection code if not included already
// ...
session_start();
include '../config/mysql.config.php';
if (isset($_SESSION['select_user_id'])) {
    $userid = $_SESSION['select_user_id'];
    $show_name = $status = "";
    $user_status = "";
    $select_user = $conn->query("SELECT * FROM user WHERE id=$userid");


    # code...

    $row_select_user = $select_user->fetch_assoc();
    // print_r($row_select_user);


    foreach ($select_user as $key => $row_select_user) {
        $show_id = $row_select_user['id'];
        $show_name = $row_select_user['name'];
        $user_select_image = $row_select_user['profile_url'];
        $time = $row_select_user['last_time'];
        $user_status = $row_select_user['is_online'];
    };
    $_SESSION['header_id'] = $show_id;
    // date different get
    $time1 = date("H:i A", strtotime($time));
    $date = date('Y-m-d');
    $date1 = date("Y-m-d", strtotime($time));
    $match_date = date('Y-m-d', strtotime($date1)); // Use $date1 here

    $date_bk = date('Y-m-d', strtotime($date . ' -1 day'));

    if ($date == $match_date) {
        $date_status = "today  |" . $time1;
    } elseif ($date1 == $date_bk) {
        $date_status = "Yesterday   |" . $time1;
    } else {
        $date_status = $date1;
    }

    //online and offline get
    if ($user_status == 0) {
        $status = "Offline";
    } else {
        $status = "Online";
    }

    ob_start();
?>
    <!--header -->
    <div class="header">
        <div class="img-text">
            <div class="user-img">
                <?php
                if (empty($user_select_image)) { ?>
                    <img class="dp" src="../assets/img/user_default.png" alt="">
                <?php } else { ?>
                    <img class="dp" src="../profiles/<?php echo $user_select_image; ?>" alt="">
                <?php } ?>
            </div>
            <h4><?php echo ucfirst($show_name); ?><br><span><?php echo $date_status; ?></span><span></span></h4>
        </div>
        <div class="nav-icons">
            <div class="dropdown">
                <!-- <button class="dropbtn" id="OnshowDropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button> -->
                <div class="dropdown-content1">
                    <button class="dropdown-btn">Profile</button>
                    <button class="dropdown-btn">Change password</button>
                    <a href="log_out.php"><button class="dropdown-btn">Logout</button></a>
                </div>
            </div>
        </div>
    </div>
<?php
    $output = ob_get_clean();
    echo $output; // Output the profile information
} else {
    ob_start();
?>
    <div class="header">
        <h4>Not selected user!</h4>
    </div>
<?php
    $output = ob_get_clean();
    echo $output;
}
?>