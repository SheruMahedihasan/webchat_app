<?php
session_start();
// if (isset($_SESSION['login_user_id'])) {
//     header('Location: http://localhost:8080/php-chat-app/auth/index.php');
//     exit();
// } 
?>
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
                    <form autocomplete="off" id="ForgotPasswordForm">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h1 class="text-center">Forgot password</h1>
                            <div class="form-message"></div>
                            <div class="statusMsg"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" autocomplete="off" class="form-control" placeholder="Enter the Email" id="email" name="email">
                            <div id="email_error" style="color: red;"></div>
                        </div>

                        <button type="button" name="forgot" id="forgot" class="btn mb-3">Reset password</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function() {
        // $("#forgot").on("click", function(e) {
        //     e.preventDefault();

        //     var email = $("#email").val();

        //     $.ajax({
        //         url: "../apis/forgot_password.php",
        //         type: "POST",
        //         data: {
        //             email: email
        //         },
        //         success: function(data) {
        //             $(".form-message").css("display", "block");

        //             $(".form-message").html('<p class="alert alert-success">' + data + '</p>');
        //         }
        //     })
        // });
    });
</script>