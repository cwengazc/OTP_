<?php 
session_start();
$error = array();

require "mail.php";

	if(!$con = mysqli_connect("localhost","root","","otp")){

		die("could not connect");
	}

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "The code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: login.html");
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $con;

		$expire = time() + (60 * 5);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($con,$query);

		//send email here
		send_mail($email,'OTP: Password Reset',"Your password reset code is " . $code);
	}
	
	function save_password($password){
		
		global $con;

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update player set password = '$password' where email = '$email' limit 1";
		mysqli_query($con,$query);

	}
	
	function valid_email($email){
		global $con;

		$email = addslashes($email);

		$query = "select * from player where email = '$email' limit 1";		
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($code){
		global $con;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "The code is correct";
				}else{
					return "The code has expired";
				}
			}else{
				return "The code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
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
		<div href="index.html" class="brand-logo" >
			<img src="logo.png">
		</div>
		<nav class="main-nav">
			<ul>
				<li> <a href="login.html"> Login </a> </li>				
			</ul>
		</nav>
	</header>

	<section class="join-main-section"> 
		
		<div href="/" class="left-join-section" >
			
			<img src="padlock.png" alt="Profile Pic :)">
			<h1> 
					Follow the prompts to regain <br> access to your <span> </span> realm.
			</h1>
			<br>
			
		</div>
		
		<div class="update-container">
            <div class="update-aesthetic-image-container">
				
			</div>
			
			<h1>Forgot Password</h1>
			<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
						<form method="post" class="update-info-container" action="forgot.php?mode=enter_email"> 
							
							
							<span style="font-size: 2rem;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<div  class="input-group">
								<label> Enter your email below </label>
								<input type="email" name="email" placeholder="Email"> 
							</div>
					
							<div class="input-group">
								<button type="submit" value="" class="btn"> Next </button> 
							</div>
							
							<div><a href="login.html">Login</a></div>
						</form>
					<?php				
					break;

				case 'enter_code':
					// code...
					?>
						<form method="post"  class="update-info-container" action="forgot.php?mode=enter_code"> 
							
							<span style="font-size: 2rem;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<div  class="input-group">
								<label> Enter your the code sent to your email </label>
								<input type="text" name="code" placeholder="12345"> 
							</div>
							
							<div  class="input-group"> 
								<button type="submit" value="Next" class="btn"> Next </button>
							</div>
							
							<div class="input-group">
								<button type="button" value="Start Over" class="btn"> <a href="forgot.php"> Start Over </a> </button> 
							</div>
							
							<div><a href="login.html">Login</a></div>
						</form>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						<form method="post" class="update-info-container" action="forgot.php?mode=enter_password"> 
							
							<span style="font-size: 2rem;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<div class="input-group">
								<label> Enter your new password </label>
								<input type="text" name="password" placeholder="Password">
							</div>
							
							<div class="input-group">	
								<input type="text" name="password2" placeholder="Retype Password">
							</div>
							
							<div class="input-group">	
								<button type="submit" value="Next" class="btn"> Next </button>
							</div>
							
							<div class="input-group">	
								<a href="forgot.php">
									<button type="button" class="btn" value="Start Over"> Start Over </button>
								</a>
							</div>
							
							<div><a href="login.html">Login</a></div>
						</form>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>
		
		
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
