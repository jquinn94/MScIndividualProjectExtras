<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];

    $query = "UPDATE Android_users SET Android_users.push_notification_id = '0' WHERE email = '$email'";
    
    $result = $conn->query($query);

    if(!$result){
        echo $conn->error;
    }  

    // Close connections
    $conn->close();
}

?>