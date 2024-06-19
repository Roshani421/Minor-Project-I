<?php
require_once "dbCon.php";

$expenseId= $_GET['ZQT'];
$expenseQuery = mysqli_query($con, " SELECT * FROM `expense` WHERE `expense_id`='$expenseId' ");
$row = mysqli_fetch_row($expenseQuery);
$expense = $row[3];
$category = $row[2];
$date = $row[4];
$description = $row[5];
$imagePath = 'UPLOADS/EXPENSES/'.$row[6];
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Show Image
	</title>
	<style type="text/css">
		body{
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
			align-items: center;
		}
		.image-container{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.manage-expense-wrapper{
			width: 97.5%;
		}
		table{
			width: 100%;
			border-collapse: collapse;
			font-family: Arial;
			text-align: center;
		}
		th,td{
			border: 1px solid #ddd;
			padding: 0.5rem;
			font-size: 1.2rem;
		}
		th {
			padding-top: 12px;
			padding-bottom: 12px;
			font-size: 1.4rem;
			background-color: #04AA6D;
			color: white;
		}
	</style>
</head>
<body>
	<div class="image-container">
		<img src="<?=$imagePath?>" alt="Bill">
	</div>
	<div class="manage-expense-wrapper">
		<table>
			<thead>
				<tr>
					<th>Expense</th>
					<th>Category</th>
					<th>Date</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?=$expense?></td>
					<td><?=$category?></td>
					<td><?=$date?></td>
					<td><?=$description?></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
