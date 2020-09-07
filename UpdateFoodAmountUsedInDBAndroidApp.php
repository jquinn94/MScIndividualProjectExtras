<?php

 include("conn.php");  
 
 if(isset($_GET['food_id'])){
    
    $foodid = $_GET['food_id'];
    $newAmountUsed = $_GET['amount_used'];

    $insertQuery = "UPDATE Android_userfoods
                    SET Android_userfoods.food_used = Android_userfoods.food_used + '$newAmountUsed'
                    WHERE userfood_id = '$foodid'";

    
    $result = $conn->query($insertQuery);

    if(!$result){
        $conn->error;
    }
}

?>