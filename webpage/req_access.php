<?php
	$submitted = !empty($_POST);
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$email = $_POST['email'];
		$url = $_POST['url'];
		$dob = $_POST['birthday'];
		if(isset($_POST['fac_or_student']))
			$fac = $_POST['fac_or_student'];
		else
			$fac = "";
		if(isset($_POST['involvement']))
			$inv = $_POST['involvement'];
		else
			$inv = "";
		$file = $_POST['file_uploaded'];
		$com = $_POST['comments'];
		$op = $_POST['projects_class'];
		$pass = $_POST['pass'];
	try 
	{
	$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');
		$query = "INSERT INTO user (fname,lname,email,website,dob,request,role,opinion,files,comments,password) values('$fname','$lname','$email','$url','$dob','$fac','$inv','$op','$file','$com','$pass')";
		if($db1->exec($query)) {
			header('Location:login.html');
		}
		else {
			echo "dd";
		}	
	}
	catch(PDOException $e) {
		echo $db1." ".$e->message();
	}
?>