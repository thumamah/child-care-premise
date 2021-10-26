<?php

    $serverName = "localhost";
    $username = "";
    $passsword = "";
    $database = "";


    // creating connnection
    $connection = mysqli_connect($serverName, $username, $passsword, $database);
    
    // checking connection

    if(!$connection){
        die("connection failed:" . mysqli_connect_error());
    }
    else{
       

        mysqli_set_charset($connection, 'utf8');
        //echo "hello welcome";
        

        
    }

    


?>