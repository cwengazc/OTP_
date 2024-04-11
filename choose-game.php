<?php 
	require_once("functions.php");
 
 global $conn;
 $username = $_SESSION['player']['username'];
 $user_id = $_SESSION['player']['id'];
 
 if (isset($_POST['challenge_friend'])) {
   $_SESSION['friendOppName'] = $_POST['challenge_friend']; 
 }
 
 $friend_opponent = $_SESSION['friendOppName']; 
 
 
// This php code is responsible for accepting a game challenge from your friends
// It runs when the friend button is clicked

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
  <script src="https://kit.fontawesome.com/93116e28c5.js" crossorigin="anonymous"></script>
  <title>insert cool group name - homepage </title>
</head>

<!-- # This is the ubiquotous Navigation Bar of our website, containing the logo and buttons -->
<body class="full-height-grow">
	<div class="container full-height-grow">
	<header class="main-header">
		<div href="/" class="brand-logo" >
			<a href="homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="main-nav">
			<ul>
        <!-- // Now we display the number of notifications next to the username on the homepage -->
				
        <li> <a href="login.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>
	
	<section class="join-main-section"> 
		
		<div href="/" class="left-join-section">
      <!-- // This is the main body of the home page -->
			
		
			<img src="choose-game.png" alt="Neon Checkers Board">
      
    <h1> 
				Choose the game you want to use to challenge your friend, <span class='accent-text'> <?php echo $friend_opponent;?> </span> to.
			</h1>
		</div>
		
		<!-- // Here you choose the game you wish to play (sends the actual game challenge to your friend) -->
		<form class='join-form'>
      	
			<!--		// Display the friend requests the user has received from other players -->
          <!-- // Also prints the html and css code for the buttons and text -->
           <div class='friend-input-group'>
					    <div class='see-friendlist'>
							    <div>
                    <form method='POST'> 
                       <?php echo "<input type='hidden' name='checkers_challenge' value='$friend_opponent'>"; ?>
                       <button type='submit' class='btn'> Checkers </button>
                    </form>
                  </div>
                  <div>
                    <form method='POST'>
                      <?php echo "<input type='hidden' name='tictactoe_challenge' value='$friend_opponent'>"; ?>
                      <button type='submit' class='btn'> Tic Tac Toe </button>
                    </form>
                  </div> 
                  <div>
                    <form method='POST'>
                      <?php echo "<input type='hidden' name='rps_challenge' value='$friend_opponent'>"; ?>
                       <button type='submit' class='btn'> Rock Paper Scissors </button>
                    </form>
                  </div>
                       
					    </div>
           
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

<?php 
// This php code is responsible for accepting a game challenge from your friends
// It runs when the friend button is clicked
if (isset($_REQUEST['checkers_challenge'])) {
  $friendName = $_REQUEST['checkers_challenge'];
  
  $friendOpponentQuery = mysqli_query($conn, "SELECT id FROM `player` WHERE username='$friendName'") or die('query failed');
  $friendOpponentIDQuery = mysqli_fetch_assoc($friendOpponentQuery);
  $friendOpponentID = $friendOpponentIDQuery['id'];
  $insertQuery = mysqli_query($conn, "INSERT INTO `game_requests` (sender_id, sender_name, receiver_id, receiver_name, game) VALUES ('$user_id','$username', '$friendOpponentID','$friendName', 'checkers')") or die('query failed');
  
  if ($insertQuery) {
     header("Location: friend.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}

// This code is responsible for sending a game challenge for Tic Tac Toe to your friend
// Triggered by clicking the Tic Tac Toe button
if (isset($_POST['tictactoe_challenge'])) {
  $friendName1 = $_POST['tictactoe_challenge'];
  
  $friendOpponentQuery1 = mysqli_query($conn, "SELECT id FROM `player` WHERE username='$friendName1'") or die('query failed');
  $friendOpponentIDQuery1 = mysqli_fetch_assoc($friendOpponentQuery1);
  $friendOpponentID1 = $friendOpponentIDQuery1['id'];
  $insertQuery1 = mysqli_query($conn, "INSERT INTO `game_requests` (sender_id, sender_name, receiver_id, receiver_name, game) VALUES ('$user_id','$username', '$friendOpponentID1','$friendName1', 'tictactoe')") or die('query failed');
  
  if ($insertQuery1) {
     header("Location: friend.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}

// This code is responsible for sending a game challenge for Rock Paper Scissors to your friend
// Triggered by clicking on the Rock Paper Scissors button
if (isset($_POST['rps_challenge'])) {
  $friendName2 = $_POST['rps_challenge'];
  
  $friendOpponentQuery2 = mysqli_query($conn, "SELECT id FROM `player` WHERE username='$friendName2'") or die('query failed');
  $friendOpponentIDQuery2 = mysqli_fetch_assoc($friendOpponentQuery2);
  $friendOpponentID2 = $friendOpponentIDQuery2['id'];
  $insertQuery2 = mysqli_query($conn, "INSERT INTO `game_requests` (sender_id, sender_name, receiver_id, receiver_name, game) VALUES ('$user_id','$username', '$friendOpponentID2','$friendName2', 'rps')") or die('query failed');
  
  if ($insertQuery2) {
     header("Location: friend.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}

?>
