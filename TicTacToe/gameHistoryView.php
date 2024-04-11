<?php 
session_start();

include 'connection.php';
// $conn = new MySQLi($server,$username,$password);

//Make script to search and connect to existing game id's since they delete afeter each match, there'll never be duplicates, taking the id's from gamesession tables


// $connHist = new mysqli($server, $username, $password, $dbnameGH); //TTT History database

$conn = new MySQLi($server,$username,$password);
$_SESSION['position'] = 1;

$pltype = 'rec';
$pname = "Kagiso";
$oppname = "Senzo";


?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo "Kagiso";?> - Tic Tac Toe</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-3.3.4.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
<script> 
var checkedboxes = new Array(0,0,0,0,0,0,0,0,0);


function goNext(){
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				    
					
            }
        };
		xmlhttp.open("GET","nxtView.php?b=1",true);
        xmlhttp.send();
	}

	function goPrev(){
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				    
					
            }
        };
		xmlhttp.open("GET","prvView.php?b=1",true);
        xmlhttp.send();
	}



$(document).ready(function(){

	function onNextClick(){

	goNext();
		
	checkedboxes[0] = <?php echo $_SESSION['box1']; ?>;
	checkedboxes[1] = <?php echo $_SESSION['box2']; ?>;
	checkedboxes[2] = <?php echo $_SESSION['box3']; ?>;
	checkedboxes[3] = <?php echo $_SESSION['box4']; ?>;
	checkedboxes[4] = <?php echo $_SESSION['box5']; ?>;
	checkedboxes[5] = <?php echo $_SESSION['box6']; ?>;
	checkedboxes[6] = <?php echo $_SESSION['box7']; ?>;
	checkedboxes[7] = <?php echo $_SESSION['box8']; ?>;
	checkedboxes[8] = <?php echo $_SESSION['box9']; ?>;

	for(var i=0; i<10; i++)
	{
		if(checkedboxes[i] == 1)
		{
			$(".div"+(i+1)).css("background-image", "url(images/tic1.png)");
		} 
		else if (checkedboxes[i] == 2)
		{
			$(".div"+(i+1)).css("background-image", "url(images/cross1.png)");
		}
	}

	// setTimeout(location.reload.bind(location), 10000);

	}


	function onPrevclick(){

	goPrev();
		
	checkedboxes[0] = <?php echo $_SESSION['box1']; ?>;
	checkedboxes[1] = <?php echo $_SESSION['box2']; ?>;
	checkedboxes[2] = <?php echo $_SESSION['box3']; ?>;
	checkedboxes[3] = <?php echo $_SESSION['box4']; ?>;
	checkedboxes[4] = <?php echo $_SESSION['box5']; ?>;
	checkedboxes[5] = <?php echo $_SESSION['box6']; ?>;
	checkedboxes[6] = <?php echo $_SESSION['box7']; ?>;
	checkedboxes[7] = <?php echo $_SESSION['box8']; ?>;
	checkedboxes[8] = <?php echo $_SESSION['box9']; ?>;

	for(var i=0; i<10; i++)
	{
		if(checkedboxes[i] == 1)
		{
			$(".div"+(i+1)).css("background-image", "url(images/tic1.png)");
		} 
		else if (checkedboxes[i] == 2)
		{
			$(".div"+(i+1)).css("background-image", "url(images/cross1.png)");
		}
	}

	// setTimeout(location.reload.bind(location), 10000);

	}


	$(".nxt").click(function(){
		onNextClick();
    });
	$(".prv").click(function(){
		onPrevclick();
    });


});


</script>
</head>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
   <a href="online.php" > <button style="float:left; margin:2%;" class="btn btn-default"><span class="glyphicon glyphicon-backward"> </span> Back</button></a>
	<a href="logout.php" > <button style="float:right; margin:2%;" class="btn btn-default"> <span class="glyphicon glyphicon-log-out"> </span> Quit</button></a>
	<button style="float:right; margin:2%;" class="nxt"> <span class="glyphicon glyphicon-log-out"> </span> Next</button></a>
	<button style="float:right; margin:2%;" class="prv"> <span class="glyphicon glyphicon-log-out"> </span> Prev</button></a>
</div></nav>
<body style="background:#8DC9F4;">
<div class="container">
<center>
<h1 id="txt"></h1>
<form action="#" method="post">

<div  id="divback" style="background:url(images/bisaat.png); background-repeat:no-repeat; background-size:auto; background-position:center; height:400px; width:360px;">
<div id="tictac-div" class="div1" style="margin-left:0; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div2" style=" background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div3" style=" background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div4" style="margin-top:10px; margin-left:0; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div5" style=" margin-top:10px; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div6" style=" margin-top:10px; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div7" style=" margin-top:10px;margin-left:0; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div8" style=" margin-top:10px; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>
<div id="tictac-div" class="div9" style=" margin-top:10px; background:url(); background-repeat:no-repeat; background-size:contain; background-position:center;" > </div>

 </div>
 <br>
 <span style="font-size:20px;">
 <p id="turntxt" style="color:white;"></p> 
 <input type="radio" id="pl1" name="player" value="1" disabled/> <?php echo "Kagiso"; ?>&nbsp;
 <input type="radio" id="pl2" name="player" value="2" disabled/> <?php echo "Senzo"; ?><br>
</span>
</form>
</div></center>
<!-- The Modal -->
<div id="myModal" style="background:rgba(255,255,255,1); border:2px solid black; padding:20px; color:black; width:30%; height:30%; margin-left:35%; margin-top:10%;" class="modal">

  <!-- Modal content --> 
      <h1 id="plwin"> </h1><br>
  <form action="logout.php">  <button type="submit" style="border:1px solid black;" autofocus> Done!</button></form>
</div>
</body>
</html>