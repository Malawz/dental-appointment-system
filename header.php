<?php
session_start();
$is_login = false;
if (isset($_SESSION['userid'])) {
    $is_login = true;
} else {
    $is_login = false;
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
	<body>
		<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<a href="index.php">
					<img src="images/image2.png" width="40" height="40" class="logo">
					<p class="logotext">Dental Appointment System</p>
				</a>
				</div>
				<div class="col-sm"></div>
				<div class="col-sm">
					<?php if ($is_login){ ?>
						<a href="logout.php" class="log">Logout</a>
					<?php } else{ ?>
						<a href="login.php" class="log">Login</a>
						<a href="signup.php" class="log">Sign Up</a>
					<?php } ?>
				</div>

			</div>
		</div>
							<div class="link-holder">
			<div class="container">
				<div class="link">
<a href="dentistuser.php" class="sublink">Dentist</a>
<a href="clinicinfo.php" class="sublink">Clinic Information</a>
<a href="dentalcodesviewuser.php" class="sublink">Dental Codes</a>
<a href="appointement.php" class="sublink l5">Make Appointment</a>
<?php if ($is_login ){ ?>
<a href="viewappointment.php" class="sublink l4">View Appointment</a><br><br>
<a href="history.php" class="sublink">Followup History</a>
<?php } ?>
       	</div>
       		</div>
		</div>
	</div>