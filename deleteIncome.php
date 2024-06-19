<?php
session_start();
require_once "dbCon.php";
if($_SESSION['loggedIn'] === true) {
	if(isset($_GET['delete'])) {
		$incomeId = $_GET['delete'];
		$deleteQuery = mysqli_query($con," DELETE FROM `income` WHERE `income_id` = '$incomeId' ");
		if($deleteQuery){ ?>
			<script>
				location.replace('manageIncome.php');
			</script>
		<?php }
	}else { ?>
		<script>
			location.replace("manageIncome.php");
		</script>
	<?php }
} else { ?>
	<script>
		location.replace("login.php");
	</script>
<?php }
?>
