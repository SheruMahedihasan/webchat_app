<?php
session_start();
if (!isset($_SESSION['login_user_id'])) {
    header('Location: http://localhost:8080/php-chat-app/auth/index.php');
}
$login_user_id = $_SESSION['login_user_id'];
// $userid = $_SESSION['select_user_id'];
// $select_userid = $_SESSION['select_user_id'];
// echo $select_userid;
include '../config/mysql.config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/391827d54c.js" crossorigin="anonymous"></script>
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
                <h3><?php echo ucfirst($row_main_user['name']); ?></h3>
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
                    <input type="text" id="search" placeholder="Search or start new chat   ">
                </div>
            </div>



            <!--chats -->
            <div class="chat-list">
                <?php
                $user_show_sql = $conn->query("select * from user where not id='$login_user_id'");
                foreach ($user_show_sql  as $key => $all_user) {
                    $list_id = $all_user['id'];
                    // print_r(" SELECT * FROM messages where NOT sender_id=$login_user_id and sender_id=$list_id
                    // ORDER BY id DESC
                    // LIMIT 1");
                    // exit;
                    $last_msg = $conn->query("SELECT * FROM messages where NOT sender_id=$login_user_id and sender_id=$list_id and receiver_id=$login_user_id
                    ORDER BY id DESC
                    LIMIT 1;");
                    if ($last_msg && $last_msg->num_rows > 0) {
                        $row_lsat_msg = $last_msg->fetch_assoc();
                        $msg = $row_lsat_msg['message'];
                    } else {
                        $msg = " ";
                    }
                    $isOnline = $all_user['is_online'];

                    if ($isOnline == 1) {
                        $show_isOnline = "<div class='circle'>
                        </div>";
                    } else {
                        $show_isOnline = "";
                    }
                    $time = $all_user['created_at'];
                    $time1 = date("H:i A", strtotime($time));
                ?>
                    <div class="chat-box" data-test='<?php echo $all_user['id']; ?>'>
                        <div class="img-box">
                            <?php
                            if (empty($all_user['profile_url'])) { ?>
                                <img class="dp" src="../assets/img/user_default.png" alt="">
                            <?php
                                echo $show_isOnline;
                            } else {
                            ?>
                                <img class="img-cover" src="../profiles/<?php echo $all_user['profile_url']; ?>" alt="">
                            <?php
                                echo $show_isOnline;
                            }
                            ?>
                        </div>

                        <div class="chat-details">
                            <form action="">
                                <?php
                                $receiver_id = $all_user['id'];
                                $_SESSION['receiver_id'] = $receiver_id;
                                ?>
                                <div class="text-head">
                                    <h4><?php echo ucfirst($all_user['name']); ?></h4>

                                </div>
                                <div class="text-message">
                                    <p><?php echo $msg; ?></p>
                                    <!-- <b>1</b> -->
                                </div>
                                </a>
                            </form>
                        </div>
                        <input type="hidden" id="user_id" name="id" value="<?php echo $all_user['id']; ?>" />
                    </div>
                <?php
                }
                ?>
            </div>



        </div>

        <div class="right-container">



            <div class="header" id="profileContainer">
                <!-- Profile information displayed here -->
            </div>




            <!--chat-container -->
            <div class="chat-container" id="chat-container">
                <!-- message information display -->
            </div>

            <!--input-bottom -->
            <div class="chatbox-input">
                <input type="text" id="input_mesg_send" placeholder="Type a message">

                <button id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
</body>

</html>
<?php

?>



<script>
    $(document).ready(function() {

        //  send message user
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
                        updateMsg();
                        $('statusMsg').html(response.message);
                        $('#input_mesg_send').val("");
                        $("#chat-container").animate({
                            scrollTop: 1500000000
                        }, 100);
                    }
                }
            })
        });

        //header load in user
        function updateProfile() {
            $.ajax({
                url: '../apis/get_profile.php',
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#profileContainer').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        updateProfile();

        function updateMsg() {
            $.ajax({
                url: '../apis/messages_show.php',
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#chat-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        // updateMsg();
        setInterval(function() {
            updateMsg() // this will run after every 5 seconds
        }, 500);

        // move selected user
        $('.chat-box').on("click", function(e) {

            e.preventDefault();
            var userId = $(this).attr("data-test");
            $.ajax({
                url: "../apis/receiver_user_show.php",
                type: "POST",
                data: {
                    user_id: userId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        updateProfile();
                        updateMsg();
                        $('#reponse_user').html('<h4>' + response.message + '</h4>');
                    }
                }
            });
        });

        //live search
        $("#search").on("keyup", function() {
            var search_term = $(this).val();
            $.ajax({
                url: "../apis/search_user.php",
                type: "POST",
                data: {
                    search: search_term
                },
                success: function(data) {
                    $(".chat-list2").html(data);
                }
            });
        });


        $('#OnshowDropdown').click(function() {
            $('.dropdown-content1').toggle('slow');
        });
        $('#OnshowDropdown_main_head').click(function() {
            $('.dropdown-content').toggle('slow');
        });

        
    });
</script>