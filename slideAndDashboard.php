<?php
	require_once "dbCon.php";
	$email = $_SESSION['userEmail'];
	$userId = $_SESSION['userId'];
	$totalIncomeQuery = "SELECT SUM(`income`) FROM `income` WHERE `user_id` = '$userId' ";
	$totalExpenseQuery = "SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' ";
	$totalIncomeSearch = mysqli_query($con,$totalIncomeQuery);
	$totalExpenseSearch = mysqli_query($con,$totalExpenseQuery);
	$totalIncome = mysqli_fetch_row($totalIncomeSearch)[0];
	$totalExpense = mysqli_fetch_row($totalExpenseSearch)[0];
	?>
	<script>
		console.log("<?=$totalIncome?>");
	</script>
	<?php
?>

<div class="dashboard-wrapper">
	<label>
		Dashboard
	</label>
	<div class="dashboard-item-wrapper">
		<div class="dashboard-item-container">
			<div class="dashboard-item">
				<a href="addExpenses.php">
					<i class="far fa-money-bill-alt" style="color: green"></i>
					Add Expenses
				</a>
			</div>
			<div class="dashboard-item">
				<a href="manageExpenses.php">
					<i class="fas fa-hand-holding-usd" style="color: #0C46DB"></i>
					Manage Expenses
				</a>
			</div>
			<div class="dashboard-item">
				<a href="profile.php" >
					<i class="fas fa-user-cog" style="color: black"></i>
					User Profile
				</a>
			</div>
		</div>
		<div class="balance-detail">
			<div class="balance-item <?php if($totalIncome-$totalExpense <= 0 ){echo "red";}else{echo "green";}?>">
				<strong>Total Balance : <span id="totalBalance"><?= $totalIncome-$totalExpense ?></span></strong>
			</div>
			<div class="balance-item">
				<strong>Total Income : <span id="totalIncome"><?= $totalIncome ?></span></strong>
			</div>
			<div class="balance-item <?php if($totalIncome-$totalExpense <= 0 ){echo "red";}?>">
				<strong>Total Expense : <span id="totalExpense"><?= $totalExpense ?></span></strong>
			</div>
		</div>
	</div>
</div>