<?php

 include("conn.php");  
 
 if(isset($_GET['foodID'])){
    
    $foodid = $_GET['foodID'];

    $deleteFoodQuery = "DELETE FROM Android_userfoods WHERE userfood_id='$foodid'";
    
    $result = $conn->query($deleteFoodQuery);

    if(!$result){
        $conn->error;
    }      
        // Close connections
        $conn->close();
}

?>