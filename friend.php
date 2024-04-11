
<?php 
// The php code for fetching a user's friends from the 'friends' table
require_once("functions.php");

global $conn;
$user_id = $_SESSION['player']['id'];
$select = mysqli_query($conn, "SELECT friend_username FROM `friends` WHERE id = '$user_id'") or die('query failed');

$user_id = $_SESSION['player']['id'];
$username = $_SESSION['player']['username'];
          
 ?>
						

<!DOCTYPE html>
<!-- // Header of the HTML section, includding the CSS stylesheets and JavaScript files  -->
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
	
	 <!-- # This is the ubiquotous Navigation Bar of our website, containing the logo and buttons -->
	<header class="main-header">
		<div href="/" class="brand-logo" >
			<a href="homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="search.php"> Add Friend <?php 
        $numRequestsQuery = mysqli_query($conn, "SELECT COUNT(*) AS num_requests FROM `friend_requests` WHERE receiver_name='$username'") or die('query failed');
        $numRequestsRow = mysqli_fetch_assoc($numRequestsQuery);
        $numRequests = $numRequestsRow['num_requests'];
        if ($numRequests > 0) { echo '('; echo $numRequests; echo ')';} ?> </a> </li>
				<li> <a href="#"> Game History </a> </li>
				<li> <a href="login.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>
	
	
	 <!-- # Shows the friends icon and blob regarding challenging your friends -->
	<section class="join-main-section"> 
		
		<div href="/" class="left-join-friends-section" >
			<img src="friends1.png" alt="Friends Pic :)">
			
			<h1> Challenge your friends <br>to a duel to the death!</h1> 
			<br>
			<h3>  Go back <a href="profile-page.php" > <i class="fa-solid fa-left-from-line"></i>... </a></h3>
		</div>
		
		 <!-- #Displays the friend list i.e all the players a player is friends with!-->
		<div class="friends-container">
            <div class="update-aesthetic-image-container"> </div>
			    <h1> Friends </h1>
			
					<?php	
					if ($select) {
					// Display the user's friends in rows 
          // Also prints the html and css code for the buttons and text
          echo "<div class='friend-input-group'>";
					while ($row = mysqli_fetch_assoc($select)) {
						$friendName = $row['friend_username'];
                          
            $challengeSent = mysqli_query($conn, "SELECT sender_name, receiver_name, game FROM `game_requests` WHERE sender_name='$username' AND receiver_name='$friendName'") or die('query failed');
            
            if (mysqli_num_rows($challengeSent) > 0) {
            
                $row1 = mysqli_fetch_assoc($challengeSent);
                $game = $row1['game'];
                echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName : $game  </span> </h3> </div> <div> <input type='hidden' name='challenge_friend' value='$friendName'><button disabled class='btn'> Challenge Sent </button></div>";
					    echo "</div>";
            } else {
                echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName </span> </h3> </div> <div><form method='POST' action='choose-game.php'> <input type='hidden' name='challenge_friend' value='$friendName'><button type='submit' class='btn'> Challenge </button></form></div>";
					    echo "</div>";
            } 
              
          }
					echo "</div>"; }
					?>
            
         
         <!-- // Here we display the game challenges we've received from our friends -->   
         <h1 style="margin-top: 0"> My Challenges </h1>
         
         <?php	
         
         $select2 = mysqli_query($conn, "SELECT * FROM `game_requests` WHERE receiver_name = '$username'") or die('query failed');
					if ($select2) {
					// Display the friend requests the user has received from other players 
          // Also prints the html and css code for the buttons and text
          echo "<div class='friend-input-group'>";
					while ($row2 = mysqli_fetch_assoc($select2)) {
						$friendName2 = $row2['sender_name'];
            $friendGame = $row2['game'];
              echo "<div class='see-friendlist'>";
							echo  "<div> <h3> <span class='profile-accent-text'> $friendName2 : $friendGame </span> </h3> </div>
                      <div class='accept-reject'>
                        <div>
                         <form method='POST'> 
                           <input type='hidden' name='accept_game_request' value='$friendName2'>
                           <button type='submit' class='btn'> Accept </button>
                         </form>
                        </div>
                       <div>
                         <form method='POST'>
                           <input type='hidden' name='reject_game_request' value='$friendName2'>
                           <button type='submit' class='btn'> Reject </button>
                         </form>
                       </div> 
                     </div>";
					    echo "</div>";
          } 
					echo "</div>"; }
					?>
		</div>
		
	</section>
	
	</div>

	 <!-- //This is the ubiquotous footer of our website -->
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

<?php 
// This php code is responsible for accepting a game challenge from your friends
// It runs when the friend button is clicked
if (isset($_POST['accept_games_request'])) {
  $friendName4 = $_POST['accept_games_request'];
  
  $acceptQuery = mysqli_query($conn, "DELETE FROM `game_requests` WHERE sender_name='$friendName4' AND receiver_name='$username'") or die('query failed');
  $friendQuery = mysqli_query($conn, "SELECT id FROM `player` WHERE username='$friendName4'") or die('query failed');
  $friendIDQuery = mysqli_fetch_assoc($friendQuery);
  $friendID = $friendIDQuery['id'];
  $insertQuery = mysqli_query($conn, "INSERT INTO `friends` (id, username, friend_username) VALUES ('$user_id','$username', '$friendName4')") or die('query failed');
  $reverseInsertQuery = mysqli_query($conn, "INSERT INTO `friends` (id, username, friend_username) VALUES ('$friendID','$friendName4', '$username')") or die('query failed');
  
  if ($insertQuery && $reverseInsertQuery) {
     header("Location: search.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}

// This php code is responsible for rejecting the game challenge
if (isset($_POST['reject_game_request'])) {
  $friendName5 = $_POST['reject_game_request'];
  
  $rejectQuery = mysqli_query($conn, "DELETE FROM `game_requests` WHERE sender_name='$friendName5' AND receiver_name='$username'") or die('query failed');
 
  if ($rejectQuery) {
     header("Location: friend.php");
	} else {
		echo "<script>alert('Failed to reject challenge. Please try again.');</script>";
	}
}


?>
