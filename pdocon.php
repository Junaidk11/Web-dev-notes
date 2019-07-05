<?php

// we need to create a PDO class, 
// this class will handle my connections to the database

class Pdocon{
     // The connection Properties - properties to define our database, make it private because you won't use it any of the methods defined by the PDO class.
    private $host = "localhost" ; 
    private $user = "root";
    private $password = "";
    private $dbnm = "cus_app";
    
    
    // Handle our connection
    private $dbh; // this variable will store our connection to the database
    
    //Handle our error 
    private $errmsg;  // this will store our error message
    
    // Statment Handler:Storing our query 
    private $stmt; // stores the result on the prepared query by the PDO - either True = executable, send PDOStatement object to execute and get result or FALSE = error, send the PDOException object to get the error encountered. 
    
/* our public functions */
    
    // Method to open our connection - the public constructor for when you create your PDO class  
    public function __construct()
    {
        $dsn = "mysql:host=".$this->host."; dbname=".$this->dbnm;
        $options = array(
        PDO::ATTR_PERSISTENT => true, 
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        );
        try{
             $this->dbh = new PDO($dsn, $this->user, $this->password, $options); // Here our class's $dbh variable has been instantiated as the PDO class. It has all the methods of a PDO class and we have access to them. 
            //echo "Successfully Connected.";
        }catch(PDOException $error) // Catch error if the connection failed
        {
            $this->errmsg = $error->getMessage();
            echo $this->errmsg;

        }
    }
    
    // Next, we create our helper functions using the stmt property - statement property. This will help in avoiding repeating ourselves, which is what PDO class is about - recalling that in the procedural method, we made connection to the database by including the dbconnection.php file before sending the query along with the connection, followed by processing the query and closing the connection manually when we were done - we repeated this. PDO class allows to avoid this repetition of functions over and over again. 
    public function query($query) // this method will store the query that we wish to send to the database. 
    {
        $this->stmt = $this->dbh->prepare($query); // this will make the knock on the database and ask if the query passed is executable by the database or not
    }
    
    // Creating the binder function - to attach the parameters and extra information for the query to be executed. 
    public function bindvalue($param, $value, $type)
    {
        $this->stmt->bindValue($param, $value, $type);
    }

    // function to execute the bindedvalue 
    
    public function execute()
    {
        return $this->stmt->execute();
    }
    
    
    // Function to check if statement was successfully executed.
    
    public function confirm_result()
    {
        $this->dbh->lastInsertId(); // Returns true or false
    }
   
    // Command to fetch data in a result, which was accepted in an associative array. i.e. A method that will loop through the returned result of a successfully executed query which was stored in an associative array. 
      
    public function fetchMultiple()
    {
        // execute first and then loop through the result stored as an associated array.
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    // A method to fetch a single data
    
    public function fetchSingle()
    {
        // execute first and then fetch the result
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
        
    }
}


?>