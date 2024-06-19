<?php
session_start();
require_once 'dbCon.php';
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
	if($_SESSION['loggedIn'] === true) {
		if(isset($_GET['update'])) {
			$incomeId = $_GET['update'];
			$incomeQuery = mysqli_query($con," SELECT * FROM `income` WHERE `income_id` = '$incomeId' ");
			$incomeQueryResult = mysqli_fetch_row($incomeQuery);
			?>

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
							Update Income
						</label>
						<div class="income-wrapper">
							<form action="" method="POST">
								<div class="income-element">
									<label for="income">
										Enter Income
									</label>
									<input type="number" name="income" id="income" min="1" value="<?=$incomeQueryResult[2]?>" required>
								</div>
								<div class="income-element">
									<label for="incomeDate">
										Enter Date
									</label>
									<script>console.log("data=<?=$incomeQueryResult[3]?>")</script>
									<input type="date" name="incomeDate" id="incomeDate" value="<?=$incomeQueryResult[3]?>">
								</div>
								<div class="income-element">
									<label for="incomeDescription">
										Enter Description
									</label>
									<textarea name="incomeDescription" id="incomeDescription"><?=$incomeQueryResult[4]?></textarea>
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
				location.replace("manageIncome.php");
			</script>
		<?php }
	} else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php }
	if(isset($_POST['submit'])) {
		$income = htmlspecialchars(trim($_POST['income']));
		$incomeDate = htmlspecialchars(trim($_POST['incomeDate']));
		$incomeDescription = htmlspecialchars(trim($_POST['incomeDescription']));
		$incomeUpdateQuery = " UPDATE `income` SET `income`='$income',`date`='$incomeDate',`description`='$incomeDescription' WHERE `income_id`='$incomeId' ";
		$incomeInsert = mysqli_query($con,$incomeUpdateQuery);
		if($incomeInsert) { ?>
			<script>
				location.replace("manageIncome.php");
			</script>
		<?php } else {
			echo "Income Updation Failed";
		}
	}
	?>

</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/restrictFutureDate.js"></script>

</html>