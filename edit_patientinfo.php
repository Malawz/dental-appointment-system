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
			<div id="content">
<h2>Edit patient details</h2>

<?php
		// After clicking the Edit link in the found_record.php page, the editing interface appears
		// The code looks for a valid user ID, either through GET or POST #1
		if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
		} 
		elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission
		$id = $_POST['id'];
		} 
		else { // If no valid ID, stop the script
		echo '<p class="error">This page has been accessed in error</p>';
		exit();
		}

require ('connect-mysql.php');
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		$errors = array();


		// Look for the dental codes
        if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter your first name';
		} else {
		$name = mysqli_real_escape_string($dbcon, trim($_POST['name']));
		}


		
		// Look for the descriptions
		if (empty($_POST['age'])) {
		$errors[] = 'You forgot to enter your age.';
		} else {
		$age = mysqli_real_escape_string($dbcon, trim($_POST['age']));
		}


		// Look for the descriptions
		if (empty($_POST['phone'])) {
		$errors[] = 'You forgot to enter the phone no.';
		} else {
		$phone = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
		}


       // Look for the descriptions
		if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter the email id.';
		} else {
		$email = mysqli_real_escape_string($dbcon, trim($_POST['email']));
		}


        // Look for the descriptions
		if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter the address.';
		} else {
		$address = mysqli_real_escape_string($dbcon, trim($_POST['address']));
		}

		if (empty($_POST['user_level'])) {
		$errors[] = 'You forgot to enter the user type.';
		} else {
		$user_level = mysqli_real_escape_string($dbcon, trim($_POST['user_level'])); 
		}



		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE signup SET name='$name', age='$age' , phone='$phone' ,email='$email' , address='$address' , user_level='$user_level' WHERE userid=$id LIMIT 1";
		$result = @mysqli_query ($dbcon, $q);
		if (mysqli_affected_rows($dbcon) == 1) { // If it ran OK
		// Echo a message if the edit was satisfactory
		echo '<h3>The user has been edited.</h3>';
		} else { // Echo a message if the query failed
		echo '<p class="error">The user could not be edited due to a system error. 
		We apologize for any inconvenience.</p>'; // Error message.
		echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		
		exit();
		} else   { // Display the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
        
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
		echo " - $msg<br>\n";
	    }
		echo '</p><p>Please try again.</p>';
		} // End of if (empty($errors))section
}        // End of the conditionals
         // Select the record 


$q = "SELECT userid,name,age,phone,email,address,user_level FROM signup WHERE userid=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="edit_patientinfo.php" method="post">
	<p><label class="label" for="name">Name:</label>
	<input class="fl-left" id="name" type="text" name="name" size="30" maxlength="30" 
	value="' . $row[1] . '"></p>
	
	<p><label class="label" for="age">Age:</label>
	<input class="fl-left" type="text" name="age" size="30" maxlength="50" 
	value="' . $row[2] . '"></p>
	<p><label class="label" for="phone">Phone:</label>
	<input class="fl-left" type="text" name="phone" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>
	<p><label class="label" for="email">Email:</label>
	<input class="fl-left" type="text" name="email" size="30" maxlength="50" 
	value="' . $row[4] . '"></p>
	<p><label class="label" for="address">Address:</label>
	<input class="fl-left" type="text" name="address" size="30" maxlength="50" 
	value="' . $row[5] . '"></p>
	<p><label class="label" for="user_level">User Type:</label>
	<input class="fl-left" type="text" name="user_level" size="30" maxlength="50" 
	value="' . $row[6] . '"></p>
	<p><input id="submit" type="submit" name="submit" value="Edit"></p>
	<br><input type="hidden" name="id" value="' . $id . '" /> 
	</form>';
} 
else { // The record could not be validated
	  echo '<p class="error">This page has been accessed in error</p>';
	 }
mysqli_close($dbcon);

?>
</div>
</div>
</div>
</body>
</html>