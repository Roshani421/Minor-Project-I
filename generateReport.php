<?php
session_start();
$_SESSION['isShowClicked'] = false;
require_once "dbCon.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/generateReport.css">
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
				<form  action="showReport.php" method="POST" target="_blank">
					<div class="date-picker">
						<div class="date-element">
							<label>
								From
							</label>
							<input type="date" name="fromDate" id="fromDate">
						</div>
						<div class="date-element">
							<label>
								To
							</label>
							<input type="date" name="toDate" id="toDate">
						</div>
					</div>
					<div>
						<button type="submit" id="generateReportSubmit" name="generate">
							Generate Report
						</button>
					</div>
				</form>
			</div>
		</div>
	<?php } else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } ?>
</body>
<script type="text/javascript" src="JS/slide.js"> </script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/chart.js"></script>
<script type="text/javascript" src="JS/responsiveness.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>
<script type="text/javascript" src="JS/restrictFutureDate.js"></script>
<script type="text/javascript">

	var submit = document.getElementById('generateReportSubmit');
	
	submit.addEventListener('click', () => {
		var fromDate = document.getElementById('fromDate');
		var toDate = document.getElementById('toDate');
		document.cookie = "fromDate="+fromDate.value+";";
		document.cookie = "toDate="+toDate.value+";";
	});
</script>

</html>