<?php
session_start();
require_once "dbCon.php";
if($_SESSION['loggedIn'] === true) {
	if(isset($_GET['delete'])) {
		$expenseId = $_GET['delete'];
		$deleteQuery = mysqli_query($con," DELETE FROM `expense` WHERE `expense_id` = '$expenseId' ");
		if($deleteQuery){ ?>
			<script>
				location.replace('manageExpenses.php');
			</script>
		<?php }
	}else { ?>
		<script>
			location.replace("manageExpenses.php");
		</script>
	<?php }
} else { ?>
	<script>
		location.replace("login.php");
	</script>
<?php }
?>
