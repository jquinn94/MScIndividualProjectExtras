<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];

    $deleteFoodQuery = "DELETE FROM Android_userfoods WHERE Android_userfoods.belongs=(SELECT Android_users.users_id FROM Android_users WHERE Android_users.email = '$email')";
    
    $result = $conn->query($deleteFoodQuery);

    if(!$result){
        $conn->error;
    }else{
        $deleteUserQuery = "DELETE FROM Android_users WHERE Android_users.email = '$email'";
        $result2 = $conn->query($deleteUserQuery);

        if(!$result2){
            $conn->error;
        }
    }      
        // Close connections
        $conn->close();
}

?>

