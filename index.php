<!--
    This file is used for the JQUERY AJAX tutorial. 
       
    Implementation of JQuery Ajax  $.ajax() and $.post() methods      
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
 
 <br><br><br>
 
 
 <!-- 
 The AJAX script will get the results from the processajax.php file and store it in the HTML id defined as 'greetings, 
 
 Read the next line.
 
 -->
 
 <div id="greetings" class="well well-sm text-center"> </div> 

<!-- 
      id="nameofthediv" this is where you store information for this section. 
-->

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
  <h2>Registration Form</h2>
  <form method = "post" class="form-horizontal" id ="insertdataID" action="processajax2.php"> 
  
  
  <!-- 
  Form is the frontend method of getting data to be uploaded to the database.
  
  Everytime you press submit, the data entered in the form needs to be processed, in our case , we want the processajax.php to send the request to the php script that is running on the server using the JQUERY AJAX method called $.post(). 
  
  We also gave the form an HTML id = insertDataID, this will allow JQUERY AJAX methods to store results from sent by the respective php file they requested to process something on the server. 
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
        <button type="submit" class="btn btn-default" name="submit" value="submit" id="">Submit</button>
      </div>
    </div>
  </form>
</div>


<!--  How to use $.ajax({}) -->

<script>
    
    // We need to send a request to php file to process our requests - I've created a processajax.php as the file that will process the requests made by AJAX. 
    
    /*
    $(document).ready(function(){}); // This is always the first line in any Javascript. The purpose of this line is to tell Javascript, to wait till the ENTIRE document is ready/loaded before executing whatever is inside the curly braces of function(){}.
    */
    
    $(document).ready(function(){
        
        // Once the document is ready, Javascript will execute whatever follows this comment. 
        
        // Call the ajax method - we use this ajax method to return results from the php file processsajax.php to the HTML id = greetings. 
        
        /* 
        The take from this is:
            Use the $.ajax() method to send request to a php file, this php file will process the request on the database and return the results. We use ajax method $.ajax() to move the result from the php file to the index page's id=greetings and this will display the result in that div tag.
        
        */ 
            
        
        $.ajax({
            
            // inside the curly braces, we add the arguments of this function - www.w3schools.com
            
            /* success variable stores a function call, that takes an argument. 
            
            This argument is used as a storage variable to store the results of the respective php file that processed the ajax request.
            
            As always, inside the curly braces of this function, we write the function body. 
                Inside the curly braces, provided the request made by ajax to the respective php file was a success, we check if any error flags were set. If no error flags are set, we ask ajax to store the PHP result in an HTML id with name = 'greetings' - whichb 
            
            */
            
            url:        'processajax.php',
            type:       'POST',
            success:    function(holdresults){
                
                if(!holdresults.error){
                    
                    // If there were not errors in the result obtained from the respective php file, copy the results to the html id = 'greetings' 
                    $('#greetings'). html(holdresults); 
                    
                }
            }   
        });
      
    });
    
    
    
    
</script>


<!--  How to use $.post({}) -->

<script>
    // Make sure document is ready first
  $(document).ready(function(){
      
       // Write the function body now, the code below will be executed only when the document is ready. 

      /* The followng is how javascript knows which Form had been submitted - what I was confuses about. 
      
        The registration form has an HTML id that is used by the javascript to check if THAT form has been submitted. The HTML id corresponding to our Registration form is , recall = 'iinsertdataID'
       
       In Javascript, functions/methods decleration and definition is :
      
        functionname(function(){
            
            // This is the function body. 
        
        });
      
      
      */

      /*
      
            The following line of code, checks if the 'submit' button of the HTML ID = "insertdataID' has been pressed. 
                The code inside the submit function is only executed if and only if the submit button of the given FORM HTML ID is pressed. 
      
      
      */
      $('#insertdataID').submit(function(){
            
          /*
          'var url' is javascript syntax for creating new variables. 
          
          '$(this)' is to notify javascript that the following code is for something on the current page, i.e. the page where the javascript is being executed. 
          
          $(this).attr("htmlattributename"); the attr(argument) function is a javascript method used to refer to an HTML attribute. 
          
          The url of the php file that should process the information submitted to the form is stored the "action" attribute of the HTML file that has this javascript in it - that is what is meant by the following line: 
          
          */

          preventDefault(); // Javascript doesn't move to processajax2, i.e. it updates the form on the index.php page
          
          var url = $(this).attr("action"); // Collected our url 
          
          var data = $(this).serialize(); // Collect your data from the form, encode it and send it to the 'url' that will process it. 

          $.post(url, data, function(resetform){
              
              $('#insertdataID')[0].reset(); // this function clears the form fields, since we're preventing javascript from moving to the processajax2.php and forcing it to update the database in the background. 
              
          });
          
      });
      
  });    
    
</script>
</body>
</html>

