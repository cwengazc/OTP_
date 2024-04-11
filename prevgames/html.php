<?php
require_once("getgame.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="/styles.css" rel="stylesheet">
  <link href="/index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/93116e28c5.js" crossorigin="anonymous"></script>
  <title>insert cool group name - login </title>
</head>

<body class="full-height-grow">
	<div class="container full-height-grow">
	<header class="main-header">
		<div href="../index.html" class="brand-logo" >
		<a href="../homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="../homepage.php"> Play Now </a> </li>
				<li> <a href="#"> Spectate </a> </li>
				<li> <a href="../logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>

	<section class="join-main-section"> 
		
		<div href="/" class="left-join-section" >
			
			<h1> Here you can view a record of all the games  you've completed to this point! </h1>
			
			<img src="../player-info.png" alt="Profile Pic :)">
			
			<br>
		
			<h3>  Go back <a href="../homepage.php" > <i class="fa-solid fa-left-from-line"></i>... </a></h3>
		
			
			
		</div>
		
		<div class="update-container">
            <div class="update-aesthetic-image-container">
				
			</div>
			<h1> Previous games </h1>
			
						<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<?php echo $deleteMsg??''; ?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead><tr><th>id</th>
								
								<th>Game ID</th>
								<th>Player 1</th>		
								<th>Player 2</th>
								<th>Time</th>
								<th>Date</th>
								</thead>
							<tbody>
						<?php
						if(is_array($fetchData)){      
							$sn=1;
							foreach($fetchData as $data){
						?>
							<tr>
							<td><?php echo $data['id']??''; ?></td>
							<td><a href="../Checkers/hist.php?gameId=<?= $data['gameId'] ?>"><?php echo $data['gameId']??''; ?></a></td>
							<td><?php echo $data['player1']??''; ?></td>
							<td><?php echo $data['player2']??''; ?></td>
							<td><?php echo $data['time']??''; ?></td>
							<td><?php echo $data['date']??''; ?></td>
							</tr>
						<?php
							$sn++;}}else{ ?>
							<tr>
							<td colspan="8">
							<?php echo $fetchData; ?>
							</td>
							<tr>
						<?php
						}?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>			
		</div>
		
		
	</section>

	
	</div>
		
	<footer class="main-footer"> 
		<div class="container">
			<nav class="footer-nav"> 
				<ul>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				Copyright &#169 2023 &#60insert cool group name &#47&#62. All rights reserved.
			</nav>
			<nav class="footer-nav"> 
				<ul>
					<li> Ayanda | Cwenga | Kagiso | Nqobile | Senzo | Tsholo </li>
				</ul>
			</nav>
		</div>
	</footer>


</body>
</html>

