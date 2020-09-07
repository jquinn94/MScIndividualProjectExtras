<?php

 include("conn.php");  
 
 if(isset($_GET['food_id'])){
    
    $foodid = $_GET['food_id'];
    $newAmountThrownOut = $_GET['amount_thrown_out'];

    $insertQuery = "UPDATE Android_userfoods
                    SET Android_userfoods.food_thrown_out = Android_userfoods.food_thrown_out + '$newAmountThrownOut'
                    WHERE userfood_id = '$foodid'";

    
    $result = $conn->query($insertQuery);

    if(!$result){
        $conn->error;
    }
}

?>