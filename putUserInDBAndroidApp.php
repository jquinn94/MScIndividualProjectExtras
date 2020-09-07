<?php

 include("conn.php");  
 
 if(isset($_GET['email'])){
    
    $email = $_GET['email'];
    $password = $_GET['password'];
    $accounttype = $_GET['accounttype'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];

    $insertusersquery = "INSERT INTO Android_users (email, password, account_typ, first_name, last_name)
                            VALUES ('$email', (AES_ENCRYPT('$password','mykey')), '$accounttype', '$firstname', '$lastname')";
    
    $result = $conn->query($insertusersquery);
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