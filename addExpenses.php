<?php
session_start();
$userId = $_SESSION['userId'];
$defaultCategory = array("Clothing","Education","Entertainment","Food","Medicine","Rent","Others");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/addExpenses.css">
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
				<div class="addExpenses-wrapper">
					<label>
						Add Expenses
					</label>
					<div class="expense-wrapper">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="expense-wrapper-firstRow">
								<div class="expense-wrapper-firstColumn">
									<div class="expense-element">
										<label for="expense">
											Enter Expense
										</label>
										<input type="number" name="expense" id="expense" min="1" required>
									</div>
									<div class="expense-element">
										<label for="expenseDate">
											Enter Date
										</label>
										<input type="date" name="expenseDate" id="expenseDate">
									</div>
									<div class="expense-element">
										<label for="expenseDescription">
											Enter Description
										</label>
										<textarea name="expenseDescription" id="expenseDescription"></textarea>
									</div>
									<div class="expense-element">
										<label for="image">
											Upload Image
										</label>
										<input type="file" name="file" id="file" accept="image/*">
									</div>
									<div class="expense-element">
										<button name="submit" value="submit">
											Submit
										</button>
									</div>
								</div>
								<div class="expense-wrapper-secondColumn">
									<div class="expense-element radio">
										<label for="expenseCategory">
											Choose Category :
										</label>
										<div class="expense-element-category">
											<?php
											foreach($defaultCategory as $cat) { ?>
												<div class="radio-element">
													<input type="radio" name="category" value="<?=$cat;?>" id="<?=$cat;?>" required>
													<label for="<?=$cat;?>"><?=$cat;?></label>
												</div>
											<?php } 

											$userCategory = mysqli_query($con," SELECT `category` FROM `category` WHERE `user_id` = '$userId' GROUP BY `category` ASC");
											while($a = mysqli_fetch_assoc($userCategory)) { ?>
												<div class="radio-element">
													<input type="radio" name="category" value="<?=$a['category'];?>" id="<?=$a['category'];?>">
													<label for="<?=$a['category'];?>"><?=$a['category'];?></label>
												</div>
											<?php }
											?>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div class="category-input">
							<label>
								Add Custom Categories
							</label>
							<form action="" method="POST">
								<input type="text" name="userCategory" required>
								<button name="addCategory" value="addCategory">
									Add Category
								</button>
							</form>
							<?php
							if(isset($_POST['addCategory'])) {
								$category = ucfirst(htmlspecialchars(trim($_POST['userCategory'])));
								$categoryQuery = mysqli_query($con," INSERT INTO `category` (`user_id`,`category`) VALUES ('$userId','$category')");
								?>
								<script>
									location.replace("addExpenses.php");
								</script>
							<?php }
							?> 
						</div>
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
		$expense = htmlspecialchars(trim($_POST['expense']));
		$expenseDate = htmlspecialchars(trim($_POST['expenseDate']));
		$expenseDescription = ucfirst(htmlspecialchars(trim($_POST['expenseDescription'])));
		$userId = $_SESSION['userId'];
		$category = htmlspecialchars(trim($_POST['category']));


		$name = $_FILES['file']['name'];
		$target_dir = "uploads/expenses/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Upload file
		move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);

			// $imageData = $file_get_contents($_FILES['image']['tmp_name']);
		$expenseInsertQuery = "INSERT INTO `expense` (`user_id`,`category`,`expense`,`date`,`description`,`image`) VALUES ('$userId','$category','$expense','$expenseDate','$expenseDescription','$name')";
		$expenseInsert = mysqli_query($con,$expenseInsertQuery);
		if($expenseInsert) { ?>
			<script>
				location.replace("addExpenses.php");
			</script>
		<?php } else {
			echo "Expense Insertion Failed";
		}
	}
	?>

</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/restrictFutureDate.js"></script>
</html>