<?php
	require_once('..\model\UsersTable.php');
	require_once('..\model\Stocks.php');
	require_once('..\model\StocksMutation.php');
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
		<title>Rekapitulasi</title>
	</head>
	<body>
		PT. Salsa Kusuma Jaya SPBU 34 - 16715 <br>
		Laporan Penjualan Bulanan<br>
		<br>
		
		<?php
			$stocks = new Stocks();
		?>	
	</body>
</html>