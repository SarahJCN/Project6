<?php
	session_start();
	if(isset($_SESSION['user'])) {
	function update_elevatorNetwork(int $node_ID, int $new_floor): int {
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
				SET currentFloor = :floor,
				otherInfo = :dir
				WHERE nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('dir', $dir);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();	
		return $new_floor;
	}

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
			$rows = $db->query('SELECT otherInfo FROM elevatorNetwork');
			foreach ($rows as $row) {
				$direction = $row[0];
			}
			return $direction;
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
		<table width="800px" align="center">
			<tr align="center" bgcolor="gray">
				<td style="color:white; font-size:18px">Floors</td>
				<td style="color:white; font-size:18px">Cuurent Status</td>
			</tr>
			<tr>
				<td>
					<div class="floors">
						<div class="box" id="3rd">3rd Floor</div>
						<div class="box" id="2nd">2nd Floor</div>
						<div class="box" id="1st">1st Floor</div>
					</div>
				</td>
				<td>
					<table width="300px">
						<tr bgcolor="gray" align="center">
							<td style="color:white; font-size:18px">Current Floor</td>
							<td style="color:white; font-size:18px">Direction</td>
							<td style="color:white; font-size:18px">Signal</td>
						</tr>
						<tr align="center">
							<td id="floorNum">
								<?php 
									if(isset($_POST['newfloor'])) { 
										$curFlr = update_elevatorNetwork(1,$_POST['newfloor']);
										header('Refresh:0; url=index.php');	
									} 
									$curFlr = get_currentFloor();
									echo $curFlr;			
								?>
							</td>
							<td><?php echo get_direction(); ?></td>
							<td>closed</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<h2> 	
						<form action="index.php" method="POST">
							Request floor #  <br/><input type="number" style="width:150px; height:40px" name="newfloor" max="3" min="1" required />
							<input type="submit" value="Go"/>
						</form>
					</h2>
				</td>
			</tr>
		</table>		
	</div>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		var num = $("#floorNum").html();
		if(num == 1){
			$("#1st").css({"backgroundColor":"black","color":"white"});
		}
		if(num == 2){
			$("#2nd").css({"backgroundColor":"black","color":"white"});
		}
		if(num == 3){
			$("#3rd").css({"backgroundColor":"black","color":"white"});
		}
	})
</script>
<?php 
}
else {
	header ("Location:index.html");
}
?>
 
 
