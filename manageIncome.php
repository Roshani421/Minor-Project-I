<?php
session_start();
require_once "dbCon.php";
$userId = $_SESSION['userId'];
$incomeQuery = mysqli_query($con, " SELECT * FROM `income` WHERE `user_id` = '$userId' ");

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
<link rel="stylesheet" type="text/css" href="CSS/manageIncome.css">
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
				<?php
				if( ($a = mysqli_fetch_assoc($incomeQuery) ) == null){ ?>
					<div class="manage-income-wrapper">
						<div class="empty-detail">
							Please add Income Detail
						</div>
					</div>
				<?php } else { ?>

					<div class="filter-body">
						<form action="filterIncome.php" method="POST">
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
					
					<div class="manage-income-wrapper">
						<table>
							<thead>
								<tr>
									<th>S.N</th>
									<th>Income</th>
									<th>Date</th>
									<th>Description</th>
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
										<td><?=$a['income']?></td>
										<td><?=$a['date']?></td>
										<td><?=ucfirst($a['description'])?></td>
										<td><a href="updateIncome.php?update=<?=$a['income_id'];?>"><i class="far fa-edit"></i></a></td>
										<td><a href="deleteIncome.php?delete=<?=$a['income_id'];?>"><i class="fas fa-trash"></i></a></td>
									</tr>
									<?php $count++;
								} while ($a = mysqli_fetch_assoc($incomeQuery)) ?>
							</tbody>
						</table>
						
					</div>
				<?php }
				?>
			</div>
		</div>
	<?php } else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } ?>
</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/chart.js"></script>
<script type="text/javascript" src="JS/responsiveness.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/filter.js"></script>

</html>