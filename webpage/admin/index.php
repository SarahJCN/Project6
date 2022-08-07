<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin side</title>
	<link href="../CSS/style2.css" type="text/css" rel="stylesheet">
	 <script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
<table align="center" bgcolor="gray" style="color:white; margin-top: 150px;" width="600px" height="300px">
	<?php
		session_start();
		include "../config.php";
		$db1 = mysqli_connect($DBSERVER,$DBUSER,$DBPASSWORD,$DBNAME);
		$date = date('Y-m-d');
		$qry = "SELECT * FROM chat where dated = '$date' and userId != 'admin' group by userId";
		$data = mysqli_query($db1,$qry) or die(mysqli_query($db1));
		$count = mysqli_num_rows($data);
	?>
	
	<tr align="center">
		<td colspan="4">Welcome Admin <br> You have (<?php echo $count ?>) new Chats. <hr></td>
	</tr>
	<?php 
		while($data1 = mysqli_fetch_array($data)){
	 ?>
	<tr align="center">
		<td><?php echo $data1["chatId"]; ?></td>
		<td><?php echo $data1["userId"]; ?></td>
		<input type="hidden" id="user" value="<?php echo $data1['userId']; ?>">
		<td><a href="javascript:void(0)" id="myBtn">Reply</a></td>
	</tr>
<?php } ?>
	</table>


<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <span class="close">&times;</span>
	    <p>	<label>Type Something(Press enter key to send)</label> <br>
	    	<input type="text" id="send_sms" required> <span style="color:blue; cursor: pointer;" onclick="getChat()">Refresh Chat</span><br>
	    	<p id="resp"></p>
	    	<div class="chat">
	    		<p id="user1"></p>
	    		<p id="user2"></p>
	    	</div>
	    </p>
	  </div>

	</div>
	<!-- end modal -->

	<script type="text/javascript" src="../js/elevatorEvents.js"></script>
	<script type="text/javascript" src="../js/adminchat.js"></script>
</body>
</html>