<?php

 include("conn.php");  
 
 if(isset($_GET['food_name'])){
    
    $email = $_GET['email'];
    $foodName = $_GET['food_name'];
    $ageInDays = $_GET['age_in_days'];
    $dateAdded = $_GET['date_added'];
    $batchAmount = $_GET['batch_amount'];

    $insertQuery = "INSERT INTO Android_userfoods(foodtype, belongs, date_added, age_in_days, batch_amount)
        VALUES ((SELECT food_id FROM Android_foods WHERE food_name = '$foodName'), 
        (SELECT users_id FROM Android_users WHERE email = '$email'), 
        '$dateAdded', '$ageInDays', '$batchAmount')";

    
    $result = $conn->query($insertQuery);

    if(!$result){
        $conn->error;
    }
}

?>