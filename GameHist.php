<?php 
	require_once("functions.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="styles.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/93116e28c5.js" crossorigin="anonymous"></script>
  <title>insert cool group name - homepage </title>
</head>

<body class="full-height-grow">
	<div class="container full-height-grow">
	<header class="main-header">
		<div href="index.html" class="brand-logo" >
			<img src="logo.png">
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="homepage.php"> Play Now </a> </li>
				<li> <a href="#"> Spectate </a> </li>
				<li> <a href="profile-page.php"> <em><u> <?= $_SESSION['player']['username'] ?> </u> </em> </a> </li>			
			</ul>
		</nav>
	</header>
	
	<section class="join-main-section"> 
		
		<div href="/" class="left-join-section">

			<h1 class="join-text"> 
				Your current path in <br> becoming a Grand Master: <br>
				<span class="accent-text"> Game History </span>
			</h1>
		
			<img src="console-graphic.png" alt="Neon Checkers Board">
		</div>
		
		
		<form class="join-form">
			<div class="input-group"> 
				<a type="button" class="btn" href="prevgames/html.php">Checkers</a>
			</div>
			<div class="input-group"> 
				<a type="button" class="btn" href="prevgames/html.php">Tic Tac Toe</a>
			</div>
			<div class="input-group"> 
				<a type="button" class="btn" href="moregames.html">The Last One</a>
			</div>
		</form>
	</section>
	</div>
	
	<footer class="main-footer"> 
		<div class="container">
			<nav class="footer-nav"> 
				<ul>
					<li><a href="https://github.com/KagisoLesomo/OTP">About Us</a></li>
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
