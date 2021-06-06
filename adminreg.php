<!doctype html>
<html lang=en>
<head>
<title>View dental codes</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="admin.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="admin-wrapper">
		<?php include 'admin-sidebar.php' ?>
		<div class="contentbar">
			<a href="index.html" class="logout">Logout</a>


<?php
// This script performs an INSERT query that adds a record to the users table.
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

 $dates = trim($_POST['dates']);

 require ('connect-mysql.php'); // Connect to the database. 

 // Make the query 
 
 $q = "INSERT INTO adminreg (regdate) VALUES ('$dates')"; 

 $result = @mysqli_query ($dbcon, $q); // Run the query. 

 if ($result) { // If it ran OK. 
header ("location: admin.php");
 

 exit(); 
//End of SUCCESSFUL SECTION
 }

 else {                             // If the form handler or database table contained errors 
                                   // Display any error message
	 echo '<h2 class="error">System Error</h2>
	 <p class="error">You could not be registered due to a system error. We apologize for any 
	 inconvenience.</p>';

      } // End of if clause ($result)

mysqli_close($dbcon); // Close the database connection.

exit();
 

} // End of the main Submit conditional.
?>

<div id="content">
<h2 class="title">Insert Appointment Dates</h2> 
<!--display the form on the screen-->
<form action="adminreg.php" method="post" class="form">

<p><label class="label" for="dates">Date</label>
<input  type="text" name="dates" size="30" maxlength="30" 
value="<?php if (isset($_POST['dates'])) echo $_POST['dates']; ?>"></p>
<p><em>Format:21 December,2015</em></p>


<p><input id="submit" type="submit" name="submit" value="Enter"></p>
</form><!-- End of the page content. -->
</p>

</div>
</div></div>

</body>
</html>