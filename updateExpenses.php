<?php
session_start();
require_once 'dbCon.php';
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

	if($_SESSION['loggedIn'] === true) {
		if(isset($_GET['update'])) {
			$expenseId = $_GET['update'];
			$expenseQuery = mysqli_query($con," SELECT * FROM `expense` WHERE `expense_id` = '$expenseId' ");
			$expenseQueryResult = mysqli_fetch_row($expenseQuery);
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
					<div class="addExpenses-wrapper">
						<label>
							Update Expenses
						</label>
						<div class="expense-wrapper">
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="expense-wrapper-firstRow">
									<div class="expense-wrapper-firstColumn">
										<div class="expense-element">
											<label for="expense">
												Enter Expense
											</label>
											<input type="number" name="expense" id="expense" min="1" value="<?=$expenseQueryResult[3]?>" required>
										</div>
										<div class="expense-element">
											<label for="expenseDate">
												Enter Date
											</label>
											<input type="date" name="expenseDate" id="expenseDate" value="<?=$expenseQueryResult[4]?>" >
										</div>
										<div class="expense-element">
											<label for="expenseDescription">
												Enter Description
											</label>
											<textarea name="expenseDescription" id="expenseDescription"><?=$expenseQueryResult[5]?> </textarea>
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
														<input type="radio" name="category" value="<?=$cat;?>" id="<?=$cat;?>" <?php if(ucfirst($cat) == ucfirst($expenseQueryResult[2])){ ?> checked <?php } ?> required>
														<label for="<?=$cat;?>"><?=$cat;?></label>
													</div>
												<?php } 

												$userCategory = mysqli_query($con," SELECT `category` FROM `category` WHERE `user_id` = '$userId' GROUP BY `category` ASC");
												while($a = mysqli_fetch_assoc($userCategory)) { ?>
													<div class="radio-element">
														<input type="radio" name="category" value="<?=ucfirst($a['category']);?>" id="<?=ucfirst($a['category']);?>" <?php if(ucfirst($a['category']) == ucfirst($expenseQueryResult[2])){ ?> checked <?php } ?>>
														<label for="<?=ucfirst($a['category']);?>"><?=ucfirst($a['category']);?></label>
													</div>
												<?php }
												?>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<script>
				location.replace("manageExpenses.php");
			</script>
		<?php }
	} else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php }

	if(isset($_POST['submit'])) {
		$expense = htmlspecialchars(trim($_POST['expense']));
		$expenseDate = htmlspecialchars(trim($_POST['expenseDate']));
		$expenseDescription = ucfirst(htmlspecialchars(trim($_POST['expenseDescription'])));
		$category = htmlspecialchars(trim($_POST['category']));


		$name = $_FILES['file']['name'];
		$target_dir = "uploads/expenses/";
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
			$expenseUpdateQuery = " UPDATE `expense` SET `expense`='$expense',`date`='$expenseDate',`description`='$expenseDescription',`category`='$category',`image`='$name' WHERE `expense_id`='$expenseId' ";
			$expenseUpdate = mysqli_query($con,$expenseUpdateQuery);
			if($expenseUpdatee) { ?>
				<script>
					location.replace("addExpenses.php");
				</script>
			<?php } else {
				echo "Expense Insertion Failed";
			}
		} else { ?>
			<script>
				alert("Invalid Extension. USE 'JPG','JPEG','PNG','GIF' " );
			</script>
		<?php }
	}
	?>

</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/restrictFutureDate.js"></script>
</html>