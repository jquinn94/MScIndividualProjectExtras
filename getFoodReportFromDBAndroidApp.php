<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){

    $dateFrom = $_GET['date_from'];
    $dateTo = $_GET['date_to'];
    $email = $_GET['email'];

    $selectQuery = "SELECT * FROM `Android_userfoods` 
                    LEFT OUTER JOIN 
                    Android_foods ON Android_foods.food_id = Android_userfoods.foodtype
                    WHERE Android_userfoods.date_added >= '$dateFrom' and Android_userfoods.date_added <= '$dateTo' 
                    and Android_userfoods.belongs = (SELECT Android_users.users_id FROM Android_users WHERE Android_users.email = '$email')";

    
    $result = $conn->query($selectQuery);

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