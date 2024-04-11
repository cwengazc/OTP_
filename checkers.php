<?php 
	require_once("functions.php");

	$id = $_SESSION['player']['id'];

	$result = db_select('player', "id = {$id}");

	$_SESSION['player'] = $result[0];
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
	<link rel="stylesheet" href="style.css">

</head>

<body id="ht">
<!-- these 3 are set so that the indexing of the classes starts from 1 -->
<div class="checker white_checker" style="display:none"> </div>
<div class="checker black_checker" style="display:none"> </div>
<div class="square" style="display: none" id ="ht"> </div>

<div class="black_background" id="black_background"> </div>

	<div class="score" id="score"><br></div>
	<div class="end" id="end">The opponent left my G <a href="homepage.php"><br><br> Leave too</a></div>

	<?php 
if($_SESSION["player"]["gameColor"] == "blue") { 
	?>
	<div class="label"><?= $_SESSION['opponent']['username'] ?></div>
<?php } else { ?>
	<div class="label"><?= $_SESSION['player']['username'] ?></div>
<?php } ?>

<div class="table" id="table">	

	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>	
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>
	<div class="checker white_checker"> </div>	

	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>
	<div class="checker black_checker"> </div>

	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="clear_float"> </div>
	
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="clear_float"> </div>

	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="clear_float"> </div>

	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="clear_float"> </div>

	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="clear_float"> </div>

	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="clear_float"> </div>

	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="clear_float"> </div>

	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="square white_square"> </div>
	<div class="square black_square"> </div>
	<div class="clear_float"> </div>

</div>

<?php 

if($_SESSION["player"]["gameColor"] == "red") { ?>
	<div class="label"><?= $_SESSION['opponent']['username'] ?></div>
<?php } else { ?>
	<div class="label"><?= $_SESSION['player']['username'] ?></div>
<?php } ?>

<div class="endGame"><a href="endGame.php">End Game</a></div>

<audio id="moveSound">
	<source src = "sounds/move.mp3"> 
</audio>

<audio id="winSound">
	<source src="sounds/win.mp3">
</audio>

<audio id="endSound">
	<source src="sounds/start.mp3">
</audio>

<script src="script.js" > </script>
</body>
</html>