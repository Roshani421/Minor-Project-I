<?php
	session_start();
	unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Login Page
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/login.css">
</head>
<body>
	<?php 
		require_once('dbCon.php');

		//checks if Login buttons is clicked or not
		if(isset($_POST['login'])) {

			//retrieve values from form
			$email = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST['password']);

			//query to search email in user
			$emailQuery = " SELECT * FROM `user` WHERE `email` = '$email' ";

			//query search for email in database
			$emailSearch = mysqli_query($con,$emailQuery);

		if(mysqli_num_rows($emailSearch)) {

				//returns associative array with data of respective row of email in DB
				$recordPointer = mysqli_fetch_assoc($emailSearch);
				//retrives password from database through associative array
				$dbPassword = $recordPointer['password'];

				//validates entered password and hashed password in database
				//password_verify($password, $dbPassword)
				if(password_verify($password, $dbPassword)) {

					//sets session
					$_SESSION['loggedIn'] = true;
					$_SESSION['userFirstName'] = $recordPointer['first_name'];
					$_SESSION['userLastName'] = $recordPointer['last_name'];
					$_SESSION['userEmail'] = $recordPointer['email'];
					$_SESSION['userId'] = $recordPointer['user_id'];
					$_SESSION['profilePath'] = $recordPointer['profile_path'];
				?>
					<script>
						location.replace("index.php");
					</script>
				<?php } else {
					$_SESSION['error'] = "Incorrect Password !!!";
				}
			} else { 
				$_SESSION['error'] = "Account Doesn't Exists !!!";
			} 
	} ?>
	<div id="bodyContainer">
		<div id="leftContainer">
			
		</div>
		<div id="formContainer">
			<form action="" method="POST">
				<div class="login-body">	
					<div class="login-elements login-header">
						Login
					</div>
					<div <?php if(isset($_SESSION['error'])){
						?> class = "errorMsg" <?php 
					} ?>  >
						<?php 
							if(isset($_SESSION['error'])) {
								echo $_SESSION['error'];
							}
						?>
					</div>
					<div class="login-elements">
						<label for="email">
							Email
						</label>
						<input <?php if(isset($_SESSION['error']) && ($_SESSION['error']=="Account Doesn't Exists !!!")) { ?> style="border:2px solid red;" <?php } ?>
						type="email" name="email" id="email" placeholder="mail@website.com" required <?php if(isset($_POST['email'])){
						?> value = <?php echo $_POST['email']; } ?> >
					</div>		
					<div class="login-elements">
						<label for="password">
							Password
						</label>
						<input <?php if(isset($_SESSION['error']) && ($_SESSION['error']=="Incorrect Password !!!")) { ?> style="border:2px solid red;" <?php } ?>
						type="password" name="password" id="password" placeholder="Enter your Password" required <?php if(isset($_POST['password'])){
						?> value = <?php echo $_POST['password']; 
					} ?>  >				
					</div>
					<div class="flex-row">
						<input type="checkbox" id="showPassword">
						<label for="showPassword">
							Show Password
						</label> 	
					</div>
					
					<div class="login-elements">
						<button name="login" value="login">
							Login
						</button>
					</div>
					<div class="login-elements sign-up">
						Don't Have an Account? <a href="signUp.php">Create Here</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">

	var showPassword = document.getElementById('showPassword');
	var password =  document.getElementById('password');
	showPassword.addEventListener('change',() => {
		if(showPassword.checked) {
			password.type = 'text';
		} else {
			password.type = 'password';
		}
	});
	//snippet from stackoverflow to prevent auto submission of form after refresh
    if ( window.history.replaceState ) {
    	window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>