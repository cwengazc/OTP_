<?php 
require_once("functions.php");

global $conn;
$user_id = $_SESSION['player']['id'];
$select = mysqli_query($conn, "SELECT gameId FROM `player` WHERE gameId != 0") or die('query failed');
?>
						

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="styles.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>insert cool group name </title>
  <script src="https://kit.fontawesome.com/93116e28c5.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
  <script src="validation.js" defer></script>

</head>

<body class="full-height-grow">
	<div class="container full-height-grow">
	
	<!-- This is the ubiquotous Navigation Bar of our website, containing the logo and buttons -->
	<header class="main-header">
		<div href="/" class="brand-logo" >
			<img src="logo.png">
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="#"> Add Friend </a> </li>
				<li> <a href="#"> Game History </a> </li>
				<li> <a href="login.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>
	
	
	<!-- Shows the friends icon-->
	<section class="join-main-section"> 
		
		<div href="/" class="left-join-friends-section" >
                        <div class="friends-image-container"> </div>
			
			
			<h1> Challenge your friends <br>to a duel to the death!</h1> 
			<br>
			<h3>  Go back <a href="profile-page.php" > <i class="fa-solid fa-left-from-line"></i>... </a></h3>
		</div>
		
		<!-- Displays the friend list ie all the players a player is friends with!-->
		<div class="profile-container">
            <div class="update-aesthetic-image-container">
				
			</div>
			<h1> Games </h1>
			
					<?php	
      
					if ($select) {
					// Display the user's friends in rows 
          
          echo "<div class='friend-input-group'>";
					while ($row = mysqli_fetch_assoc($select)) {
						$gameId = $row['gameId'];
              echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $gameId </span> </h3> </div> <div><a href='Checkers/spectate.php?gameId=$gameId' type='button' class='btn'> Watch </a></div>";
					    echo "</div>";
          }
           
          
					echo "</div>";

					}
           
					?>
		</div>
		
	</section>
	
	
	
	</div>

	<!-- This is the ubiquotous footer of our website -->
	<footer class="main-footer"> 
		<div class="container">
			<nav class="footer-nav"> 
				<ul>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				Copyright &#169 2023 insert cool group name. All rights reserved.
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
