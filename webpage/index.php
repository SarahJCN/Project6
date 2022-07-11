<?php
	session_start();
	if(isset($_SESSION['user'])){ 
		include "config.php";
		include "functions.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 6 landing page</title>
    <script src="js/sound.js"></script>
    <link href="./CSS/style2.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
							<td style="color:white; font-size:18px">Queue</td>
							<td style="color:white; font-size:18px">Current Floor</td>
							<td style="color:white; font-size:18px">Direction</td>
							<td style="color:white; font-size:18px">Signal</td>
							<td style="color:white; font-size:18px">Visited</td>
						</tr>
						<tr align="center">
							<td>
								<?php 
									if(isset($_POST['newfloor'])) { 
										$q = [];
										$rqf = $_POST['newfloor'];
										$qf = $_POST['current_floor'];
										if($rqf < $qf){
											for($i = $qf-1; $i >= $rqf; $i--){
												array_push($q, $i);												
											}
											$js = json_encode($q);
											$curFlr = update_elevatorNetwork(1,$rqf, $js);
												header('Refresh:0; url=index.php');
										}else{
											for($i = $qf; $i <= $rqf-1; $i++){
												array_push($q, $i);	
											}
											$js = json_encode($q);
											$curFlr = update_elevatorNetwork(1,$i, $js);
											header('Refresh:0; url=index.php');
										}
										//echo array_search($rqf, $q);
											
									} 
									echo get_q();
									$curFlr = get_currentFloor();
												
								?>
							</td>
							<td id="floorNum"><?php echo $curFlr; ?></td>
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
							<span id="door"></span><i class="fa fa-bell myBell"></i><br>
							<input type="hidden" name="current_floor" id="setcurFloor" value="<?php echo $curFlr; ?>">
							<input type="text" name="newfloor" max="3" min="1" required placeholder="enter floor number" id="setVal" readonly /><br>
							<input type="button" value="1" onclick="getVal(this.value)" class="setMargin" id="fl1" />
							<input type="button" value="2" onclick="getVal(this.value)" class="setMargin" id="fl2" /> 
							<input type="button" value="3" onclick="getVal(this.value)" class="setMargin" id="fl3" /><br />
							<input type="button" value="<|>" class="setMargin" id="close"/>
							<input type="button" value=">|<" class="setMargin" id="open"/> <br>
							<!-- <input type="submit" value="Enter"/> -->
							<input type="button" value="Sabbath Mode" id="subbath" />
							<input type="button" value="Stop" id="stop" />
						</form>
					</h2>
				</td>
				<td>
					<canvas id="histogram" width="100" height="100"></canvas>
				</td>
			</tr>
		</table>		
	</div>

</body>
</html>
<script type="text/javascript" src="js/elevatorEvents.js"></script>
 <script type="text/javascript" src="js/graph.js"></script>
<?php }else{ header("Location:index.html"); } ?>
 
 
