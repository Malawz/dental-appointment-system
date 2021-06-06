<?php 
session_start();
if (isset($_SESSION['userid'])) { ?>
<?php include 'header.php' ?>

<?php
// The link to the database is moved to the top of the PHP code.
require ('connect-mysql.php'); // Connect to the db.
// This query INSERTs a record in the users table.
// Has the form been submitted?
 

 // remove past appointments
  $diff_query = "SELECT * FROM appointement";
  $diff_result = mysqli_query($dbcon, $diff_query); 
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
          if($d / 86400 < 0){
            $ins = "INSERT INTO archive_appointment (userid,code,dentist,regdate,regtime,status,appointment_id) VALUES (".$uid.",'".$code."','".$dentist."','".$date."','".$rtime."','".$status."',".$id.")";
            $res = @mysqli_query ($dbcon, $ins);
            $delete = "DELETE FROM appointement WHERE id = ".$id;
            @mysqli_query($dbcon, $delete);
          }
        }
}
// =====
      

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  $codes = trim($_POST['codes']);
  $dent = trim($_POST['dent']);
  $dates = trim($_POST['dates']);
  $time = trim($_POST['time']);

  $q = "INSERT INTO appointement (userid,code,dentist,regdate,regtime,status)
            VALUES ('".$_SESSION['userid']."', '$codes','$dent','$dates','$time','Not Confirmed')";
  $result = @mysqli_query ($dbcon, $q); // Run the query.

  if ($result){ // If it runs
    header ("location: viewappointment.php");
    exit();
  }else { // If it did not run
  // Message:
    echo '<h2>System Error</h2><p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
    echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
  } // End of if ($result)
  mysqli_close($dbcon); // Close the database connection.
  // Include the footer and quit the script:
    exit();
} 

// End of the main Submit conditional.
?>
  <link rel="stylesheet" type="text/css" href="appointement.css">
  <script src="assets/jquery-1.12.4.js"></script>
  <script src="assets/jquery-ui.js"></script>
<link href='assets/jquery-ui.css' rel="stylesheet">
<div class="container">
  <div class="content">
    <h2 class="page">Make Appointment</h2>
    <form action="appointement.php" method="post" class="form">


      <?php

      

      //mysql_connect("localhost", "root", "root") or die("Connection Failed");
      //mysql_select_db("dentalclinic")or die("Connection Failed");
      $servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dentalclinic";
//die();
      $conn = new mysqli($servername, $username, $password, $dbname);
      $query = "SELECT concat(code,'-',description) AS codes FROM dentalcode";
      //$query = "SELECT * FROM dentalcode";
      //$result = mysql_query($query);
      $result = $conn->query($query);
      //var_dump($result);
      //echo "slk;lk;lk;lk;lk;lk;l";
      //die();
      ?>

      <label for="codes">Dental Codes:<select name="codes" value="<?php if (isset($_POST['codes'])) echo $_POST['codes']; ?>" >
      <?php
      while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //printf($line["id"]);
      ?>
      <option> <?php echo $line['codes'];?> </option>
      <?php
      }
      ?>
      </select></label><br><br>


      
      <?php
      //mysql_connect("localhost", "admin", "admin") or die("Connection Failed");
      //mysql_select_db("dentalclinic")or die("Connection Failed");
      $query_dentist = "SELECT concat(did,'-',name) AS dent FROM dentist";
      //$result = mysql_query($query);
      $result_dentist = $conn->query($query_dentist);
      ?>

      <label for="dent">Select Dentist:<select id="selectDentist" name="dent" value="<?php if (isset($_POST['dent'])) echo $_POST['dent']; ?>" onChange="make_blankdate()">
      <?php
      while ($line_dentist = mysqli_fetch_array($result_dentist, MYSQLI_ASSOC)) {
      ?>
      <option> <?php echo $line_dentist['dent'];?> </option>
       
      <?php
      }
      ?>
      </select></label><br><br>




      <?php
      //mysql_connect("localhost", "admin", "admin") or die("Connection Failed");
      //mysql_select_db("dentalclinic")or die("Connection Failed");
      $query_adminreg = "SELECT regdate AS dates FROM adminreg";
      //$result = mysql_query($query);
      $result_adminreg = $conn->query($query_adminreg);
      ?>

      <label for="dates">Select Dates:
        
     </label><br>
      <input name="dates" type="text" id="datepicker" onchange="showUser(this.value)">
      <br>
      <br>
      <div id="txtHint"></div>
      
      <input id="submit" type="submit" name="submit" value="Fix Appointment">

</form>
<span style="display: none" class="btn click">Click</span>
  </div>
</div>
    
<style>
  .ui-datepicker-trigger{
    border: 0px;
    background: none;
    margin: 0 0 0 5px;
    position: relative;
    top:-4px;
  }
</style>
<script>
  $( function() {
    var dateToday = new Date(); 
    $( "#datepicker" ).datepicker({
      numberOfMonths: 2,
      showOn: "button",
      buttonImage: "images/calender.png",
      showButtonPanel: true,
      minDate: dateToday
    });

    $( "#anim" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  } );

  // ======
function showUser(str) {
  var dstr = $('#selectDentist').val();
  //dstr = dstr.replace(" ", "_")
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","availability_appointment.php?q="+str+"&d="+dstr,true);
        xmlhttp.send();

    }
}


function make_blankdate(){
  $('#datepicker').val('');
  }
  </script>
}
<?php include 'footer.php' ?>
<?php }else{ ?>
<?php header("Location: login.php"); ?>
<?php } ?>
