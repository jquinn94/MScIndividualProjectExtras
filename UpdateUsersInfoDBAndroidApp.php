<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $firstName = $_GET['first_name'];
    $lastName = $_GET['last_name'];
    $emailToChange = $_GET['email_to_change'];
    $email = $_GET['email'];
    $password = $_GET['password'];

    $updateQuery = "UPDATE Android_users
                    SET first_name = '$firstName', last_name = '$lastName', email = '$emailToChange', password = (AES_ENCRYPT('$password','mykey'))
                    WHERE email = '$email'";

    $result = $conn->query($updateQuery);
    $resultArray = array();

    if(!$result){
        array_push($resultArray, $conn->error);
    }else{
        array_push($resultArray, "Success");
    }     

    echo json_encode($resultArray);   
        // Close connections
        $conn->close();
}

?>