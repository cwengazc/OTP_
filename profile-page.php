<?php
	require_once("functions.php")
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
		<div class="brand-logo" >
			<a href="homepage.php"> <img src="logo.png"> </a>
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="homepage.php"> Play Now </a> </li>
				<li> <a href="friend.php"> Friends </a> </li>
				<li> <a href="/prevgames/html.php"> Game History </a> </li>
				<li> <a href="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i> </a> </li>				
			</ul>
		</nav>
	</header>
	
	
	<!-- Shows the profile icon and name, you also have the option to update your details & credentials here-->
	<section class="join-main-section"> 
		
		<?php
			global $conn;
			$user_id = $_SESSION['player']['id'];
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
		
			<h3>  Edit info <a href="update-profile.php" ><i class="fa-solid fa-pen-to-square"></i> ... </a></h3>
			<h3>  Change Password <a href="update-password.php" ><i class="fa-solid fa-pen-to-square"></i> ... </a></h3>
		</div>
		
		<!-- Displays the actual details of the currently logged in user -->
		<div class="profile-container">
            <div class="update-aesthetic-image-container">
				
			</div>
			<h1> Profile </h1>
			
			<form class="profile-info-container">
				<div class="input-group"> 
					<label> Username:  <span class="profile-accent-text"> <?= htmlspecialchars($user["username"]) ?> </span> </label>
					
				</div>
				<div class="input-group"> 
					<label> Email: <span class="profile-accent-text"> <?= htmlspecialchars($user["email"]) ?> </span> </label>
					
				</div>
				<div class="input-group"> 
					<label> Current Password: <span class="profile-accent-text"> ******** </span> </label>
					
				</div>
			</form>			
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
