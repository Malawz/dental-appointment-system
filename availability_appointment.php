<?php 
//include 'header.php' 
require ('connect-mysql.php');
$date = $_GET['q'];
$dentist = $_GET['d'];
$sql="SELECT * FROM appointement WHERE regdate = '".$date."' AND dentist = '".$dentist."'";
$result = mysqli_query($dbcon,$sql);
?>
<lable>Select time:</lable>
<select name="time" id="available_time">
        <?php $time_all = ['9 AM','10 AM','11 AM','12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM']; 
while($row = mysqli_fetch_array($result)) {
	$row_all[] = $row['regtime']; 
}

	foreach ($time_all as $time_item) {
		if (in_array($time_item, $row_all)) {
			echo "<option disabled='disabled' value='".$time_item."'>".$time_item."(booked)</option>";
		}else{
			echo "<option value='".$time_item."'>".$time_item."</option>";
		}
    }
    ?>
      </select>


<ul class="time_booked">
<?php
while($row = mysqli_fetch_array($result)) {
echo '<li>'.$row['regtime'].'</li>';
  }
?>
</ul>
