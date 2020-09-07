<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];
    $id = $_GET['id'];

    $getusersquery = "UPDATE Android_users SET push_notification_id='$id' WHERE email='$email'";
    
    $result = $conn->query($getusersquery);

    if(!$result){
        $conn->error;
    }
}

?>