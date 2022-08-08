<?php
	if($_POST['chat']) { session_start();
		$sms = $_POST['chat'];
		$user = $_POST["user"];
		include "config.php";
		$db1 = new PDO('mysql:host='.$DBSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');
		$qry = "INSERT INTO chat values('','$user','$sms',now())";
		$run = $db1->query($qry) or die($db1->mysqli_error());
		if($run){
			echo "Message Sent";
		}
	}

?>