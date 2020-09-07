<?php

 include("conn.php");  

    $result1 = $conn->query("UPDATE `Android_userfoods`
                            SET 
                                Android_userfoods.age_in_days = Android_userfoods.age_in_days + 1");

    if(!$result1){
        echo $conn->error;
        exit;
    }else{
        $result2 = $conn->query("SELECT Android_foods.food_name, Android_userfoods.date_added, Android_users.account_typ, Android_users.push_notification_id, (Android_userfoods.batch_amount - (Android_userfoods.food_used+Android_userfoods.food_thrown_out)) AS 'Batch Left'
                                FROM `Android_userfoods` 
                                LEFT OUTER JOIN Android_users
                                ON
                                Android_users.users_id = Android_userfoods.belongs
                                LEFT OUTER JOIN Android_foods
                                ON
                                Android_userfoods.foodtype = Android_foods.food_id
                                WHERE age_in_days > (Android_foods.food_length_days - 3) AND (Android_userfoods.food_used + Android_userfoods.food_thrown_out < Android_userfoods.batch_amount)");

        if(!$result2){
            echo $conn->error;
        }else{

            $resultArray = array();

            while($row=$result2->fetch_assoc()){
                array_push($resultArray, $row);
            }

            echo json_encode($resultArray);

        }

        $conn->close();

    }
  }

?>