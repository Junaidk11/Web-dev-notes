<?php 
    
   /* // Manual connection to the database; using PHP function mysqli_connect(takes 4 parameters);
    // The parameters are discussed in the SFU portal documents. 
    $name_of_server = "localhost";
    $username = "root";
    $password ="";
    $database_name = "cus_app";

    $connection = mysqli_connect($name_of_server, $username, $password, $database_name);
    if($connection)
        echo "Connection was successfull";      
    else
    {
        echo "Connection was unsuccesfull".mysqli_error($connection); // mysqli_error - sends the error with the signal
        die($connection); // Kills the connection.
    }
    */

    // Use "try and catch" mehtod to connect to a database - a more practical method to make connectin to the database. 
    $name_of_server = "localhost";
    $username = "root";
    $password ="";
    $database_name = "cus_app";

    try
    {
        $connection = mysqli_connect($name_of_server, $username, $password, $database_name); // try to connect to the database
        if($connection) // if the connection is made, echo the following
            echo "Database connection was successful.";
    }
    catch(Exception $php_errormsg) // if connection is not successful, try to catch what the error was, which is stored in the exception class
    {
        echo $php_errormsg->$_GET; //gives the error associated with the connection failure
    }
    
?>


