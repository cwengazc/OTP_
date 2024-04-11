<?php 
session_start();
if(isset($_GET['b'])){
	include 'connection.php';
$conn = new MySQLi($server,$username,$password);
	$sql = "select * from ".$dbname.".gamesessions where sessionid=".$_SESSION['gamesessionid'] ;
$result = $conn->query($sql);
$val =0;
$box = $_GET['b'] ;
while($row = $result->fetch_assoc()){
	$p1id = $row['pl1id'];
	$p2id = $row['pl2id'];
	$bx = $row['box'.$box];
	$pid = $_SESSION['player']['id'];
	if($pid ==  $p1id)
	$val = 1;
	else if($pid == $p2id)
	$val =2;
}
if($bx == 0){
	$box = $_GET['b'] ;
	$sql = "UPDATE ".$dbname.".`gamesessions` SET `box".$box."`=".$val." , count = count+1 WHERE sessionid=".$_SESSION['gamesessionid'];
	if($conn->query($sql) == true){
		echo "record inserted!";
	}

	//Records in game history
	$sql = "select * from ".$dbname.".gamesessions where sessionid=".$_SESSION['gamesessionid'] ;
	$result = $conn->query($sql);

	$row = $result->fetch_assoc();
	$box1 = $row['box1'];
	$box2 = $row['box2'];
	$box3 = $row['box3'];
	$box4 = $row['box4'];
	$box5 = $row['box5'];
	$box6 = $row['box6'];
	$box7 = $row['box7'];
	$box8 = $row['box8'];
	$box9 = $row['box9'];

	$gameIdStr = $gameIdStr = "g" . $_SESSION['gamesessionid'];

	$connHist = new mysqli($server, $username, $password, $dbnameGH);
	$sqlConn = "INSERT INTO  ".$gameIdStr." (`box1`, `box2`, `box3`, `box4`, `box5`, `box6`, `box7`, `box8`, `box9`) VALUES (".$box1.",".$box2.",".$box3.",".$box4.",".$box5.",".$box6.",".$box7.",".$box8.",".$box9.")";
	$connHist->query($sqlConn);
	$connHist->close();
}
else {
	 echo $conn->error;
}	
	}


?>