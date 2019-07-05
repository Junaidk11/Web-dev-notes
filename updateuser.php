<!--

        PHP Form Handling 
        
        PHP Form Handling is appended to the 'mysqlconwpdoclass.php file'
-->


<!-- 
     The puporse of this file is to pull data from a database and display it on a form. An application of this could be, when the user would like to update the information on the database, and to update, he would like to know the current data on the database.   
     
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
  <form method = "post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
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
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>


</body>
</html>

