<?php
session_start();
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Sign Up Page
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/signUp.css">
</head>
<body>
	<?php
		//connect to database
	require_once("dbCon.php");

		//checks if signUp button is clicked or not
	if(isset($_POST['signUp'])) {

			//retrives value from form
		$fname = htmlspecialchars($_POST['fname']);
		$lname = htmlspecialchars($_POST['lname']);
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$cpassword = htmlspecialchars($_POST['cpassword']);
		$profilePath = 'default_profile.png';

			//validates password and confirm password
		if($password === $cpassword) {

				//query for search email
			$emailQuery = " SELECT * FROM `user` WHERE `email` = '$email' ";

				//query search for email in database
			$emailSearch = mysqli_query($con,$emailQuery);

				//returns the no.of rows where email is found i.e returns 1 if email is found in DB
			if(mysqli_num_rows($emailSearch) == 0) {

					//hashing the password
				$hPassword = password_hash($password, PASSWORD_BCRYPT);

					//query to enter data in database
				$insertQuery = " INSERT INTO `user` (`first_name`,`last_name`,`email`,`password`,`profile_path`) VALUES ('$fname','$lname','$email','$hPassword','$profilePath') " ;

					//entering data in database
				$insert = mysqli_query($con,$insertQuery);

				if($insert) { ?>
					<script>
						location.replace("login.php");
					</script>
				<?php } else {
					$_SESSION['error'] = "Account Creation Failed !!!";
				}
			} else { 
				$_SESSION['error'] = "Account Already Exits!!!";
			}
		} else {
			$_SESSION['error'] = "Entered Passwords Didn't Match!!!";   
		}
	}
	?>

	<div id="bodyContainer">
		<div id="leftContainer">
			
		</div>
		<div id="formContainer">
			<form action="" method="POST">
				<div class="signUp-body">
					<div class="signUp-elements signUp-header">
						Sign Up
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
				<div class="signUp-elements">
					<label for="fname">
						First Name
					</label>
					<input type="text" name="fname" id="fname" pattern="[^0-9]*" title="Name cannot contain number" required <?php if(isset($_POST['fname'])){
						?> value = <?php echo $_POST['fname']; 
					} ?>  >
				</div>
				<div class="signUp-elements">
					<label for="lname">
						Last Name
					</label>
					<input type="text" name="lname" id="lname" pattern="[^0-9]*" required <?php if(isset($_POST['lname'])){
						?> value = <?php echo $_POST['lname']; 
					} ?>  >
				</div>
				<div class="signUp-elements">
					<label for="email">
						Email
					</label>
					<input <?php if(isset($_SESSION['error']) && ($_SESSION['error']=="Account Already Exits!!!")) { ?> style="border:2px solid red;" <?php } ?>
					type="email" name="email" id="email" required <?php if(isset($_POST['email'])){
						?> value = <?php echo $_POST['email']; 
					} ?>  >
				</div>		
				<div class="signUp-elements">
					<label for="password">
						Password
					</label>
					<input <?php if(isset($_SESSION['error']) && ($_SESSION['error']=="Entered Passwords Didn't Match!!!")) { ?> style="border:2px solid red;" <?php } ?>
					type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[\W|_])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter and special character" minlength="6" required <?php if(isset($_POST['password'])){
						?> value = <?php echo $_POST['password']; 
					} ?>  >
				</div>
				<div class="signUp-elements">
					<label for="cpassword">
						Confirm Password
					</label>
					<input <?php if(isset($_SESSION['error']) && ($_SESSION['error']=="Entered Passwords Didn't Match!!!")) { ?> style="border:2px solid red;" <?php } ?>
					type="password" name="cpassword" id="cpassword" required <?php if(isset($_POST['cpassword'])){
						?> value = <?php echo $_POST['cpassword']; 
					} ?>  >
				</div>
				<div class="signUp-elements">
					<button name="signUp" value="signUp">
						Sign Up
					</button>
				</div>
				<div class="signUp-elements login">
					Already Have an Account? <a href="login.php">Login Here</a>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
</html>