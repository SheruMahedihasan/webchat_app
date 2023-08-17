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
    <title>Chat App - Sign Up</title>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12">
                <div class="w-400 p-4 shadow rounded">
                    <form autocomplete="off" id="form_submit" method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h1 class="text-center">Sign Up</h1>
                            <h6>To continue, Sign Up</h6>
                            <div class="statusMsg"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter the name" id="name" name="name">
                            <div id="name_error"></div>
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
                        <div class="mb-3">
                            <label class="form-label">Confirm Password:</label>
                            <input type="password" placeholder="Enter the confirm password" class="form-control" id="cpassword" name="cpassword">
                            <div id="cpassword_error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile picture:</label>
                            <input type="file" class="form-control" name="profile" id="profile">
                        </div>
                        <button id="sign_up" class="btn mb-3">Sign Up</button>
                        <span class="link">already have an account?<a href="index.php">Login</a></span>
                    </form>
                </div>
            </div>

        </div>
    </div>


</body>

</html>



<!-- Your existing ajax code -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#form_submit").on("submit", function(e) {
            e.preventDefault();

            // Call your validation functions here
            if (!checkUser() || !checkPhone() || !checkPassword() || !checkPasswordMatch()) {
                return;
            }

            const formData = new FormData(this);

            $.ajax({
                url: "../apis/create_user.php",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.status == 1) {
                        $('#form_submit')[0].reset();
                        $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
                        location.href = "index.php";
                    } else {
                        $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
                    }
                }
            });
        });

        function checkUser() {
            var patternUser = "/^[a-zA-z]*$/";
            var user = $("#name").val();
            var validUser = patternUser.test(user);
            if (user == "") {
                $("#name_error").html('required username');
                return false;
            } else if ($("#name").val().length < 4) {
                $("#name_error").html('Username length is too short min 4 characters.');
                return false;
            } else if (!validUser) {
                $("#name_error").html('Username should be a-z, A-Z, 0-9 only.');
                return false;
            } else {
                $("#name_error").html('');
                return true;
            }
        }

        function checkPassword() {
            var patternPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            var password = $("#password").val();
            var validPassword = patternPassword.test(password);
            if (password === "") {
                $("#password_error").html("Password is a required field");
                return false;
            } else if (!validPassword) {
                $("#password_error").html("Minimum eight characters, at least one letter, one number, and one special character.");
                return false;
            } else {
                $("#password_error").html('');
                return true;
            }
        }

        function checkPhone() {
            var phone = $("#phone").val();
            if (phone === "") {
                $("#phone_error").html("required field");
                return false;
            } else if (!$.isNumeric(phone)) {
                $("#phone_error").html("Only numbers are allowed");
                return false;
            } else if (phone.length !== 10) {
                $("#phone_error").html("10 digits are required");
                return false;
            } else {
                $("#phone_error").html('');
                return true;
            }
        }

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#cpassword").val();
            if (password !== confirmPassword) {
                $("#cpassword_error").html("Passwords do not match");
                return false;
            } else {
                $("#cpassword_error").html('');
                return true;
            }
        }
    });
</script>