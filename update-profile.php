<?php

session_start();
$user_id = $_SESSION['player']['id'];

   global $conn;
   $conn = mysqli_connect('localhost','root','','otp1');
   
if(isset($_POST['update_info'])){
	
   $update_name = mysqli_real_escape_string($conn, $_POST['username']);
   $update_email = mysqli_real_escape_string($conn, $_POST['email']);

   //updates database with new username and email
   mysqli_query($conn, "UPDATE `player` SET username = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   header("Location: profile-page.php");
   
}

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
  <title>insert cool group name - login </title>
</head>

<body class="full-height-grow">
	<div class="container full-height-grow">
	<header class="main-header">
		<div class="brand-logo">
			<a href="homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="homepage.php"> Play Now </a> </li>
				<li> <a href="#"> Spectate </a> </li>
				<li> <a href="#"> Game History </a> </li>
				<li> <a href="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>
	
	<section class="join-main-section"> 
		<?php
			global $conn;
			$select = mysqli_query($conn, "SELECT * FROM `player` WHERE id = '$user_id'") or die('query failed');
			if(mysqli_num_rows($select) > 0){
				$user = mysqli_fetch_assoc($select);
			}
		?>
		
		<div href="/" class="left-join-section" >
		
			<img src="profile-icon.png" alt="Profile Pic :)">
			<h1> 
				<?= htmlspecialchars($user["username"]) ?> <span class="material-icons" style="color: rgb(26, 103, 203);">verified</span><br>
			</h1>
			<h3> Certified Grandmaster </h3> 
			<br>
		
			<h3>  Go back <a href="profile-page.php" > <i class="fa-solid fa-left-from-line"></i>... </a></h3>
		
			
			
		</div>
		
		<div class="update-container">
            <div class="update-aesthetic-image-container">
				
			</div>
			<h1> Profile </h1>
			
			<form method="POST" class="update-info-container" action="">
				<?php
					if(isset($message)){
						foreach($message as $message){
							echo '<div class="subtitle">'.$message.'</div>';
						}
					}
				?>
				<div class="input-group"> 
					<label> Username: </label>
					<input type="text" id="username" value="<?= htmlspecialchars($user["username"]) ?>" name="username">
				</div>
				<div class="input-group"> 
					<label> Email: </label>
					<input type="text" id="email" value="<?= htmlspecialchars($user["email"]) ?>" name="email">
				</div>
				<div class="input-group"> 
					<button type="submit" class="btn" name="update_info"> Update info </button>
				</div>
			</form>			
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


	<script>
function myFunction() {
  alert("I am an alert box!");
}
</script>

</body>
</html>
