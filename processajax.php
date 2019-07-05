<!-- This form handles the fetching request made by the $.ajax() method
  
  -->
  
   

   
<?php
    
    // Make the connection to your database through , by including your pdocon.php file. 

    include('pdocon.php');

    // Create an instance of your PDO class, which will manage the connection between php script and the database. 

    $db = new Pdocon; 

    // Prepare a query to return data to the HTML 

    $db->query("SELECT * FROM users"); // Knocks at the database's door to check if the prepared query is executable on the database. 
    
    //You fetch a single user from the users table. The fetchSingl() method of your instantiated connection object sends the execute() so you can skip that function 

    $result = $db->fetchSingle();

    if($result)
    {
        echo "Welcome to your Account ". $result['full_name']; // Output the first username in the Database. 
    }

    // The goal is to use AJAX to returnt the php result to the HTMl page. 

?>