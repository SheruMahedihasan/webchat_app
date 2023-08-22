<?php
session_start();
$login_user_id = $_SESSION['login_user_id'];
include '../config/mysql.config.php';
$search_term = $_POST['search'];


if(strlen($search_term)>0){
    $sql = "select *from user where name LIKE '%{$search_term}%'";
    $result = mysqli_query($conn, $sql);
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        foreach ($result  as $key => $all_user) {   
    
            $output .= "
            
            <div class='chat-details'>
                <form action=''>
                    <div class='text-head'>
                        <h4>{$all_user['name']}</h4>
                    </div>
                </form>
            </div>";
        }
    } else {
        $output .= "<div class='text-center'>No results found for '{$search_term}'</div>";
    }
}else{
    echo "all user";
}


echo $output;
