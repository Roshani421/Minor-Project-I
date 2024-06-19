<div class="body-left-container">
	<div class="user-info">
		<div class="user-info-image">
			<img src="UPLOADS/PROFILE/<?=$_SESSION['profilePath']?>">
		</div>
		<div class="user-info-name">
			<?=$_SESSION['userFirstName']." ".$_SESSION['userLastName']; ?>
		</div>
		<div class="user-info-email">
			<?=$_SESSION['userEmail']; ?>
		</div>
	</div>
	<div class="sidebar-wrapper">
		<div class="sidebar-menu">
			<label>
				MANAGEMENT
			</label>
			<div class="sidebar-menu-item-wrapper">
				<a href="index.php" class="sidebar-menu-item">
					Dashboard
				</a>
				<a href="addIncome.php" class="sidebar-menu-item">
					Add Income
				</a>
				<a href="addExpenses.php" class="sidebar-menu-item">
					Add Expenses
				</a>
				<a href="manageIncome.php" class="sidebar-menu-item">
					Manage Income
				</a>
				<a href="manageExpenses.php" class="sidebar-menu-item">
					Manage Expenses
				</a>
				<a href="generateReport.php" class="sidebar-menu-item">
					Generate Report
				</a>
			</div>
		</div>
		<div class="sidebar-menu">
			<label>
				SETTINGS
			</label>
			<div class="sidebar-menu-item-wrapper">
				<a href="profile.php" class="sidebar-menu-item">
					Profile
				</a>
				<a href="logout.php" class="sidebar-menu-item">
					Logout
				</a>
			</div>
		</div>
	</div>
</div>