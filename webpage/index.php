<?php
	function update_elevatorNetwork(int $node_ID, int $new_floor =1): int {
		$dir = "";
		$sig = "";
		if($new_floor > 1 && $new_floor < 3)
			$dir = "Up";
		else if($new_floor == 3)
			$dir = "Up";
		else
			$dir = "Down";
		$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');
		$query = 'UPDATE elevatorNetwork 
				SET currentFloor = :floor
				direction = :dir
				WHERE nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('dir', $dir);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();	
		
		return $new_floor;
	}
?>
<?php 
	function get_currentFloor(): int {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current floor
			$rows = $db->query('SELECT currentFloor FROM elevatorNetwork');
			foreach ($rows as $row) {
				$current_floor = $row[0];
			}
			return $current_floor;
	}

	function get_direction() {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current direction
			$rows = $db->query('SELECT direction FROM elevatorNetwork');
			foreach ($rows as $row) {
				$direction = $row[0];
			}
			return $direction
	}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 6 landing page</title>
    <link href="./CSS/style2.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>

<html>
	<div class="MainC">
	<h1>Elevator Control</h1> 
	
	<?php 
		if(isset($_POST['newfloor'])) {
			$curFlr = update_elevatorNetwork(1, $_POST['newfloor']); 
			header('Refresh:0; url=index.php');	
		} 
		$curFlr = get_currentFloor();
		echo "<h2>Current floor # $curFlr </h2>";			
	?>		
	
	<h2> 	
		<form action="index.php" method="POST">
			Request floor # <input type="number" style="width:50px; height:40px" name="newfloor" max=3 min=1 required />
			<input type="submit" value="Go"/>
		</form>
	</h2>
	</div>
</html>
 
 
