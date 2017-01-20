<?php
	require once('..\..\libs\html2pdf.class.php');
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

	// generate content
	// page header
	$content = "
		<html>
		<head>
			<title>Rekapitulasi</title>
		</head>
		<body>
			PT. Salsa Kusuma Jaya SPBU 34 - 16715 <br>
			Laporan Penjualan Bulanan<br>
			<br>
			
	";
	
	// page content
	$stocks = new Stocks();
	$stockReport = $stocks->rekapPerBulan();
	
	// page footer / end
	$content = $content . "
		</body>
		</html>
	";
	
	// generate pdf
	$html2pdf = new HTML2PDF($mode,'A4','de',true,'UTF-8',array(10, 10, 10, 10)); 
	$html2pdf->WriteHTML($content); 
	$html2pdf->Output($filename.'.pdf');
?>