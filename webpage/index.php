<?php
	session_start();
	if(isset($_SESSION['user'])){
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 6 landing page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <div class="text-center">
                <div class="elevetor-control">
                    <h1>Elevator Control(<a href="logout.php"> logout </a>)</h1> 
                    <ul class="flex-list">
                        <li>
                            <a href="" class="btn">
                                <i class="fa fa-bell"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" class="btn">
                                <i class="fa fa-phone"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" class="btn">
                                <i class="fa fa-wifi"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-md-6">
                            <form action="">
                                <input type="text" class="form-control" placeholder="Enter Floor Number" name="" id="floorNumber">
                            </form>
                            <div class="flex btnFlex">
                                <button class="btn floorBtn floor1">1</button>
                                <button class="btn floorBtn floor2">2</button>
                                <button class="btn floorBtn floor3">3</button>
                            </div>
                            <button class="btn mt-2 enterBtn">
                                Enter
                            </button>

                            <ul class="flex-list mt-2 between">
                                <li>
                                    <a href="" class="btn">
                                        <i class="fa fa-music"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="btn">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="btn">
                                        <i class="fa fa-newspaper"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="btn">
                                        <i class="fa fa-circle"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <form action="">
                                <input type="text" class="form-control" placeholder="Current Floor" name="" id="">
                                <input type="text" class="form-control mt-2" placeholder="Time to Desired Destination" name="" id="">
                            </form>
                           

                            <ul class="flex-list mt-2">
                                <li>
                                    <button class="btn liftBtn">
                                        <i class="fa fa-angle-right"></i> <span class="line">|</span> <i class="fa fa-angle-left"></i>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn liftBtn">
                                        <i class="fa fa-angle-left"></i> <span class="line">|</span> <i class="fa fa-angle-right"></i>
                                    </button>
                                </li>
                            </ul>

                            <button class="btn bg-none">
                                <img src="./images/stop.png" alt="">
                            </button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.floorBtn').click(function(){
            $('.floorBtn').removeClass('active')
            $(this).addClass('active')
            var num = $(this).text()
            // console.log(num)
            $('#floorNumber').val(num)
        })
    </script>
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
</body>
</html>

<?php }else{ header("Location:index.html"); } ?>
 
 