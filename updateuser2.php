<!--

        PHP Form Handling 
        
        PHP Form Handling is appended to the 'mysqlconwpdoclass.php file'
-->


<!-- 
     The puporse of this file is to pull data from a database and display it on a form AND post the updated information to the database. 
     
       An application of this could be, when the user would like to update the information on the database, and to update, he would like to know the current data on the database.   
     
     When the user clicks on the Edit button in the index.php file, the user is directed to this page. The script in this page should fetch the selected user's information and display it on the form for the user to edit.  
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

<!-- Now we will write a PHP tag, that will process the form -->

<?php
    
    if (isset($_GET['user_id'])) // the Edit button, when pressed on the index.php file, will redirect to this file AND it will store the selected user's id a variable created on index.php $user_id and we use the $_GET super global to get that value from the address bar - not really clear, but get the idea. 
    {
        $user_id = $_GET['user_id']; // We use the GET super global variable to store the SELECTED users id number so that we can use it for preparing our query and binding this value to the variable that will be sent to the database in a query. This is an application of the $_GET super global variable. The GET method submits the form values in the address bar, not a secure method but submitting the id numbers is not a security threat because its just an id, as no significant information.   
    }
    
    include ('pdocon.php');// Include the connection file, which allow you to create the PDO class, the PDO class will store the connection between the PHP and the database 
    $db = new Pdocon;  // Instantiate a connection between your PHP and database. 
    
      // Now we have to make the connection to the database to prepare the query for the database. We don't need to to include the pdocon file again, because we already included it in the body <tbody> tag. The connection between the database and the PHP is being handled by the PHP Data Object (PDO), which means you only need to make the connection once, and this will allow you to prevent repeating your code. After instantiation of the PDO once in your file, it can be used anywhere in the file, inside a PHP tag. 
            
        // Therefore, to push the form data to the database, we're going to use our instantiated $dbh to prepare a query for the database to check if its executable. If the result from the database is TRUE, we will send a PDOStatement object with binded parameters using the bindvalue function of the $db

        $db->query('SELECT * FROM users WHERE id= :userid'); // We prepare our query to ask database to give us the userid that was selected by the user


        // call our bind functions to bind the ':userid' to the $user_id, which stores the selected user to be edited. $user_id stores the userid of the selected user which was taken from the address bar using the GET request. 
        $db->bindvalue(':userid', $user_id, PDO::PARAM_INT);


        // We call the fetchMultiple() to get all the users available and store them in a variable.
        $results = $db->fetchMultiple();  
        
        // Next, we go to the HTML page and open out PHP tag to display the fetched data inthe HTML form. 
?>


<!-- 
        The form is below the PHP script  because we want to use the user submitted Form, process it using the PHP script above and display the result out in a form as below.
        
-->

<!-- The form below was copied from W3schools.com as a template and 
     we added some extra features as needed 
-->

<div class="container">
  <h2>Edit User</h2>
  <form method = "POST" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>"> 
  
  <!-- 
  Form is the frontend method of getting data to be uploaded to the database
  
  Everytime you press submit, the data entered in the form needs to be processed, in our case , we want the script to process it. The htmlspecialchars() function is the most secure method to submit the form, prevents hackers from infiltrating/hacking you. 
  
  
  
  The argument of htmlspecialchars($_SERVER["FILENAMETHATPROCESSTHESUBMITTEDFORM"]; right now the same file handles the submitted form - check end of this file. But if the form is handled in a different PHP file, then you include that particular file's name inside $_SERVER['filename.php']
  
  
  the name="" is defined to store the entered information in the form, so that we are able to read what was submitted when processing the form. 
  -->
  
   <div class="form-group">
     
     <?php foreach($results as $result): ?> 
      <!-- The for loop is used to display the results in the respective location on the HTML page. The for loop is closed at the end. -->

      <label class="control-label col-sm-2" for="Fullname ">Fullname:</label>
      <div class="col-sm-10">
        <input type="fullname" class="form-control" id="fullname" placeholder="Enter Fullname" name="fullname" value="<?php echo $result['full_name']?>" >
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $result['email']?>">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" value="<?php echo $result['password']?>">
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
    <?php endforeach ; ?>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="update_user">Submit</button> <!-- Change the Submit button name to Update -->
      </div>
    </div>
  </form>
</div>

<!-- 
    The top of the page: Fetch the data of the selected id, that the user wishes to update.
    The middle of the page:  Display the fetched result in a FORM using HTML. 
        The user can update the information as he wishes, i.e. change the username, email or passeword and then press Submit. 
        
    The script below: 
        The script below will prepare an UPDATE query for the database to execute. 
-->
        
<?php 

 /* 
    Write your Form processing PHP code here. 
    
    The code below is the same as the code on the index.php file for updating. 
    
*/
 
    
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
        
        if(isset($_POST['update_user']))
        {
            /*
            // Always Check if your submit button is working by echoing. 
            
            echo "Submit button is working";
            */
            
            
            // Now we have to make the connection to the database to prepare the query for the database. We don't need to to include the pdocon file again, because we already included it in the body <tbody> tag. The connection between the database and the PHP is being handled by the PHP Data Object (PDO), which means you only need to make the connection once, and this will allow you to prevent repeating your code. After instantiation of the PDO once in your file, it can be used anywhere in the file, inside a PHP tag. 
            
            // Therefore, to push the form data to the database, we're going to use our instantiated $dbh to prepare a query for the database to check if its executable. If the result from the database is TRUE, we will send a PDOStatement object with binded parameters using the bindvalue function of the $db
            
            $db->query("UPDATE users SET email=:email, password=:password, full_name=:fullname WHERE id=:userid");
        
            
            // call our bind functions 4 times to bind the values 
            $db->bindvalue(':email',$clean_email, PDO::PARAM_STR);
            $db->bindvalue(':password',$clean_password, PDO::PARAM_STR);
            $db->bindvalue(':fullname',$clean_name, PDO::PARAM_STR);
            $db->bindvalue(':userid', $user_id, PDO::PARAM_INT); // bind the user_id, so the database knows which user to update. 
            
            // We call the execute method and check if it prepared query was successfully executed on the database.
            $run = $db->execute();  
            
            
            if($run)
            {
                header("Location: index.php");
            }
        }
    
    }      
    
?>

</body>
</html>

