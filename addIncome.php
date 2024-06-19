<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/addIncome.css">
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
				<div class="addIncome-wrapper">
					<label>
						Add Income
					</label>
					<div class="income-wrapper">
						<form action="" method="POST">
							<div class="income-element">
								<label for="income">
									Enter Income
								</label>
								<input type="number" name="income" id="income" min="1" required>
							</div>
							<div class="income-element">
								<label for="incomeDate">
									Enter Date
								</label>
								<input type="date" name="incomeDate" id="incomeDate">
							</div>
							<div class="income-element">
								<label for="incomeDescription">
									Enter Description
								</label>
								<textarea name="incomeDescription" id="incomeDescription"></textarea>
							</div>							
							<button name="submit" value="submit">
								Submit
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } 
	if(isset($_POST['submit'])) {
		$income = htmlspecialchars(trim($_POST['income']));
		$incomeDate = htmlspecialchars(trim($_POST['incomeDate']));
		$incomeDescription = ucfirst(htmlspecialchars(trim($_POST['incomeDescription'])));
		$userId = $_SESSION['userId'];
		$incomeInsertQuery = "INSERT INTO `income` (`user_id`,`income`,`date`,`description`) VALUES ('$userId','$income','$incomeDate','$incomeDescription')";
		$incomeInsert = mysqli_query($con,$incomeInsertQuery);
		if($incomeInsert) { ?>
			<script>
				location.replace("addIncome.php");
			</script>
		<?php } else {
			echo "Income Insertion Failed";
		}
	}
	?>

</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/restrictFutureDate.js"></script>

</html>