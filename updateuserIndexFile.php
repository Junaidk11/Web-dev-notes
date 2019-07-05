<!--

        PHP Form Handling 
        
        PHP Form Handling is appended to the 'mysqlconwpdoclass.php file'
        
        -----------------------------------------
        
        Updated: 
        
        The table displayed in this file, was updated to include a extra column with an edit-button. This button, when pressed will redirect the user to the 'updateuser.php' file. 
        
        
        This is also the index.php file for when you wish to update user using your PDO class
        
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Procedural Connection - Using PHP and MySQL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Database Users</h2>          
  <table class="table table-bordered table table-hover">
    <thead>
     
    
      <tr>
        <th>FullName</th>
        <th>Password</th>
        <th>Email</th>
        <th>Edit User</th> <!-- This is the added new column for the Edit User button.-->
      </tr>
    </thead>
    <tbody>
     <!-- Establish connection with the server under this tag -->
    <?php
        include('pdocon.php'); // Include the connection php file
        
        $db = new Pdocon; // Instantiate your connection to the database as a PDO class object
       
        
        // next we write the select query to grab the users table from the databas
        $db->query("SELECT * FROM users");  

        // Fetch the query result using the fetchMultiple method of Pdocon object instantiated as a PDO class
        $results = $db->fetchMultiple(); 
        
        foreach($results as $result): ?>     
      <tr>
       <!-- Display the query result in each respective tag by employing the associative array property -->
        <td><?php echo $result['full_name'] ?></td>
        <td><?php echo $result['password'] ?></td>
        <td><?php echo $result['email'] ?></td>
        <td><a class="btn btn-primary" href="updateuser2.php?user_id=<?php echo $result['id']?>"> Edit</a> </td> <!-- This statement basically tells the page that when I click on the 'Edit'  button in the Edit User Column of my table, take me to 'updateuser.php page and in the address bar, display the user's id.
          
           The class="btn btn-primary" makes your Edit button stylish --> 
      </tr>
         <?php endforeach ; ?>    
    </tbody>
  </table>
</div>

<!-- The form below was copied from W3schools.com as a template and 
     we added some extra features as needed 
-->

<div class="container">
  <h2>Form</h2>
  <form method = "post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
  <!-- 
  Form is the frontend method of getting data to be uploaded to the database
  
  Everytime you press submit, the data entered in the form needs to be processed, in our case , we want the script to process it. The htmlspecialchars() function is the most secure method to submit the form, prevents hackers from infiltrating/hacking you. 
  
  -->
  
  <!--
  The argument of htmlspecialchars($_SERVER["FILENAMETHATPROCESSTHESUBMITTEDFORM"]; right now the same file handles the submitted form - check end of this file. But if the form is handled in a different PHP file, then you include that particular file's name inside $_SERVER['filename.php']
  
  
  the name="" is defined to store the entered information in the form, so that we are able to read what was submitted when processing the form. 
   -->
  
   <div class="form-group">
      <label class="control-label col-sm-2" for="Fullname ">Fullname:</label>
      <div class="col-sm-10">
        <input type="fullname" class="form-control" id="fullname" placeholder="Enter Fullname" name="fullname">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="accept" value="Accept"> Accept</label>
          <!-- The value="" is what is assigned to the particular input. I.e. if the 'checkbox input' is clicked, this will assign the accept "name" the value of "Accept" --> 
        </div>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>

<!-- Now we will write a PHP tag, that will process the form -->

<?php
    
    /* Write your Form processing PHP code here */
    
    if($_SERVER["REQUEST_METHOD"]=="POST") // if the form submission method is POST
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
        
        // Validate and Sanitize the input field values - check if the values are of the correct type
        // Sanitizing is used to ensure the data entered is not posing a threat to your server, i.e. the computer that will process the form information
        // Validation is used to ensure the data entered in a field is of the desired form, i.e. in the email field, the information entered is of email type, not just random numbers/characters
        
        $clean_name = filter_var($raw_name, FILTER_SANITIZE_STRING); // check if fullname field only has string data ONLY
        $clean_email= filter_var($raw_email,FILTER_VALIDATE_EMAIL); // email is validated to check to ensure submitted/ entered email is of the correct form. 
        $clean_password = filter_var($raw_password, FILTER_SANITIZE_STRING);
        $clean_accept = filter_var($raw_accept, FILTER_SANITIZE_STRING);
        
        
        // Now we want to send data to the database using PDO 
        
        /*
        //echo the result to check if we're actually getting the information from the form. 
        
        echo $clean_name;
        echo $clean_email;
        echo $clean_password;
        echo $clean_accept;
        
        */
        
        // Now after checking that you get the values from the form, we're going to write the function, that will insert the values into the database
       
        //isset($_POST['thebuttomnamethatyouwishtocheckifitwaspressedornot']); isset is a function that checks the if the button on a form is pressed or not. In our case, we want to ensure the submit button was pressed and we will use this to send the data, after sanitization and validation, to the database using PDO
        
        if(isset($_POST['submit']))
        {
            // Now we have to make the connection to the database to prepare the query for the database. We don't need to to include the pdocon file again, because we already included it in the body <tbody> tag. The connection between the database and the PHP is being handled by the PHP Data Object (PDO), which means you only need to make the connection once, and this will allow you to prevent repeating your code. After instantiation of the PDO once in your file, it can be used anywhere in the file, inside a PHP tag. 
            
            // Therefore, to push the form data to the database, we're going to use our instantiated $dbh to prepare a query for the database to check if its executable. If the result from the database is TRUE, we will send a PDOStatement object with binded parameters using the bindvalue function of the $db
            
            $db->query("INSERT INTO users(id, email, password, full_name, Spending_Amt) values(NULL, :email, :password, :fullname, :spending)");
            
            // call our bind functions 4 times to bind the values 
            $db->bindvalue(':email',$clean_email, PDO::PARAM_STR);
            $db->bindvalue(':password',$clean_password, PDO::PARAM_STR);
            $db->bindvalue(':fullname',$clean_name, PDO::PARAM_STR);
            $db->bindvalue(':spending',4000, PDO::PARAM_INT);
     
            // Now we need to call our execute method in the PDO instantiated object   
            $db->execute();  
            /*
            // We call the execute method and check if it prepared query was successfully executed on the database.
            $run = $db->execute();  
            
            
            if($run)
            {
                echo "Database was successfully updated";
            }
            else{
                echo "Form values not passed to the Database.";
            }
            */
        }
    
    }
    
    
?>

</body>
</html>

