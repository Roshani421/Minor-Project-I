<?php
	$server = "localhost";
	$uName = "root";
	$pass = "";
	$dbName = "Khharcha";

	$con = mysqli_connect($server,$uName,$pass,$dbName);

	if(!$con) {
		echo "Connection to Database failed";
	}
?>