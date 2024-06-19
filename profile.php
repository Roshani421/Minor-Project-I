<?php
require_once 'dbCon.php';
session_start();
$userId = $_SESSION['userId'];
$profilePath = $_SESSION['profilePath'];
$recordQuery = mysqli_query($con," SELECT * FROM `user` WHERE `user_id` = '$userId' ");
$record = mysqli_fetch_row($recordQuery);
$email = $record[3];
$firstName = $record[1];
$lastName = $record[2];
$password = $record[4];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/profile.css">
<link rel="stylesheet" type="text/css" href="FONTS/fontAwesome/css/all.css">
<body>
	<?php

	if($_SESSION['loggedIn'] === true) { ?>

		<div class="body-container">
			<?php
			include('bodyLeftContainer.php'); 
			?>
			<div class="body-right-container">
				<div class="slide-bar">
					<i id="slideBar" class="fa fa-bars"></i>
				</div>
				<?php
				include('slideAndDashboard.php');
				?>
				<div class="profile-container">
					<label>
						Update Details
					</label>
					<div class="profile-wrapper">
						<div class="form-wrapper">
							<form action="" method="POST" id="signUpForm">
								<div class="form-element">
									<label for="firstName">
										First Name
									</label>
									<input type="text" id="firstName" name="firstName" value="<?=$firstName?>">
									<small>Error Message</small>
								</div>
								<div class="form-element">
									<label for="lastName">
										Last Name
									</label>
									<input type="text" id="lastName" name="lastName" value="<?=$lastName?>">
									<small>Error Message</small>

								</div>
								<div class="form-element">
									<label for="email">
										Email
									</label>
									<input type="email" id="email" name="email" value="<?=$email?>">
									<small>Error Message</small>

								</div>
								<div class="form-element">
									<label for="password">
										Enter Password To Continue
									</label>
									<input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[\W|_])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter and special character" minlength="6">
									<small>Error Message</small>
								</div>
								<div class="form-element">
									<input type="submit" name="update" value="Update">
								</div>
							</form>
						</div>
						<div class="image-update">
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-element">
									<img src="UPLOADS/PROFILE/<?=$profilePath?>">
									<input type="file" name="file" id="file" accept="image/*">
								</div>
								<div class="form-element">
									<button name="fileUpdate" value="Update Image">
										Update Image
									</button>
								</div>
							</form>
						</div>
						<div class="change-password">
							<form action="" method="POST" id="passwordForm">
								<div class="form-element">
									<label for="password">
										New Password
									</label>
									<input type="password" id="newPassword" name="newPassword"  pattern="(?=.*\d)(?=.*[\W|_])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter and special character" minlength="6">
									<small>Error Message</small>
								</div>
								<div class="form-element">
									<label for="confirmPassword">
										Confirm New Password
									</label>
									<input type="password" id="confirmPassword" name="confirmPassword"  pattern="(?=.*\d)(?=.*[\W|_])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter and special character" minlength="6">
									<small>Error Message</small>
								</div>
								<div class="form-element">
									<label for="oldPassword">
										Old Password
									</label>
									<input type="password" id="oldPassword" name="oldPassword">
									<small>Error Message</small>
								</div>
								<div class="form-element">
									<input type="submit" name="change" value="Update">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } ?>
	<?php
	if(isset($_POST["update"])) {
		$newEmail = htmlspecialchars($_POST['email']);
		$newFirstName = htmlspecialchars($_POST['firstName']);
		$newLastName = htmlspecialchars($_POST['lastName']);
		$getPassword = htmlspecialchars($_POST['password']);
		
		if(password_verify($getPassword, $password)) {
			$updateQuery = mysqli_query($con, " UPDATE `user` SET `email`='$newEmail', `first_name`='$newFirstName', `last_name`='$newLastName' WHERE `user_id`='$userId' ");
			$_SESSION['userFirstName'] = $newFirstName;
			$_SESSION['userLastName'] = $newLastName;
			$_SESSION['userEmail'] = $newEmail;
			?>
			<script>
				location.replace('index.php');
			</script>
			<?php
		} else {
			?>
			<script>
				var parent = document.getElementById('confirmPassword').parentElement;
				parent.querySelector('small').innerText = "Failed to Update the Password";
				parent.className = "form-element update-error";
			</script>
			<?php
		}
	}
	?>
	<?php
	if(isset($_POST['fileUpdate'])) {

		$name = $_FILES['file']['name'];
		$target_dir = "UPLOADS/PROFILE/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
		$extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
		if (in_array($imageFileType, $extensions_arr)) {

        // Upload file
			move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);

			// $imageData = $file_get_contents($_FILES['image']['tmp_name']);
			$imageInsertQuery = "UPDATE `user` SET `profile_path`='$name' WHERE `user_id`='$userId' ";
			$imageInsert = mysqli_query($con,$imageInsertQuery);
			$_SESSION['profilePath'] = $name;

			if($imageInsert) { ?>
				<script>
					location.replace("profile.php");
				</script>
			<?php } else {
				echo "Image Insertion Failed";
			}
		} else { ?>
			<script>
				alert("Invalid Extension. USE 'JPG','JPEG','PNG','GIF' " );
			</script>
		<?php }
	} ?>
	<?php
	if(isset($_POST['change'])) {
		$confirmPassword = $_POST['confirmPassword'];
		$oldPassword = $_POST['oldPassword'];
		
		if(password_verify($oldPassword, $password)) {
			$encryptedPassword = password_hash($confirmPassword, PASSWORD_BCRYPT);
			$passwordInsertQuery = mysqli_query($con, " UPDATE `user` SET `password` = '$encryptedPassword' WHERE `user_id` = '$userId' ");
			if($passwordInsertQuery) { ?>
				<script>
					location.replace("profile.php");
				</script>
			<?php } else {
				echo "Failed To Update the Password";
			}
		} else {
			?>
			<script>
				var parent = document.getElementById('oldPassword').parentElement;
				parent.querySelector('small').innerText = "Incorrect Password!!!";
				parent.className = "form-element update-error";
			</script>
			<?php
		}
	}
	?>
</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/updateProfile.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
</html>