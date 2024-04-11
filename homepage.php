<?php 
	require_once("functions.php");

  global $conn;
 $username = $_SESSION['player']['username'];
 
 //This code sends a MySQL query to the databse to check how many friend requests the player has
 $numRequestsQuery = mysqli_query($conn, "SELECT COUNT(*) AS num_requests FROM `friend_requests` WHERE receiver_name='$username'") or die('query failed');
 $numRequestsRow = mysqli_fetch_assoc($numRequestsQuery);
 $numRequests = $numRequestsRow['num_requests'];
          
 // Similarly this code counts how many game challenges the player has received
 $numChallengesQuery = mysqli_query($conn, "SELECT COUNT(*) AS num_challenges FROM `game_requests` WHERE receiver_name='$username'") or die('query failed');
 $numChallengesRow = mysqli_fetch_assoc($numChallengesQuery);
 $numChallenges = $numChallengesRow['num_challenges'];
 
 // This is the total number of notifications (Requests and Challenges combined)         
 $numNotifications = $numRequests + $numChallenges;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- # This is the ubiquotous Navigation Bar of our website, containing the logo and buttons -->
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
        <!-- // Now we display the number of notifications next to the username on the homepage -->
				<li> <a href="homepage.php"> Play Now </a> </li>
				<li> <a href="spectate.php"> Spectate </a> </li>
				<li> <a href="prevgames/html.php"> Game History </a> </li>
				<li> <a href="profile-page.php"> <em><u> <?= $_SESSION['player']['username'] ?> </u> </em> </a>  </li>
        <li> <a href="friend.php"> <span style='colour: #CD366C'> <i class="fa-solid fa-bell"></i> <?php 
        // If we do not have any notifications we do not display the count 
        if ($numNotifications > 0) { echo '('; echo $numNotifications; echo ')';} ?> </span></a> </li>			
			</ul>
		</nav>
	</header>
	
	<section class="join-main-section"> 
		
		<div href="/" class="left-join-section">

<!-- // This is the main body of the home page -->
			<h1 class="join-text"> 
				Indulge in your <br> favourite 
				<span class="accent-text"> games. </span>
			</h1>
		
			<img src="console-graphic.png" alt="Neon Checkers Board">
		</div>
		
		<!-- // Here you choose the game you wish to play (random pairing) -->
		<form class="join-form">
			<div class="input-group"> 
				<a type="button" class="btn" href="Matching/enterGame.php">Checkers</a>
			</div>
			<div class="input-group"> 
				<a type="button" class="btn" href="TicTacToe/enterGame.php">Tic Tac Toe</a>
			</div>
			<div class="input-group"> 
				<a type="button" class="btn" href="RockPaperScissors/enterGame.php">Rock Paper Scissors</a>
			</div>
		</form>
	</section>
	</div>
	
 <!-- //This is the ubiquotous footer of our website -->
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
