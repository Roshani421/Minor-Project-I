<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome Page</title>
</head>
<link rel="stylesheet" type="text/css" href="CSS/leftContainer.css">
<link rel="stylesheet" type="text/css" href="CSS/index.css">
<link rel="stylesheet" type="text/css" href="FONTS/fontAwesome/css/all.css">
<body>
	<?php

	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) { ?>

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
				<div class="report-wrapper">
					<label>
						Income-Expense Report
					</label>
					<div class="report-item-wrapper">
						<div class="report-item">
							<canvas id="canvas1" width="500px" height="300px">
								
							</canvas>
						</div>
						<div class="report-item">
							<canvas id="canvas2"  width="500px" height="400px">
								
							</canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } ?>
	<?php
	$userId = $_SESSION['userId'];
	$expenseCategory = mysqli_query($con," SELECT `category` FROM `expense` WHERE `user_id` = '$userId' GROUP BY `category` ");
	$expenseCategoryAmount = mysqli_query($con, " SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' GROUP BY `category` ");
	$expenseDate = mysqli_query($con, " SELECT  `date` FROM `expense` WHERE `user_id` = '$userId' GROUP BY `date` ");
	$expenseDateAmount = mysqli_query($con, " SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' GROUP BY `date` ");
	$incomeDate = mysqli_query($con, " SELECT `date` FROM `income` WHERE `user_id` = '$userId' GROUP BY `date` ");
	$expenseDate = mysqli_query($con, " SELECT `date` FROM `expense` WHERE `user_id` = '$userId' GROUP BY `date` ");
	$incomeDateAmount = mysqli_query($con, " SELECT SUM(`income`) FROM `income` WHERE `user_id` = '$userId' GROUP BY `date` ");
	?>

</body>
<script type="text/javascript" src="JS/slide.js"></script>
<script type="text/javascript" src="JS/activePage.js"></script>
<script type="text/javascript" src="JS/chart.js"></script>
<script type="text/javascript" src="JS/responsiveness.js"></script>
<script type="text/javascript">
	var dynamicColors = function() {
		var r = Math.floor(Math.random() * 255);
		var g = Math.floor(Math.random() * 255);
		var b = Math.floor(Math.random() * 255);
		return "rgb(" + r + "," + g + "," + b + ")";
	};
	var expenseCategory = [ <?php while($a = mysqli_fetch_assoc($expenseCategory)) {
		echo '"'.$a['category'].'",';
	} ?>];
	var expenseCategoryAmount = [ <?php while($b = mysqli_fetch_assoc($expenseCategoryAmount)) {
		echo '"'.$b['SUM(`expense`)'].'",';
	} ?>];
	var expenseCategoryBGColor = [];
	var expenseCategoryLength = 0;
	while(expenseCategoryLength != expenseCategory.length) {
		expenseCategoryBGColor[expenseCategoryLength] = dynamicColors();
		expenseCategoryLength++;
	}
	var canvas1 = document.getElementById('canvas1').getContext('2d');
	var canvas2 = document.getElementById('canvas2').getContext('2d');
	

	var linexValues = [ <?php while($d = mysqli_fetch_assoc($incomeDate)) {
		echo '"'.$d['date'].'",';
	} ?>];
	var lineyValues = [ <?php while($e = mysqli_fetch_assoc($incomeDateAmount)) {
		echo '"'.$e['SUM(`income`)'].'",';

	} ?>];
	var lineyValues2 = [ <?php while($z = mysqli_fetch_assoc($expenseDateAmount)) {
		echo '"'.$z['SUM(`expense`)'].'",';
		
	} ?>];
	var lineChart = new Chart(canvas1, {
		type: 'line',
		data: {
			labels : linexValues,
			datasets : [{
				label: 'Income',
				fill: true,
				lineTension: 0.4,
				backgroundColor: dynamicColors(),
				borderColor: dynamicColors(),
				data: lineyValues
			},{
				label: 'Expense',
				fill: true,
				lineTension: 0.4,
				backgroundColor: dynamicColors(),
				borderColor: dynamicColors(),
				data: lineyValues2

			}]
		},
		options: {
			legend: { display: true},
			title: {
				display: true,
				text: "Income and Expense Graph",
				fontSize: 30,
				fontFamily: "sans-serif",
				fontStyle: "bold",
				fontColor: "black",
			}
		}
	});



	var doughnutChart = new Chart(canvas2, {
		type: "doughnut",
		data: {
			labels: expenseCategory,
			datasets : [{
				backgroundColor: expenseCategoryBGColor,
				hoverBorderWidth: 3,
				hoverBorderColor: 'black',
				data : expenseCategoryAmount
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,

			title: {
				display: true,
				text: "Expense By Categories",
				fontSize: 30,
				fontFamily: "sans-serif",
				fontStyle: "bold",
				fontColor: "black",
			},
			legend: {
				display: true,
				labels: {
					fontFamily: "serif",
					fontColor: "black",
					fontSize: 16,
					boxWidth: 20,
				},
			},
			animation: {
				animation : true,
				duration: 2000,
				easing: "easeInOutBounce",
				from:1,
				to:0,
			},
		},
		
	});

</script>
</html>