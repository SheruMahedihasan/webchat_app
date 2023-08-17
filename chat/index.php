<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/391827d54c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/css/style.css">
    <title>App -Chat</title>
</head>

<body>
    <div class=""></div>


    <div class="main-container">
        <div class="left-container">

            <!--header -->
            <div class="header">
                <div class="user-img">
                    <img class="dp" src="../assets/img/user_default.png" alt="">
                </div>
                <h3>Varis Ali</h3>
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
                <div class="chat-box">
                    <div class="img-box">
                        <img class="img-cover" src="../assets/img/profile.jpg" alt="">
                    </div>
                    <div class="chat-details">
                        <div class="text-head">
                            <h4>Mohammad</h4>
                            <p class="time unread">11:49</p>
                        </div>
                        <div class="text-message">
                            <p>“How are you?”</p>
                            <b>1</b>
                        </div>
                    </div>
                </div>
                <div class="chat-box">
                    <div class="img-box">
                        <img class="img-cover" src="../assets/img/siraj.png" alt="">
                    </div>
                    <div class="chat-details">
                        <div class="text-head">
                            <h4>siraj</h4>
                            <p class="time unread">10:49</p>
                        </div>
                        <div class="text-message">
                            <p>“I’ll be there.”</p>
                            <b>4</b>
                        </div>
                    </div>
                </div>
                <div class="chat-box">
                    <div class="img-box">
                        <img class="img-cover" src="../assets/img/akbar.png" alt="">
                    </div>
                    <div class="chat-details">
                        <div class="text-head">
                            <h4>Akbar</h4>
                            <p class="time unread">09:49</p>
                        </div>
                        <div class="text-message">
                            <p>“Make somebody’s day.”</p>
                            <b>2</b>
                        </div>
                    </div>
                </div>
            </div>

        </div>





        <div class="right-container">
            <!--header -->
            <div class="header">
                <div class="img-text">
                    <div class="user-img">
                        <img class="dp" src="../assets/img/IMG_20230520_200727.jpg" alt="">
                    </div>
                    <h4>Mahedi<br><span>Online</span></h4>
                </div>
                <div class="nav-icons">
                    <div class="dropdown">
                        <button class="dropbtn" id="OnshowDropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <div class="dropdown-content">
                            <button class="dropdown-btn">Profile</button>
                            <button class="dropdown-btn">Change password</button>
                            <button class="dropdown-btn">Logout</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--chat-container -->
            <div class="chat-container">
                <div class="message-box my-message">
                    <p>I've been waiting to see that show asap!<br><span>07:43</span></p>
                </div>
                <div class="message-box friend-message">
                    <p>Ahh, I can't believe you do too!<br><span>07:45</span></p>
                </div>
                <div class="message-box friend-message">
                    <p>The trailer looks good<br><span>07:45</span></p>
                </div>
                <div class="message-box friend-message">
                    <p>I've been waiting to watch it!!<br><span>07:45</span></p>
                </div>
                <div class="message-box my-message">
                    <p>😐😐😐<br><span>07:46</span></p>
                </div>
                <div class="message-box my-message">
                    <p>Mee too! 😊<br><span>07:46</span></p>
                </div>
                <div class="message-box friend-message">
                    <p>We should video chat to discuss, if you're up for it!<br><span>07:48</span></p>
                </div>
                <div class="message-box my-message">
                    <p>Sure<br><span>07:48</span></p>
                </div>
                <div class="message-box my-message">
                    <p>I'm free now!<br><span>07:48</span></p>
                </div>
                <div class="message-box friend-message">
                    <p>Awesome! I'll start a video chat with you in a few.<br><span>07:49</span></p>
                </div>
            </div>

            <!--input-bottom -->
            <div class="chatbox-input">
                <input type="text" placeholder="Type a message">
                <button id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#OnshowDropdown').click(function() {
                $('.dropdown-content').toggle('slow');
            });
        });
    </script>
</body>

</html>