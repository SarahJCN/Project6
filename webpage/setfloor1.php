<?php 
	$fno = $_POST["fno"];
	$flag = $_POST['flag'];
	// echo "(".$fno." ".$flag.")";
	include "config.php";
	$db1 = mysqli_connect("$DBSERVER","$DBUSER","$DBPASSWORD","$DBNAME");
	$query = "UPDATE elevatorNetwork SET currentFloor = '$fno', otherInfo = '$flag' WHERE nodeID = '1'";
	mysqli_query($db1, $query) or die(mysqli_error($db1));

		$qry = "SELECT currentFloor FROM elevatorNetwork where nodeID = 1";
		$data = mysqli_query($db1, $qry) or die(mysqli_error($db1));
		$row = mysqli_fetch_array($data);
		echo $row["currentFloor"];
 ?>