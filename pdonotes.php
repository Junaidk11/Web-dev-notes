<?php

// Next we look at the PDO class
// PDO class represents connection between 
// PHP and database. 

// The PDO class needs to be instantiated if:
// you wish to create a class or a file
// that contains your database connection details. 

// An important note:
// THE PDO CLASS NEEDS TO BE INSTANTIATED IN A PUBLIC CONSTRUCT - i.e. you call this public construct function when you wish to create a connection to your database. 
public function_construct() // The public construct that instantiates your PDO Class, which will make the connection between your PHP script and your database. 
{
    
    $options = array ( 
    // We use the scope resolution operator because the variables we're trying to access are static public variables, i.e. they cannot be to changed during the program. They can only be accessed by static public functions - recalling OOB principals
    PDO::ATTR_PERSISENT => true; // How you want the connection to be established.
    PDO::ATTR_ERROR => PDO::ERRMODE_EXCEPTION; // Error handling by throwing the error to the Exception
)
        
    $connectionhandler = new PDO($dsn,$username, $password, $options); 
    
    
    // $options - an array, that sets the attributes of your connection to the database.
// The attributes available to set can be found from the PDO class manual online. 
// some of the common attributes are: 
// the type and how you want your connection to be handled. 
// and how you want an error to be reported - if an error should occur. 
// $dsn  = database source name - type of database, name of host or port and name of database. 


}


// NOTE: PDO class's methods, when executed successfully, will return the method's returned result to the PDOStatement Class.
// Similarly, if the method's were unable to execute successfully, they will return the error to the PDOException Class. 
// Also, if you use a method of PDOStatement Class, if they are executed successfully, they will return the result to itself and if they're unable to execute its methods successfully, they will return the error to the PDOException Class. 

// The PDO class opens the connection to the database and has methods that prepare your queries for you, just like the procedural way we did in the 'mysqltablemanipulation.php' file. The PDO class is more secure and reduces alot of overhead from the user, as it has methods that can be exploited for user needs. The PDO class prepares the query for the database to execute and the result returned by the database, if the query is succesfully executed, is returned as object of PDOStatment class.  Therefore, you have to use the PDOStatement class's methods to perform various actions when the PDO method is successfully executed. Also, if the query prepared by the PDO class is not successfully executed, the returned error is returned as an object of PDOException class type. Therefore, you have to use the methods of the PDOException class to handle the error that was sent by the unsuccessful execution of a query prepared by the PDO class.

// If a query prepared by the PDO class is successfully executed by the database, the PDO method will return true and the result will be returned as a PDOStatement. And if the query was not executed, the PDO method will return false and the error will be returned as a PDOException object and you can use the PDOException methods to check what the error was. 


// Next we look at PDOStatement Class - some of the important methods, we can find all the methods from the PDO website. 
// The PDOStatement class methods provide methods for your disposal, to handle/process the data returned by the PDO class. 

// The PDO prepare method, doesn't execute anything on the database, it simply checks with the database, if the statement is executable, i.e. it checks with the databases, if the tables requested, exist. If the prepared statement by the PDO is executable on the database, it returns a true. Following the returned true, the PDOStatement class's execute function is called to execute the statement on the database. And, there is a method in the PDOStatement class that allows addition of extra information to the query prepared by the PDO class, i.e. PDO class checks if the table exist in the connection, and the PDOStatement class's bindValue method can be used to look for a specific row/information in that table. 
// The procedure method we used before, you can't actually check if the query is executable or not and then execute/add more speicific information. Therefore, the PDO class and the PDOStatement Class provide a security layer to access information stored on a database. 

// PDOException Class
// when a prepared query is sent to the database and the returned value is false, i.e the query is not executable. In this case, the database says come back with the PDOException class and i will give the error message to it - so that the user is able to check what the error was. 

// Always remember the procedure as:
// PDO class prepares a query, knocks on the database's door. The database checks if the query is executable. It Returns true to ask for the PDOStatement class to be sent - to execute the query with binded parameters if needed. It returns False to ask for the PDOException class to be sent - to send the error message to the user.


/* 

            PHP Data Object Example: Creating a Database and Checking/Testing Connection
            
            pdocon.php - creating the PDO class to handle my connections to the database that I was handling the procedural way in the mysqltablemanipulation.php file. 
            The goal is to replace the database connection PHP code in the mysqltablemanipulation.php file with the more secure connection way - the PDO class way. 
                      
*/










?>