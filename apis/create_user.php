<?php
include '../config/mysql.config.php';

$uploadDir = '../profiles/';
$randInt = rand(1000, 100000);

$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);

if (isset($_POST['name']) || isset($_POST['phone']) || isset($_POST['password']) || isset($_POST['profile'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = md5($password);

    if (!empty($name) && !empty($phone) && !empty($password)) {
        $uploadStatus = 1;
        $uploadedFile = '';
        if (!empty($_FILES["profile"]["name"])) {
            $fileName = basename($_FILES["profile"]["name"]);
            $newFileName = $randInt . "-" . $fileName;
            $targetFilePath = $uploadDir .  $newFileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                // Upload file to the server 
                if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
                    $uploadedFile = $newFileName;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
            }
        }

        if ($uploadStatus == 1) {

            $check_phone = $conn->query("select * from user where phone='$phone'");
            $check_phone_conn = mysqli_num_rows($check_phone);
            if ($check_phone_conn <  0) {

                $response['message'] = 'Phone number is already is exist!';
            } else {

                // Insert form data in the database 
                $sql = "INSERT INTO user (name,phone,password,profile_url) VALUES ('$name','$phone','$password1','$uploadedFile')";
                $sql_con = $conn->query($sql);

                if ($sql_con) {
                    $response['status'] = 1;
                    $response['message'] = 'Form data submitted successfully!';
                }
            }
        }
    }
} else {
    $response['message'] = 'Please fill all the mandatory fields (name and email).';
}
echo json_encode($response);
