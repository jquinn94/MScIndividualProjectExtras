<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];

    $getrecipequery1 = "SELECT * FROM `Android_recipe` 
                        LEFT OUTER JOIN Android_recipe_details ON
                        Android_recipe.recipe_details = Android_recipe_details.recipe_details_id
                        WHERE Android_recipe.recipe_ingredient IN (SELECT Android_userfoods.foodtype FROM Android_userfoods WHERE (Android_userfoods.belongs = (SELECT Android_users.users_id from Android_users WHERE Android_users.email = '$email')) AND (Android_userfoods.food_used + Android_userfoods.food_thrown_out < Android_userfoods.batch_amount))
                        GROUP BY Android_recipe.recipe_details
                        HAVING COUNT(*) = (Android_recipe_details.amount_of_ingredients)
                        ORDER BY RAND()
                        LIMIT 1";

    $getrecipequery2 = "SELECT * FROM `Android_recipe` 
                        LEFT OUTER JOIN Android_recipe_details ON
                        Android_recipe.recipe_details = Android_recipe_details.recipe_details_id
                        WHERE Android_recipe.recipe_ingredient IN (SELECT Android_userfoods.foodtype FROM Android_userfoods WHERE (Android_userfoods.belongs = (SELECT Android_users.users_id from Android_users WHERE Android_users.email = '$email')) AND (Android_userfoods.food_used + Android_userfoods.food_thrown_out < Android_userfoods.batch_amount))
                        GROUP BY Android_recipe.recipe_details
                        HAVING COUNT(*) = (Android_recipe_details.amount_of_ingredients)
                        ORDER BY RAND()";

    $getrecipequery3 = 'SELECT * FROM `Android_recipe_details` WHERE recipe_details_id = 2';

    if(!isset($_GET['ingredient'])){
        $result = $conn->query($getrecipequery1);

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
    }else{
        $ingredient = $_GET['ingredient'];
        $result = $conn->query($getrecipequery2);
        
        if(!$result){
            $conn->error;
        }else{
            
            while($row = $result->fetch_assoc()){
                $recipename = $row['recipe_details'];
                
                $querytwo = "SELECT * FROM `Android_recipe` 
                                LEFT OUTER JOIN Android_recipe_details ON
                                Android_recipe.recipe_details = Android_recipe_details.recipe_details_id
                                WHERE Android_recipe.recipe_details = $recipename AND Android_recipe.recipe_ingredient = (SELECT Android_foods.food_id FROM Android_foods WHERE Android_foods.food_name = '$ingredient')";

                $result2 = $conn->query($querytwo);

                //echo $querytwo."<br><br>";
                if(!$result2){
                    $conn->error;
                }else{

                    
                    // We have results, create an array to hold the results
                    // and an array to hold the data
                    $resultArray = array();
                    $tempArray = array();
                        
                    // Loop through each result
                    while($row = $result2->fetch_object())
                    {
                        // Add each result into the results array
                        $tempArray = $row;
                        array_push($resultArray, $tempArray);
                    }
                        
                    // Encode the array to JSON and output the results
                    $jsonarray = json_encode($resultArray);
                    
                    if(!empty(json_decode($jsonarray,1))) {
                        echo json_encode($resultArray);
                        exit;
                    }

                }
            }
            
        }

    }
        
        echo "[]";
        // Close connections
        $conn->close();
}

?>