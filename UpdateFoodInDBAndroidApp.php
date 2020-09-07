<?php

 include("conn.php");  
 
 if(isset($_GET['food_name'])){
    
    $foodName = $_GET['food_name'];
    $ageInDays = $_GET['age_in_days'];
    $foodid = $_GET['food_id'];
    $batch_size = $_GET['batch_size'];

    $insertQuery = "UPDATE Android_userfoods
                    SET foodtype = (SELECT Android_foods.food_id FROM Android_foods WHERE Android_foods.food_name = '$foodName'), age_in_days = '$ageInDays', batch_amount = '$batch_size'
                    WHERE userfood_id = '$foodid'";

    
    $result = $conn->query($insertQuery);

    if(!$result){
        $conn->error;
    }
}

?>