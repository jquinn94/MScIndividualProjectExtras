<?php

 include("conn.php");  
 
 if(isset($_GET['email']) && isset($_GET['password'])){
    
    $email = $_GET['email'];
    $password = $_GET['password'];

    $getusersquery = "SELECT Android_users.email, Android_users.account_typ FROM Android_users WHERE email = '$email' AND password = (AES_ENCRYPT('$password','mykey'))";

    $result = $conn->query($getusersquery);

    if(!$result){
        echo $conn->error;
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