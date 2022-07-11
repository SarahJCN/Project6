<?php
	$submitted = !empty($_POST);
	include "config.php";
	$db1 = new PDO('mysql:host='.$BDSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');
	try { 
		$email = $_POST['username'];
		$pass = $_POST['password'];
	
		$query = "SELECT * from user where email = '$email' and password = '$pass'";
		$res = $db1->query($query);
		if($res->rowCount() > 0)
		{
			session_start();
			$_SESSION['user'] = "yes";
			header('Location:index.php');
		}else{
			// echo "<script>alert('')</script>";
			header("Location:login.html?msg=Wrong email or password");
		}	
	}catch(PDOException $e){
		echo $db1." ".$e->message();
	}
?>