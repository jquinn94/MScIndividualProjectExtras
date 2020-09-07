<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];

    $getusersquery = "SELECT Android_foods.food_name, Android_userfoods.date_added, Android_userfoods.userfood_id, Android_userfoods.age_in_days, Android_userfoods.batch_amount, Android_userfoods.food_used, Android_userfoods.food_thrown_out, Android_foods.food_length_days FROM Android_users 
                        LEFT OUTER JOIN Android_userfoods
                        ON Android_users.users_id = Android_userfoods.belongs
                        LEFT OUTER JOIN Android_foods
                        ON Android_userfoods.foodtype = Android_foods.food_id
                        WHERE Android_users.email = '$email' AND
                        (Android_userfoods.food_used + Android_userfoods.food_thrown_out) < 	
                        Android_userfoods.batch_amount
                        ORDER BY Android_userfoods.date_added DESC";
                        
    $result = $conn->query($getusersquery);

    if(!$result){
        $conn->error;
    }else{

        // We have results, create an array to hold the results
        // and an array to hold the data
        $resultArray = array();
        $tempArray = array();
            
        // Loop through each result
        while($row = $result->fetch_object())
        {
            // Add each result into the results array
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }
            
        // Encode the array to JSON and output the results
        echo json_encode($resultArray);
    }        
        // Close connections
        $conn->close();
}

?>