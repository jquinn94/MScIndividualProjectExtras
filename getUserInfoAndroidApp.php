<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];

    $getusersquery = "SELECT AES_DECRYPT(Android_users.password,'mykey') as password, Android_users.email, Android_users.first_name, Android_users.last_name FROM `Android_users` WHERE email = '$email'";
    
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