<?php

session_start();
$user_id = $_SESSION['player']['id'];

   global $conn;
   $conn = mysqli_connect('localhost','root','','otp1');
   
if(isset($_POST['update_info'])){

   if(!empty($_POST['update_pass'])){

	$old_pass = $_POST['old_pass'];
	$update_pass = mysqli_real_escape_string($conn, password_hash($_POST['update_pass'], PASSWORD_DEFAULT));
	$new_pass = mysqli_real_escape_string($conn, password_hash($_POST['new_pass'], PASSWORD_DEFAULT));
	$confirm_pass = mysqli_real_escape_string($conn, password_hash($_POST['confirm_pass'], PASSWORD_DEFAULT));

	if(!empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])){
		if(!password_verify($_POST['update_pass'], $old_pass)){
			echo '<script>alert("Please enter your current password correctly")</script>';
		}elseif(trim($_POST['new_pass']) != trim($_POST['confirm_pass'])){
			echo '<script>alert("New passwords do not match :(")</script>';
		}else{
			mysqli_query($conn, "UPDATE `player` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
			echo '<script>alert("Password updated successfully! :)")</script>';
		}
	} else{
		echo '<script>alert("Please fill out both fields")</script>';
	}

		
	} else{
		echo '<script>alert("Please confirm current password")</script>';
	}
   
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
					<input type="hidden" name="old_pass" value="<?php echo $user['password']; ?>">				
					<label> Current Password: </label>
					<input type="password" id="password" value="" name="update_pass">
				</div>
				<div class="input-group"> 
					<label> New Password: </label>
					<input type="password" id="new_password" value="" name="new_pass">
				</div>
				<div class="input-group"> 
					<label> Confirm New Password: </label>
					<input type="password" id="confirm_password" value="" name="confirm_pass">
				</div>
				<div class="input-group"> 
					<button type="submit" class="btn" name="update_info"> Update Password </button>
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
