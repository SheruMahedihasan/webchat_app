<?php
session_start();
if (isset($_SESSION['login_user_id'])) {
    header('Location: http://localhost:8080/php-chat-app/auth/index.php');
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <title>Chat App - Login</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12">
                <div class="w-400 p-4 shadow rounded">
                    <form>
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h1 class="text-center">Login</h1>
                            <h6>Welcome!</h6>
                            <div id="error" class="text-danger"></div>
                            <div class="statusMsg"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number:</label>
                            <input type="number" class="form-control" placeholder="Enter the number" id="phone" name="phone">
                            <div id="phone_error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" autocomplete="off" class="form-control" placeholder="Enter the password" id="password" name="password">
                            <div id="password_error"></div>
                        </div>

                        <button type="button" id="login" class="btn mb-3">Login</button>
                        <span class="link">
                            Don't have an account?<a href="signup.php">Sign Up</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function() {
        $("#login").on("click", function() {
            var phone_v = $("#phone").val();
            var password_v = $("#password").val();
            if (phone_v == "" || password_v == "") {
                $("#error").fadeIn();
                $("#error").html("All field is a required.");
                setTimeout(() => {
                    $("#error").fadeOut();
                }, 3000);
            } else {
                $.ajax({
                    url: "../apis/login_user.php",
                    type: "POST",
                    data: {
                        phone: phone_v,
                        password: password_v
                    },
                    dataType: 'json',
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function(response) {
                        if (response.status == 1) {
                            // $('#login')[0].reset();
                            $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
                            location.href = "../chat/index.php";
                        } else if (response.status == 0) {
                            $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
                        }
                    }
                });
            }
        });
    });
</script>