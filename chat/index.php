<?php
session_start();
if (!isset($_SESSION['login_user_id'])) {
    header('Location: http://localhost:8080/php-chat-app/auth/index.php');
}
$login_user_id = $_SESSION['login_user_id'];
include '../config/mysql.config.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/391827d54c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="../assets/css/style.css">
    <title>App -Chat</title>
</head>

<body>
    <div class=""></div>


    <div class="main-container">
        <div class="left-container">


            <?php
            $user_sql = $conn->query("select * from user where id='$login_user_id'");
            $row_main_user = $user_sql->fetch_assoc();
            $user_image = $row_main_user['profile_url'];
            ?>


            <!--header -->
            <div class="header">
                <div class="user-img">
                    <?php
                    if (empty($user_image)) { ?>
                        <img class="dp" src="../assets/img/user_default.png" alt="">
                    <?php
                    } else {
                    ?>
                        <img class="dp" src="../profiles/<?php echo $user_image; ?>" alt="">
                    <?php
                    }
                    ?>

                </div>
                <h3><?php echo $row_main_user['name']; ?></h3>
                <div class="nav-icons">
                    <div class="dropdown">
                        <button class="dropbtn" id="OnshowDropdown_main_head"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <div class="dropdown-content">
                            <button class="dropdown-btn">Profile</button>
                            <button class="dropdown-btn">Change password</button>
                            <a href="log_out.php"><button class="dropdown-btn">Logout</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <!--search-container -->
            <div class="search-container">
                <div class="input">
                    <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                    <input type="text" placeholder="Search or start new chat   ">
                </div>
                <!-- <i class="fa-sharp fa-solid fa-bars-filter"></i> -->
            </div>



            <!--chats -->
            <div class="chat-list">
                <?php
                $user_show_sql = $conn->query("select * from user where not id='$login_user_id'");
                foreach ($user_show_sql  as $key => $all_user) {
                    // $name = $all_user['name'];
                    $time = $all_user['created_at'];
                    $time1 = date("H:i A", strtotime($time));
                ?>
                    <div class="chat-box">
                        <!-- <label for="" id="user_id"><?php echo $all_user['id']; ?></label> -->
                        <!-- <input type="number" name="user_id" id="user_id" value="<?php echo $all_user['id']; ?>"> -->
                        <div class="img-box">
                            <?php
                            if (empty($all_user['profile_url'])) { ?>
                                <img class="dp" src="../assets/img/user_default.png" alt="">
                            <?php
                            } else {
                            ?>
                                <img class="img-cover" src="../profiles/<?php echo $all_user['profile_url']; ?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="chat-details">
                            <a href="index.php?Id=<?php echo $all_user['id']; ?>">
                                <?php
                                $receiver_id = $all_user['id'];
                                $_SESSION['receiver_id'] = $receiver_id;
                                ?>
                                <div class="text-head">
                                    <h4><?php echo $all_user['name']; ?></h4>

                                    <p class="time unread"><?php echo $time1; ?></p>
                                </div>
                                <div class="text-message">
                                    <p>“How are you?”</p>
                                    <b>1</b>
                                </div>
                            </a>
                        </div>
                        <input type="hidden" id="user_id" name="id" value="<?php echo $all_user['id']; ?>" />
                    </div>
                <?php
                }
                ?>
            </div>



        </div>


        <div class="right-container">


            <?php
            if (isset($_GET['Id'])) {
                $id = $_GET['Id'];

                $show_name = "";
                $user_status = "";
                $select_user = $conn->query("select * from user where id=$id");

                $user = mysqli_num_rows($select_user);

                if ($user == 0) {
                    echo "No user are found.";
                    die();
                }

                $row_select_user = $select_user->fetch_assoc();


                foreach ($select_user as $key => $row_select_user) {
                    $show_name = $row_select_user['name'];
                    $user_select_image = $row_select_user['profile_url'];
                    $time = $row_select_user['last_time'];
                    $user_status = $row_select_user['is_online'];
                };

                //date different get
                // $time1 = date("H:i A", strtotime($time));
                // $date = date('Y-m-d');
                // $date1 = date("Y-m-d", strtotime($time));
                // $match_date = date($date, strtotime($date1));
                // if ($date1 == $match_date) {
                //     $date_status = "today";
                // } elseif (date('Y-m-d', strtotime($date . '-1 day'))) {
                //     $date_status = "Yesterday";
                // } else {
                //     $date_status = $date1;
                // }


                $time1 = date("H:i A", strtotime($time));
                $date = date('Y-m-d');
                $date1 = date("Y-m-d", strtotime($time)); // Assuming $time is a valid time string
                $match_date = date('Y-m-d', strtotime($date1)); // Use $date1 here

                $date_bk = date('Y-m-d', strtotime($date . ' -1 day'));

                if ($date == $match_date) {
                    $date_status = "today";
                } elseif ($date1 == $date_bk) {
                    $date_status = "Yesterday"; // Correct assignment
                } else {
                    $date_status = $date1;
                }

                //online and offline get
                if ($user_status == 0) {
                    $status = "Offline";
                } else {
                    $status = "Online";
                }
            }
            ?>


            <!--header -->
            <div class="header">
                <div class="img-text">
                    <div class="user-img">
                        <?php
                        if (empty($user_select_image)) { ?>
                            <img class="dp" src="../assets/img/user_default.png" alt="">
                        <?php
                        } else {
                        ?>
                            <img class="dp" src="../profiles/<?php echo $user_select_image; ?>" alt="">
                        <?php
                        }
                        ?>
                    </div>
                    <h4><?php echo $show_name; ?><br><span><?php echo $status; ?></span><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><span><?php echo $date_status; ?></span></h4>
                </div>
                <div class="nav-icons">
                    <div class="dropdown">
                        <button class="dropbtn" id="OnshowDropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <div class="dropdown-content1">
                            <button class="dropdown-btn">Profile</button>
                            <button class="dropdown-btn">Change password</button>
                            <a href="log_out.php"><button class="dropdown-btn">Logout</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <!--chat-container -->
            <div class="chat-container">
                <div class="message-box my-message" id="sender_msg">
                    <p>I've been waiting to see that show asap!<br><span>07:43</span></p>
                </div>
                <div class="message-box friend-message" id="receiver_msg">
                    <p>Ahh, I can't believe you do too!<br><span>07:45</span></p>
                </div>
            </div>

            <!--input-bottom -->
            <div class="chatbox-input">
                <input type="text" id="input_mesg_send" placeholder="Type a message" autocomplete="off">
                <input type="text" id="reciver-get-id" value="<?php echo $_GET['Id'] ?>" hidden />
                <button id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>

</body>

</html>
<?php

?>

<script>
    $(document).ready(function() {

        $("#btn-send").on("click", function() {
            var msg = $("#input_mesg_send").val();
            $.ajax({
                url: "../apis/message_sent.php",
                type: "POST",
                data: {
                    send_msg: msg
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        $('.statusMsg').html(response.message);
                    }
                }
            })
        });

        $('.chat-box').on('click', (e) => {
            const userId = $('#user_id');
        });


        $('#OnshowDropdown').click(function() {
            $('.dropdown-content1').toggle('slow');
        });
        $('#OnshowDropdown_main_head').click(function() {
            $('.dropdown-content').toggle('slow');
        });
    });
</script>