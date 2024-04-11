<?php 

require_once("functions.php");

global $conn;

// This is the search query inputted into the search bar (the player that we're searching for)

// These are the corresponding MySQL commands

$user_id = $_SESSION['player']['id'];
$username = $_SESSION['player']['username'];

?>

<!DOCTYPE html>
<!-- // Header of the HTML section, includding the CSS stylesheets and JavaScript files -->
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
	
	<!-- // This is the ubiquotous Navigation Bar of our website, containing the logo and buttons -->
	<header class="main-header">
		<div href="/" class="brand-logo" >
			<a href="homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="search-nav">
   
       <div class="search-container">
       <form method="POST">
           <!-- // Here you can search for a specific user across the globe -->
          <input type="search"  name="search_username" placeholder="Search username..."> 
          <button type="submit"></button>
        </form>
       </div>
				
		</nav>
   <a href="login.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a>
	</header>
	
	
	<!-- // Shows the friends icon and blob regarding challenging your friends -->
	<section class="join-main-section">
		
		<div href="/" class="left-join-friends-section" >
			<img src="global-search.png" alt="Global Search :)">
			
			<h1> Connect with your <br>    friends all across <br>    the globe </h1> 
			<br>
			<h3>  Go back <a href="friends.php" > <i class="fa-solid fa-left-from-line"></i>... </a></h3>
		</div>
		
  <!--	// Displays the friend list ie all the players a player is friends with!-->
		<div class="friends-container">
            <div class="update-aesthetic-image-container"> </div>
			    <h1> Search Results </h1>
			
					<?php	
                
          
                
         if (isset($_POST["search_username"])) {
            $searchQuery = $_POST["search_username"];
            $select = mysqli_query($conn, "SELECT * FROM `player` WHERE username = '$searchQuery'") or die('query failed');
          

					if ($select && mysqli_num_rows($select) > 0) {
					// Display the user's friends in rows 
          // Also prints the html and css code for the buttons and text
          
          echo "<div class='friend-input-group'>";
					while ($row = mysqli_fetch_assoc($select)) {
						$friendName = $row['username'];
            $message = "Add friend";  
            $request_sent = mysqli_query($conn, "SELECT sender_name, receiver_name FROM `friend_requests` WHERE sender_name='$username' AND receiver_name='$friendName'") or die('query failed');
            $is_friend = mysqli_query($conn, "SELECT username, friend_username FROM `friends` WHERE username='$username' AND friend_username='$friendName'") or die('query failed');
            
            // This if statement checks if you've already sent a friend request to the player you searched
            if (mysqli_num_rows($request_sent) > 0) {
              echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName </span> </h3> </div> <div><button class='btn'> Request sent </button></form></div>";
					    echo "</div>";
          } 
            // This elseif checks whether you are already firends with said player
            elseif (mysqli_num_rows($is_friend) > 0) {
              echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName </span> </h3> </div> <div><button class='btn'> Friend </button></form></div>";
					    echo "</div>";
                                   
          } 
            // If you search yourself then you can click on a button to be redirected to your profile page
            elseif ($username == $friendName) {
              echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName </span> </h3> </div> <div><form action='profile-page.php'><button type='submit' class='btn'> My profile </button></form></div>";
					    echo "</div>";
          
          }
            // In this case you are not friends and you haven't yet sent a request to the user in question, hence the option to Add friend is displayed
             else {
              echo "<div class='see-friendlist'>";
							echo "<div> <h3> <span class='profile-accent-text'> $friendName </span> </h3> </div> <div><form method='POST'> <input type='hidden' name='add_friend' value='$friendName'><button type='submit' class='btn'> Add Friend </button></form></div>";
					    echo "</div>";
          }
					echo "</div>";
            }  
               }
            // If the program reaches this point it means the player does not exist on our platform.   
           else {
             echo "<h3> <span class='profile-accent-text'> No player found :( </span> </h3>";
           }
             }
           
           ?>
         <!-- // Here we display the requests we've received from other players -->   
         <h1 style="margin-top: 0"> My Requests </h1>
         
         <?php	
         
         $select2 = mysqli_query($conn, "SELECT * FROM `friend_requests` WHERE receiver_name = '$username'") or die('query failed');
					if ($select2) {
					// Display the friend requests the user has received from other players 
          // Also prints the html and css code for the buttons and text
          echo "<div class='friend-input-group'>";
					while ($row1 = mysqli_fetch_assoc($select2)) {
						$friendName2 = $row1['sender_name'];
              echo "<div class='see-friendlist'>";
							echo  "<div> <h3> <span class='profile-accent-text'> $friendName2 </span> </h3> </div>
                      <div class='accept-reject'>
                        <div>
                         <form method='POST'> 
                           <input type='hidden' name='accept_friend_request' value='$friendName2'>
                           <button type='submit' class='btn'> Accept </button>
                         </form>
                        </div>
                       <div>
                         <form method='POST'>
                           <input type='hidden' name='reject_friend_request' value='$friendName2'>
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

	<!-- // This is the ubiquotous footer of our website, acknowledging the creators -->
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

if (isset($_POST['add_friend'])) {
	$friendName3 = $_POST['add_friend'];
 
  
	$insert = mysqli_query($conn, "INSERT INTO `friend_requests` (sender_name, receiver_name) VALUES ('$username', '$friendName3')") or die('query failed');
	if ($insert) {
		echo "<script>alert('Friend request sent successfully.');</script>";
     header("Location: search.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}

if (isset($_POST['accept_friend_request'])) {
  $friendName4 = $_POST['accept_friend_request'];
  
  $acceptQuery = mysqli_query($conn, "DELETE FROM `friend_requests` WHERE sender_name='$friendName4' AND receiver_name='$username'") or die('query failed');
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


if (isset($_POST['reject_friend_request'])) {
  $friendName5 = $_POST['reject_friend_request'];
  
  $rejectQuery = mysqli_query($conn, "DELETE FROM `friend_requests` WHERE sender_name='$friendName5' AND receiver_name='$username'") or die('query failed');
 
  if ($rejectQuery) {
     header("Location: search.php");
	} else {
		echo "<script>alert('Failed to add friend. Please try again.');</script>";
	}
}
?>
