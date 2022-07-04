<?php 
	$fno = $_POST["fno"];
	$flag = $_POST['flag'];
	//echo "(".$fno." ".$flag.")";
	if($flag == "up" && $fno < 3)
		$fno++;
	if($flag == "down" && $fno > 1){
		$fno--;
	}
	
	$db1 = mysqli_connect("localhost","ese","ese","elevator");
	$query = "UPDATE elevatorNetwork SET currentFloor = '$fno' WHERE nodeID = '1'";
	mysqli_query($db1, $query) or die(mysqli_error($db1));

		$qry = "SELECT currentFloor FROM elevatorNetwork where nodeID = 1";
		$data = mysqli_query($db1, $qry) or die(mysqli_error($db1));
		$row = mysqli_fetch_array($data);
		echo $row["currentFloor"];
 ?>