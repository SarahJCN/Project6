<?php 
	
	function update_elevatorNetwork(int $node_ID, int $new_floor): int {include "config.php";
		$user = $_SESSION['user'];
		$dir = "";
		$sig = "";
		if($new_floor > 1 && $new_floor < 3)
			$dir = "Up";
		else if($new_floor == 3)
			$dir = "Up";
		else
			$dir = "Down";
		$db1 = new PDO('mysql:host='.$DBSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');
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

	function get_currentFloor(): int { include "config.php";
		try { $db = new PDO('mysql:host='.$DBSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current floor
			$rows = $db->query('SELECT currentFloor FROM elevatorNetwork');
			foreach ($rows as $row) {
				$current_floor = $row[0];
			}
			return $current_floor;
	}
	function get_direction() { include "config.php";
		try { $db = new PDO('mysql:host='.$DBSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');}
		catch (PDOException $e){echo $e->getMessage();}

			// Query the database to display current direction
			$rows = $db->query('SELECT otherInfo FROM elevatorNetwork');
			foreach ($rows as $row) {
				$direction = $row[0];
			}
			return $direction;
	}
	//function to get number of times user visited a floor
	function get_visited_time($user,$num) { include "config.php";
		try { $db = new PDO('mysql:host='.$DBSERVER.';dbname='.$DBNAME,''.$DBUSER.'',''.$DBPASSWORD.'');}
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