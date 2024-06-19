<?php
session_start();
require_once "dbCon.php";
$userId = $_SESSION['userId'];

$fromDate = $_COOKIE['fromDate'];
$toDate = $_COOKIE['toDate'];

$incomeQuery = mysqli_query($con, " SELECT * FROM `income` WHERE `user_id` = '$userId' ");
$totalIncomeQuery = "SELECT SUM(`income`) FROM `income` WHERE `user_id` = '$userId' ";
$totalExpenseQuery = "SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' ";
$totalIncomeSearch = mysqli_query($con,$totalIncomeQuery);
$totalExpenseSearch = mysqli_query($con,$totalExpenseQuery);
$totalIncome = mysqli_fetch_row($totalIncomeSearch)[0];
$totalExpense = mysqli_fetch_row($totalExpenseSearch)[0];

$expenseCategory = mysqli_query($con," SELECT `category` FROM `expense` WHERE `user_id` = '$userId' GROUP BY `category` ");
$expenseCategoryAmount = mysqli_query($con, " SELECT SUM(`expense`) FROM `expense` WHERE `user_id` = '$userId' GROUP BY `category` ");
$expenseDateAmount = mysqli_query($con, " SELECT  SUM(`expense`) FROM `expense` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId'");
$incomeDateAmount = mysqli_query($con, " SELECT SUM(`income`) FROM `income` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId' ");
$incomeDate = mysqli_query($con, " SELECT `date` FROM `income` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId' GROUP BY `date` ");
$expenseDate = mysqli_query($con, " SELECT `date` FROM `expense` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId' GROUP BY `date` ");
$incomeAmount = mysqli_query($con, " SELECT `income` FROM `income` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId' GROUP BY `date` ");
$expenseAmount = mysqli_query($con, " SELECT `expense` FROM `expense` WHERE `date`>='$fromDate' AND `date` <='$toDate' AND `user_id` = '$userId' GROUP BY `date` ");
$totalDateExpense = mysqli_fetch_row($expenseDateAmount)[0];
$totalDateIncome = mysqli_fetch_row($incomeDateAmount)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/showReport.css">
</head>
<body>
	<?php
	if($_SESSION['loggedIn'] === true) {
		?>
		<div class="show-report-body">
			<div class="detail">
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
			</div>
			<div class="report-body" id="reportBody">
				<div class="report-header">
					Income-Expense Detail ( FROM <span><?=$fromDate?></span>  TO  <span><?=$toDate?></span>)
				</div>
				
				<div class="date-balance-detail">
					<div class="balance-item">
						Total Income : <span id="totalIncome"><?= $totalDateIncome ?></span>
					</div>
					<div class="balance-item">
						Total Expense : <span id="totalExpense"><?= $totalDateExpense ?></span>
					</div>
				</div>
				<div class="report-element">
					<canvas id="canvas1"  width="700px" height="500px">

					</canvas>
				</div>
				<div class="report-element">
					<canvas id="canvas2"  width="700px" height="500px">

					</canvas>
				</div>
				<div class="report-element">
					<canvas id="canvas3"  width="700px" height="500px">

					</canvas>
				</div>
				<div class="report-element">
					<canvas id="canvas4"  width="700px" height="500px">

					</canvas>
				</div>
				<div class="report-element">
					<canvas id="canvas5"  width="700px" height="500px">

					</canvas>
				</div>
			</div>
		</div>
		<?php 
	} else { ?>
		<script>
			location.replace("login.php");
		</script>
	<?php } ?>
</body>
<script type="text/javascript" src="JS/chart.js"></script>
<script type="text/javascript" src="JS/preventAutoSubmission.js"></script>

<script type="text/javascript">
	var canvas1 = document.getElementById('canvas1').getContext('2d');
	var canvas2 = document.getElementById('canvas2').getContext('2d');
	var canvas3 = document.getElementById('canvas3').getContext('2d');
	var canvas4 = document.getElementById('canvas4').getContext('2d');
	var canvas5 = document.getElementById('canvas5').getContext('2d');

	var dynamicColors = function() {
		var r = Math.floor(Math.random() * 255);
		var g = Math.floor(Math.random() * 255);
		var b = Math.floor(Math.random() * 255);
		return "rgb(" + r + "," + g + "," + b + ")";
	};

	var xValues = ["Income","Expense"];
	var yValues = ["<?=$totalDateIncome?>","<?=$totalDateExpense?>"];
	var barChart = new Chart(canvas1, {
		type: 'bar',
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: [dynamicColors(),dynamicColors()],
				data: yValues,
				borderColor: dynamicColors(),
				borderWidth: 2
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						step: yValues.length
					}
				}]
			},
			responsive: false,
			maintainAspectRatio: false,
			legend: false,
			title: {
				display: true,
				text: "Income-Expense Bar Chart",
				fontSize: 30,
				fontFamily: "sans-serif",
				fontStyle: "bold",
				fontColor: "black",
			}
		}
	});

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
			scales: {
				y: {
					min: 0
				}
			},
			responsive: false,
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

	var doughnutChart = new Chart(canvas5, {
		type: "polarArea",
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
			scales: {
				y: {
					min: 0
				}
			},
			responsive: false,
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

	var linexValues = [ <?php while($d = mysqli_fetch_assoc($incomeDate)) {
		echo '"'.$d['date'].'",';
	} ?>];
	var lineyValues = [ <?php while($e = mysqli_fetch_assoc($incomeAmount)) {
		echo '"'.$e['income'].'",';

	} ?>];
	var linexValues2 = [ <?php while($f = mysqli_fetch_assoc($expenseDate)) {
		echo '"'.$f['date'].'",';
	} ?>];
	var lineyValues2 = [ <?php while($g = mysqli_fetch_assoc($expenseAmount)) {
		echo '"'.$g['expense'].'",';
		
	} ?>];
	var lineChart = new Chart(canvas3, {
		type: 'line',
		fillOpacity: .3,
		data: {
			labels : linexValues,
			datasets : [{
				label: 'Income',
				fill: true,
				lineTension: 0.4,
				backgroundColor: dynamicColors(),
				borderColor: dynamicColors(),
				data: lineyValues
			}]
		},
		options: {
			scales: {
				y: {
					min: 0
				}
			},
			legend: { display: true},
			title: {
				display: true,
				text: "Income Graph",
				fontSize: 30,
				fontFamily: "sans-serif",
				fontStyle: "bold",
				fontColor: "black",
			}
		}
	});

	var lineChart = new Chart(canvas4, {
		type: 'line',

		data: {
			labels : linexValues2,

			datasets : [{
				label: 'Expense',
				fill: true,
				lineTension: 0.4,
				backgroundColor: dynamicColors(),
				borderColor: dynamicColors(),
				data: lineyValues2
			}]
		},
		options: {
			scales: {
				y: {
					min: 0
				}
			},
			legend: { display: true},
			title: {
				display: true,
				text: "Expense Graph",
				fontSize: 30,
				fontFamily: "sans-serif",
				fontStyle: "bold",
				fontColor: "black",
			}
		}
	});

</script>
</html>