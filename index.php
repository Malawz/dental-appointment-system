<?php
session_start();
if (isset($_SESSION['userid'])) { 
header("Location: appointement.php"); 
}else{
header("Location: login.php"); 	
}
 ?>
		