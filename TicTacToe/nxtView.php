<?php 

	session_start();
	if(isset($_GET['b'])){};

	include 'connection.php';
	$conn = new MySQLi($server,$username,$password);


	$sql = "select * from ".$dbnameGH.".view where playerID=".$_SESSION['player']['id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$pos = $row['view'];

	$pos2 = $pos + 1;

	$sql = "update ".$dbnameGH.".view set view=".$pos2." where playerID=".$_SESSION['player']['id'];
	$conn->query($sql);

	$sql = "select * from ".$dbnameGH.".view where playerID=".$_SESSION['player']['id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$pos2 = $row['view'];
	echo "pos2 " . $pos2 . "' );";

	echo $_SESSION['gameHist_id'];

	$gameIdStr = "g" . $_SESSION['gameHist_id'];


	$sql = "select * from ".$dbnameGH.".".$gameIdStr." where id=".$pos2;
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$_SESSION['box1'] = $row['box1'];
		$_SESSION['box2'] = $row['box2'];
		$_SESSION['box3'] = $row['box3'];
		$_SESSION['box4'] = $row['box4'];
		$_SESSION['box5'] = $row['box5'];
		$_SESSION['box6'] = $row['box6'];
		$_SESSION['box7'] = $row['box7'];
		$_SESSION['box8'] = $row['box8'];
		$_SESSION['box9'] = $row['box9'];
	}
	
?>