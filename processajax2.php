<!-- 
 
 This file handles the Registration Form request that is sent my $.post() method of JQUERY AJAX
  
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




<!-- Now we will write a PHP tag, that will process the form -->

<?php
    
    /* Write your Form processing PHP code here */

    /* 
    
            When using AJAX you're not actually directly posting to the server. In fact, you're using AJAX to send requests to specifc php files on the that will handle the requests. Therefore, the following check:
            
             if($_SERVER["REQUEST_METHOD"]=="POST") // if the form submission method is POST
            {
                    // Form processing
            }
            is not ideal. Instead, use the $_POST['HTMLFIELDNME']; to check if any of the fields are set to start the processing of the form. 
    */
    
        // if the form's email field has been set
    if(isset($_POST['email']))
       {
        /*
        Validate and Sanitize the data entered into the form, to avoid getting hacked - if you don't validate sanitize, the information entered in the form can be a PHP script that could possibly infiltrate your server that is processing the submitting form - in short: sanitize submitted Form data before processing the form to avoid getting hacked. 
        */
        
        // collect your data in raw form by using the trim function. Form  action is POST thats why we access our form information using the $_POST['inputfieldname'];
        
        // Collect values of input field name
        $raw_name       = trim($_POST['fullname']);
        $raw_email      = trim($_POST['email']);
        $raw_password   = trim($_POST['pwd']);
        $raw_accept     = trim($_POST['accept']);
        
        /*
        Validate and Sanitize the input field values - check if the values are of the correct type
        // Sanitizing is used to ensure the data entered is not posing a threat to your server, i.e. the computer that will process the form information
        // Validation is used to ensure the data entered in a field is of the desired form, i.e. in the email field, the information entered is of email type, not just random numbers/characters
        */
        
        $clean_name = filter_var($raw_name, FILTER_SANITIZE_STRING); // check if fullname field only has string data ONLY
        $clean_email= filter_var($raw_email,FILTER_VALIDATE_EMAIL); // email is validated to check to ensure submitted/ entered email is of the correct form. 
        $clean_password = filter_var($raw_password, FILTER_SANITIZE_STRING);
        $clean_accept = filter_var($raw_accept, FILTER_SANITIZE_STRING);
        
        
        /* Now we want to send data to the database using PDO 
        
        
        //echo the result to check if we're actually getting the information from the form. 
        
        echo $clean_name;
        echo $clean_email;
        echo $clean_password;
        echo $clean_accept;
        

        
        // Now after checking that you get the values from the form, we're going to write the function, that will insert the values into the database
       
        //isset($_POST['thebuttomnamethatyouwishtocheckifitwaspressedornot']); isset is a function that checks the if the button on a form is pressed or not. In our case, we want to ensure the submit button was pressed and we will use this to send the data, after sanitization and validation, to the database using PDO
        
        */
        
            /* Now we have to make the connection to the database to prepare the query for the database. We don't need to to include the pdocon file again, because we already included it in the body <tbody> tag. The connection between the database and the PHP is being handled by the PHP Data Object (PDO), which means you only need to make the connection once, and this will allow you to prevent repeating your code. After instantiation of the PDO once in your file, it can be used anywhere in the file, inside a PHP tag. 
            
            Therefore, to push the form data to the database, we're going to use our instantiated $dbh to prepare a query for the database to check if its executable. If the result from the database is TRUE, we will send a PDOStatement object with binded parameters using the bindvalue function of the $db 
            */
            
            $db->query("INSERT INTO users(id, email, password, full_name, Spending_Amt) values(NULL, :email, :password, :fullname, :spending)");
            
            // call our bind functions 4 times to bind the values 
            $db->bindvalue(':email',$clean_email, PDO::PARAM_STR);
            $db->bindvalue(':password',$clean_password, PDO::PARAM_STR);
            $db->bindvalue(':fullname',$clean_name, PDO::PARAM_STR);
            $db->bindvalue(':spending',4000, PDO::PARAM_INT);
     
            /*
            Now we need to call our execute method in the PDO instantiated object   
            $db->execute(); 
            
            */
            
            // We call the execute method and check if it prepared query was successfully executed on the database.
            $run = $db->execute();  
            
            
            if($run)
            {
                echo "You have successfully Inserted your values.";
            }
            else{
                echo "Your values could not be inserted.";
            }
        
    }   
?>