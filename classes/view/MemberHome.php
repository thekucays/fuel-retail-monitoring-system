<?php
	require_once('..\model\UsersTable.php');
	session_start();
	
	// session check
	$usersTable = new UsersTable();
	if($_SESSION['nip']=='' || $usersTable->checkSession($_SESSION['nip'])=='0'){
		session_destroy();
		header("Location: ../../index.php");
	}
?>

<html>
	<head>
		<title>Fuel Retail v0.1 Member Home Page</title>
		<script src="../../scripts/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#inputPenjualan").click(function(){
					location.href = "InputPenjualan.php";
				});
				$("#stockOverview").click(function(){
					location.href = "StockOverview.php";
				});
			});
		</script>
	</head>
	<body>
		Silahkan Pilih Menu Berikut : <br>
		
		<input type="button" id="inputPenjualan" name="inputPenjualan" value="Input Penjualan"/>
		<input type="button" id="stockOverview" name="stockOverview" value="Stock Overview"/>
	</body>
</html>