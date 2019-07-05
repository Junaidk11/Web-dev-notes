<?php
/*

include('dbconnection.php'); // Make the connection to your database from here. Note: Need to put the include file in through commas. 

// Now we're going to look at how to add values to your database through code. 
// You can find the syntax from www.w3schools.com under php syntax for mySQL procedures

$query ="INSERT INTO users(id, email, password, full_name, Spending_Amt) value('NULL','hellomrs.tmk@hotmail.com','tofvgoy2345','Jehcnf lhan','1345')"; // you create a variable that stores the query that you wish to send to the database using mysqli_query($connection, $query); // $connection is the variable from the included file, this is used to open that connection to your database, and the second parameter is used to send the query that you wish the mysql database to perform 

//mysqli_query($connection, $query); 

// you can store the query connection in a variable to check if the query was successful

$run_query = mysqli_query($connection, $query);

if($run_query)//check if query was successful
{
    echo"Query was successfull.";
}
else
{
    echo"Query failed.";
}

mysqli_close($connection); // ALWAYS close your connection to the database, after the query is processed. 

*/

//---------------------------------------------------

/*

// Next we look at how to update information that exist in the database using the UPDATE function
// Note: the connection was closed after the last query. Therefore, we need to make the connection again, by calling include again
include('dbconnection.php');

$update_query="UPDATE users SET full_name ='Abid Khan' WHERE id=7";

// Make the connection to the database and pass your query
$run_query = mysqli_query($connection,$update_query);

if($run_query) // check if query was successfull
    echo"Update was successful.";
else
    echo"Update was unsuccessful.";
    
mysqli_close($connection);

*/

//--------------------------------------------------------

/*

// Next we look at how we can delete or select information from the database. 
// For this we use the select query, you can find the syntax from www.w3schools.com. 

// open the connection to the database

include ('dbconnection.php');

$query_select = "SELECT * FROM users"; // Selecting data 'users' database

// run the query to the database using mysqli_query('connection', 'the query');

$run_query = mysqli_query($connection, $query_select);

// To return the data from a select query, use the mysqli_fetch_array function, this function returns the result of the query as an array, you get to choose if you want the result to be stored in an associative or index array.

// We're not looping through the data, thata why we're onlyh
// getting the single row data, 
// if you loop through, you can get all the data from the users database.

// Returning result and storing in as Numerated array

$result = mysqli_fetch_array($run_query, MYSQLI_NUM); // return result row as numerated Array. 

if($result)
{
    echo $result[0] ; // returns element [1,1] of users database
    echo $result[4]; // returns element [1,4] of users database
} 


// Returning result and storing in as an associated array
// which allows for echoing the array results using the 
// column names


$result = mysqli_fetch_array($run_query, MYSQLI_ASSOC); // return result row as numerated Array. 

if($result)
{
    echo $result['id'] ; // returns element [1,1] of users database
    echo $result['Spending_Amt'];; // returns element [1,4] of users database
}
// close the connection
mysqli_close($connection);

*/

//--------------------------------------------------------

/*

// Next we look at how we can delete from the database. 
// For this we use the select query, you can find the syntax from www.w3schools.com. 

// open the connection to the database

include ('dbconnection.php');

// write the delete query to delete information from a table in the database.


$delete_query = "DELETE FROM users"; // this query will delete all the users in the users table on the server.


// But we want to delete a duplicate user from the server.
// We use delete users table where the id is "desired id"


$delete_query = "DELETE FROM users WHERE id=31";

// send the query to the server by using the, mysqli_query(connection, query);

$run_query = mysqli_query($connection, $delete_query);

if($run_query) // if the query was successfully executed, i.e. user deleted
    echo "User deleted successfully.";
else 
    echo "Delete query unsuccessfull.";

mysqli_close($connection);

*/

//-----------------------------------------------------------

/*
//Next we look at looping through a database and displaying the values stored in a database. 

// Now we try to loop through a database to display the values. 

// first make the connection

include('dbconnection.php');

// Lets run a selecting data query from our database table 'users

$select_query = "SELECT * FROM users"; // Selects the users table from the database

// run the query to the server by passing the connection and query to mysqli_query(connection, myquery);

$run_query = mysqli_query($connection, $select_query);

// Get the results from the query, i.e. get the users table from the server, and save it in an array of your choice. 
// Array type could be associative or index , we will go for associative, this will allow to use keynames to access the array values. 

$results = mysqli_fetch_array($run_query, MYSQLI_ASSOC);

// next we output the desired information from the desired column, instead of echoing only the first row - use while loop

while($results=mysqli_fetch_assoc($run_query)) // the function here is the name as $results = mysqli_fetch_array($run_query, MYSQLI_ASSOC)
{
    // output the desired column by using the column name
    echo $results['email']; // this will ouptut all the emails in the users table that was fetched from the server
};

// close the connection to the server. 

mysqli_close($connection);

*/

//----------------------------------------------------------

/*
// Next, we look at a function, that can be used to count the number of rows of data returned from a certain query.
// An example would be the select_Query above, you could be interested in knowing how maany rows were returned by the query
// We use the function: 
//$function_returned = mysqli_num_rows(the_query);

// Test it

// make the connection to the server

include('dbconnection.php');

// write the select_query 
$select_query = "SELECT * FROM users"; // this returns the users table from the server

// send the query to the server
$run_query = mysqli_query($connection, $select_query);

// find the number of rows returned by the server 

$returned_results = mysqli_num_rows($run_query);

// display the results

echo $returned_results; 

// close the connection

mysqli_close($connection);

// The mysqli_num_rows(query); is useful when you're checking login information against the database users table to check if the user exists in the database or not. 
// the idea is to check the database table that stores login information, and compare with the form data, if a row matching the information sent is found, the function mysqli_num_rows should be '1' and this will give access to that user, or if returned value is 0, then you can deny access to the user.  

*/
?>



<?php 
    //The HTML code below is creates a table and we're interested in showing how to use PHP code with HTML. Namely, we're interested in showing how to run HTML and PHP code hand-in-hand. We're going to establish a connection connection to the database and run a query to the database and display the returned result of the query in an HTMl created table for display purposes. 
    
    //Note: To use PHP code in HTML, you need to enclose PHP code in a PHP tag, always. 


  //The HTML code below is taken from Bootstrap table tutorial offered at www.w3schools.com
   
  //We're going to establish the connection to the database below the closing of <theader> tag, which is the table header tag, 
  //we do this by opening a PHP tag and including the dbconnection.php file, 
  //next we will run a select query to grab the users table from the database and then we're going to display the result in the respective HTML table data tag i.e. <td> by employing a while loop and opening PHP tag and using the echo command with the users table column name. 
?>
      
  

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
      </tr>
    </thead>
    <tbody>
     <!-- Establish connection with the server under this tag -->
    <?php
        include('dbconnection.php'); // Include the connection php file
        
        // next we write the select query to grab the users table from the databas
        $select_query = "SELECT * FROM users";
        
        // Send the query to the server using the mysqli_query(connection, myquery);
        $run_query=mysqli_query($connection,$select_query);
        
        // Now we want the result from the query to be stored in an associative array, so that we can display the results at the right <td> tag. 
        $results = mysqli_fetch_array($run_query, MYSQLI_ASSOC); // this will function will store the returned result of select_query in an associative array form. 
        
        // next, we run the while loop to access the array results.
        while($results=mysqli_fetch_array($run_query, MYSQLI_ASSOC)){
            // next, in order to display the results at the right location, we need to open php tag where the HTML tag writes information. In order to open tag in <td>, we need to close the php tag now and open it where we want ot display the result of the query.
     ?>       
      <tr>
       <!-- Display the query result in each respective tag by employing the associative array property -->
        <td><?php echo $results['full_name'] ?></td>
        <td><?php echo $results['password'] ?></td>
        <td><?php echo $results['email'] ?></td>
      </tr>
     <!-- We still need to close the php tag that  running the while loop to access the query results, to display in the HTML tag. -->
     <?php } ?> <!-- We close the while loop here -->
     
    </tbody>
  </table>
</div>

</body>
</html>

