<?php
session_start();
require_once "dbCon.php";
$userId = $_SESSION['userId'];
$selected = $_COOKIE['select'];
$filterDate = $filterMonth = $filterYear = $filterFromDate = $filterToDate = null;
if($selected == 'day') {
	$filterDate = $_COOKIE['filterDate'];
	$expenseQuery = mysqli_query($con, " SELECT * FROM `expense` WHERE `user_id` = '$userId' AND`date` = '$filterDate' ");
} else if($selected == 'month') {
	$filterMonth = $_COOKIE['filterMonth'].'-01';
	$expenseQuery = mysqli_query($con," SELECT * FROM `expense` WHERE `user_id` = '$userId' AND YEAR(`date`) = YEAR('$filterMonth') AND MONTH(`date`) = MONTH('$filterMonth') ");
} else if($selected == 'year') {
	$filterYear = $_COOKIE['filterYear'].'-01'.'-01';
	$expenseQuery = mysqli_query($con," SELECT * FROM `expense` WHERE `user_id` = '$userId' AND YEAR(`date`) = YEAR('$filterYear') ");
} else if($selected == 'custom') {
	$filterFromDate = $_COOKIE['filterFromDate'];
	$filterToDate = $_COOKIE['filterToDate'];
	$expenseQuery = mysqli_query($con," SELECT * FROM `expense` WHERE `user_id` = '$userId' AND `date` >= '$filterFromDate' AND `date` <= '$filterToDate' ");
}

$totalIncomeQuery = "SELECT SUM(`income`) FROM `income` WHERE `user_id` = '$userId' ";
$totalExpenseQuery = "SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' ";
$totalIncomeSearch = mysqli_query($con,$totalIncomeQuery);
$totalExpenseSearch = mysqli_query($con,$totalExpenseQuery);
$totalIncome = mysqli_fetch_row($totalIncomeSearch)[0];
$totalExpense = mysqli_fetch_row($totalExpenseSearch)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome Page</title>
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/manageExpenses.css">
<link rel="stylesheet" type="text/css" href="CSS/filter.css">
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
				<div class="balance-detail">
					<div class="balance-item">
						Total Balance : <span id="totalBalance"><?= $totalIncome-$totalExpense ?></span>
					</div>
					<div class="balance-item">
						Total Income : <span id="totalIncome"><?= $totalIncome ?></span>
					</div>
					<div class="balance-item">
						Total Expense : <span id="totalExpense"><?= $totalExpense ?></span>
					</div>
				</div>
				
				<div class="filter-body">
					<form action="filterExpense.php" method="POST">
						<div class="filter-dropdown">
							<label>
								Search By :
							</label>
							<select id="filterDropdown" value="Select" name="select">
								<option value="day">Day</option>
								<option value="month">Month</option>
								<option value="year">Year</option>
								<option value="custom">Custom</option>
							</select>
						</div>
						<div class="filter-option">
							<div class="filter-option-element">
								<input type="date" name="filterDate" id="filterDate">
							</div>
							<div class="filter-option-element">
								<input type="month" name="filterMonth" id="filterMonth">
							</div>
							<div class="filter-option-element">
								<input type="number" name="filterYear" min="2000" value="2022" id="filterYear">
							</div>
							<div class="filter-option-element">
								<div class="date-picker">
									<div class="date-element">
										<label>
											From
										</label>
										<input type="date" name="filterFromDate" id="filterFromDate">
									</div>
									<div class="date-element">
										<label>
											To
										</label>
										<input type="date" name="filterToDate" id="filterToDate">
									</div>
								</div>
							</div>
						</div>
						<div>
							<button  id="filterSubmit">
								Filter
							</button>
						</div>
					</form>
				</div>
				<?php
				if( ($a = mysqli_fetch_assoc($expenseQuery) ) == null){ ?>
				<div class="manage-expense-wrapper">
					<div class="empty-detail">
						NO RECORD FOUND!!!
					</div>
				</div>
			<?php } else { ?>
				<div class="manage-expense-wrapper">
					<table>
						<thead>
							<tr>
								<th>S.N</th>
								<th>Expense</th>
								<th>Category</th>
								<th>Date</th>
								<th>Description</th>
								<th>Image</th>
								<th class="option">Edit</th>
								<th class="option">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1; 
							do {?>
								<tr>
									<td><?=$count?></td>
									<td><?=$a['expense']?></td>
									<td><?=$a['category']?></td>
									<td><?=$a['date']?></td>
									<td><?=$a['description']?></td>
									<td><?php if($a['image'] == ""){echo 'N.A';}else{?><a target="_blank" href="showImage.php?ZQT=<?=$a['expense_id']?>">Show Image</a><?php }?></td>
									<td><a href="updateExpenses.php?update=<?=$a['expense_id'];?>"><i class="far fa-edit"></i></a></td>
									<td><a href="deleteExpenses.php?delete=<?=$a['expense_id'];?>"><i class="fas fa-trash"></i></a></td>
								</tr>
								<?php $count++;
							} while ($a = mysqli_fetch_assoc($expenseQuery)) ?>
						</tbody>
					</table>

				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<script>
		location.replace("login.php");
	</script>
<?php } ?>
</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/chart.js"></script>
<script type="text/javascript" src="JS/responsiveness.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/filter.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>

</html>