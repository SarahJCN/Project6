<?php 
	include 'config.php';
	$s1 = 0;
	$s2 = 0;
	$s3 = 0;
	$con = mysqli_connect($DBSERVER,$DBUSER,$DBPASSWORD,$DBNAME);
	$id = $_POST['user'];
	$q = "SELECT * FROM counter where userId = '$id'";
	$rq = mysqli_query($con, $q);
	while($row = mysqli_fetch_array($rq)){
		//echo $row['floorNum'];
		if($row["floorNum"] == 1)
			$s1 += $row["count"];
		if($row["floorNum"] == 2)
			$s2 += $row["count"];
		if($row["floorNum"] == 3)
			$s3 += $row["count"];
	}
	//echo $s1;
	$arr = [$s1,$s2,$s3];
	echo json_encode($arr);
?>