<?php
session_start(); 

$_SESSION['userid']=$use;
?><!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-4.3.1-dist/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<img src="images/image2.png" width="40" height="40" class="logo">
					<p class="logotext">Dental Appointment System</p>
				</div>
				<div class="col-sm"></div>
				<div class="col-sm">
			<a href="index.html" class="log">Logout</a>
			<?php
print_r($_SESSION);
?>
				</div>

			</div>
		</div>
	</div>

	<div class="heroimg"></div>
	<div class="link-holder">
	<div class="container">
	<div class="link">
	<a href="dentistuser.php" class="sublink l1">Dentist</a><br><br>
	<a href="dentalcodesviewuser.php" class="sublink l2">Dental codes</a><br><br>
	<a href="clinicinfo.php" class="sublink l3">Clinic Information</a><br><br>
	<a href="viewappointment.php" class="sublink l4">View Appointment</a><br><br>
	<a href="appointement.php" class="sublink l5">Make Appointment</a>
	</div>
</div>
</div>
</body>
</html>
