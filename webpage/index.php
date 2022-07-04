<?php
	session_start();
	//die($_SESSION['user']);
	if(isset($_SESSION['user'])){ 
	function update_elevatorNetwork(int $node_ID, int $new_floor): int {
		$user = $_SESSION['user'];
		$dir = "";
		$sig = "";
		if($new_floor > 1 && $new_floor < 3)
			$dir = "Up";
		else if($new_floor == 3)
			$dir = "Up";
		else
			$dir = "Down";
		$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','root','');
		$query = 'UPDATE elevatorNetwork 
				SET currentFloor = :floor,
				otherInfo = :dir
				WHERE nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('dir', $dir);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();
		//check how many time user visited a floor
		$qry = 'SELECT * from counter WHERE floorNum = :floor AND userId = :user';	
		$stmt = $db1->prepare($qry);
		$stmt->bindvalue('floor',$new_floor);
		$stmt->bindvalue('user',$user);
		$stmt->execute();
		if($stmt->rowCount() == 0){
			//set counter for floor for user
			$query = "INSERT INTO counter (userId,floorNum,count) values('$user','$new_floor','1')";
			$db1->exec($query);
			//die("from if");
			get_visited_time($user, $new_floor);
		}else{ //die("from else");
			$row = $stmt->fetch();
			$count = $row['count'];
			$count = $count + 1;
			//check how many time user visited a floor
			$query = 'UPDATE counter 
				SET count = :count
				WHERE floorNum = :floor AND userId = :user';
			$statement = $db1->prepare($query);
			$statement->bindvalue('floor', $new_floor);
			$statement->bindvalue('user', $user);
			$statement->bindvalue('count', $count);
			$statement->execute();
		}
		return $new_floor;
	}

	function get_currentFloor(): int { 
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','root','');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current floor
			$rows = $db->query('SELECT currentFloor FROM elevatorNetwork');
			foreach ($rows as $row) {
				$current_floor = $row[0];
			}
			return $current_floor;
	}
	function get_direction() { 
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','root','');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current direction
			$rows = $db->query('SELECT otherInfo FROM elevatorNetwork');
			foreach ($rows as $row) {
				$direction = $row[0];
			}
			return $direction;
	}
	//function to get number of times user visited a floor
	function get_visited_time($user,$num) { 
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','root','');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display number of times a floor visited
			$qry = "SELECT count FROM counter WHERE userId = :user AND floorNum = :floor";
			$stmt = $db->prepare($qry);
			$stmt->bindvalue('user',$user);
			$stmt->bindvalue('floor',$num);
			$stmt->execute();
			$row = $stmt->fetch();
			//print_r($row["count"]);
			//die($row);
			return @$row["count"];
	}
?>




<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 6 landing page</title>
    <link href="./CSS/style2.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="MainC">
		<h1>Elevator Control(<a href="logout.php"> logout </a>)</h1> 
		<table width="800px" align="center">
			<tr align="center" bgcolor="gray">
				<td style="color:white; font-size:18px">Floors</td>
				<td style="color:white; font-size:18px">Curent Status</td>
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
							<td style="color:white; font-size:18px">Visited</td>
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
							<td><?php  echo get_visited_time($_SESSION['user'], $curFlr); ?> Times </td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<h2> 	
						<form action="index.php" method="POST">
							<input type="number" style="width:340px; height:40px; margin-bottom: 5px;" name="newfloor" max="3" min="1" required placeholder="enter floor number" id="setVal" readonly /><br>
							<input type="button" value="1" onclick="getVal(this.value)" />
							<input type="button" value="2" onclick="getVal(this.value)" /> 
							<input type="button" value="3" style="margin-bottom: 5px"  onclick="getVal(this.value)" /><br />
							<input type="submit" value="Enter"/>
							<input type="button" value="Sabbath Mode" id="subbath" />
							<input type="button" value="Stop" id="stop" />
						</form>
					</h2>
				</td>
			</tr>
		</table>		
	</div>
	
	<script>
		var myAudio = new Audio('js/test.mp3'); 
		myAudio.play();
	</script>
</body>
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
		//sabbath mode
		var flag = "up";
		$("#subbath").click(function(){
			subbath();
		});
		//subbath function
		function subbath(){
			var dt = new Date();
			var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			//if($("#floorNum").text())
			setInterval(function(){
				var fno = parseInt($("#floorNum").text());
				

				$.ajax({
					url: "setfloor.php",
					method: 'post',
					data: {fno:fno,flag:flag},
				}).done(function(data){
					$("#floorNum").text(data);
					data = parseInt(data);
					if(data == 1){ 
						$("#1st").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						flag = "up";
					}
					if(data == 2){ console.log("2nd")
						$("#2nd").css({"backgroundColor":"black","color":"white"});
						$("#1st").css({"backgroundColor":"white","color":"black"});
						$("#3rd").css({"backgroundColor":"white","color":"black"});
					}
					if(data == 3){
						$("#3rd").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						flag = "down";
					} console.log(flag)
				})
			}, 3000)
		}
		//subbath mode

		$("#stop").click(function(){
			location.reload();
		})

		var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

		var a = new Date();
		//alert(a.getDay())
		if(weekday[a.getDay()] == "Monday"){
			//alert("monday");
			subbath();
		}
				//end of document ready
			})
	function getVal(x){
		document.getElementById("setVal").value = x;
	}
</script>
<?php }else{ header("Location:index.html"); } ?>
 
 
