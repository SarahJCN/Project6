<?php
	session_start();
	$user = $_SESSION['user'];
	include "config.php";
	$db1 = mysqli_connect($DBSERVER,$DBUSER,$DBPASSWORD,$DBNAME);
	$date = date('Y-m-d');
	$qry = "SELECT * FROM chat where userId = '$user' or userId = 'admin' and dated = '$date'";
	$data = mysqli_query($db1,$qry) or die(mysqli_query($db1));
	// print_r($data);
	while($data1 = mysqli_fetch_array($data)){
		if($data1['userId'] == 'admin')
			echo "<b>Admin : </b>".$data1["text"]."<br>";
		else
			echo "<b>You : </b>".$data1["text"]."<br>";
	}
?>