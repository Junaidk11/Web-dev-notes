<!--- 
This file using the PDO Class to handle the connections to the database. The mysqltablemanipulation.php, uses the procedural functions to the handle database connections 
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
      </tr>
    </thead>
    <tbody>
     <!-- Establish connection with the server under this tag -->
    <?php
        include('pdocon.php'); // Include the connection php file
        
        $db = new Pdocon; // Instantiate your connection to the database as a PDO class object
       
        /*
        // next we write the select query to grab the users table from the databas
        //$db->query("SELECT * FROM users");  

        // Fetch the query result using the fetchMultiple method of Pdocon object instantiated as a PDO class
        $results = $db->fetchMultiple(); 
        
        foreach($results as $result): ?>     
      <tr>
       <!-- Display the query result in each respective tag by employing the associative array property -->
        <td><?php echo $result['full_name'] ?></td>
        <td><?php echo $result['password'] ?></td>
        <td><?php echo $result['email'] ?></td>
      </tr>
     <?php endforeach ; ?> */
        
        // Next, we try:
        // Insert into table 
        $db->query("INSERT INTO users (id,email,password, full_name, Spending_Amt) VALUES(NULL, :email, :password, :fullname, :spendingamt)"); // ':email, :password, :fullname, :spendingamt'  this is just creating the binding values. 
        
        // Next we need to bind our inputs 
        // Four inputs, therefore 4 binding calls 
        $db->bindvalue(':email', 'jjkhan@sfu.ca', PDO::PARAM_STR);
        $db->bindvalue(':password', 'sjdhfdfnchf', PDO::PARAM_STR);
        $db->bindvalue(':fullname', 'Junaid Khan', PDO::PARAM_STR);
        $db->bindvalue(':spendingamt', 50, PDO::PARAM_INT);
     
        $db->execute();
        
        
        $db->confirm_result(); // check if last query was executed ?>
      <tr>
       <!-- Display the query result in each respective tag by employing the associative array property -->
        <td><?php //echo $result['full_name'] ?></td>
        <td><?php //echo $result['password'] ?></td>
        <td><?php //echo $result['email'] ?></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
