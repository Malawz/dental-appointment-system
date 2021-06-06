<?php include 'header.php' ?>

<?php
// The link to the database is moved to the top of the PHP code.
require ('connect-mysql.php'); // Connect to the db.
// This query INSERTs a record in the users table.
// Has the form been submitted?
 

      



// End of the main Submit conditional.
?>
  <link rel="stylesheet" type="text/css" href="appointement.css">
  <script src="assets/jquery-1.12.4.js"></script>
  <script src="assets/jquery-ui.js"></script>
<link href='assets/jquery-ui.css' rel="stylesheet">
<div class="container">
  <div class="content">
    <h2 class="page">Followup history</h2>
    <hr>
<?php
   $userid = $_SESSION["userid"];
   $user_detail_query = "SELECT * FROM signup WHERE userid = $userid";
	$user_detail_result = mysqli_query($dbcon, $user_detail_query); 
	if ($user_detail_result){ 
     while($drow = mysqli_fetch_array($user_detail_result, MYSQLI_ASSOC))
        {
        	$name = $drow['name'];
        	$phone = $drow['phone'];
        	$address = $drow['address'];
        	$email = $drow['email'];
        	$registration_date = $drow['registration_date'];
        }
    }
    ?>
    <strong><?php echo $name;?></strong>
<br><?php echo "Address: ".$address;?>
<br><?php echo "Email: ".$email;?>
<br><?php echo "Reg date:".$registration_date;?>
</p>
    <?php
  $diff_query = "SELECT * FROM archive_appointment WHERE userid = $userid ORDER BY regdate ASC";
  $diff_result = mysqli_query($dbcon, $diff_query); 
  ?>
  <table class='table'>
  	<thead>
  		<tr>
  			<th>Dentist</th>
  			<th>Dental code</th>
  			<th>Date</th>
  			<th>Time</th>
  			<th>Status</th>
  		</tr>
  	</thead>
  	<?php
  if ($diff_result){ 
     while($drow = mysqli_fetch_array($diff_result, MYSQLI_ASSOC))
        {
          //$time = strtotime('04/09/2019');
          $today = strtotime(date("m/d/Y"));
          $time1 = strtotime($drow['regdate']);
          $id = $drow['id'];
          $uid = $drow['userid'];
          $code = $drow['code'];
          $dentist = $drow['dentist'];
          $date = $drow['regdate'];
          $rtime = $drow['regtime'];
          $status = $drow['status'];
          $d = $time1 - $today ;
echo "<tr><td>".$dentist."</td><td>".$code."</td><td>".$date."</td><td>".$rtime."</td><td>".$status."</td></tr>";
        }
}
echo "</table>";
?>
  </div>
</div>
    
<?php include 'footer.php' ?>