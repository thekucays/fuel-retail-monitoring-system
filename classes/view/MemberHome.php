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
		<link rel="stylesheet" href="../../css/commons.css" />
		<link rel="stylesheet" href="../../css/bootstrap.min.css" />
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
		<div style="margin-bottom: 20px;">
			Login sebagai: <?php echo $_SESSION['nip'] ?>
			<a href="../controller/Logout.php">Logout</a>
		</div>
	
		<div class="span7">   
		<div class="widget stacked widget-table action-table">	
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3><b>Silahkan Pilih Menu Berikut :</b></h3>
			</div> <!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td><center><input class="btn btn-primary" type="button" id="inputPenjualan" name="inputPenjualan" value="Input Penjualan"/></center></td>
							<td><center><input class="btn btn-primary" type="button" id="stockOverview" name="stockOverview" value="Stock Overview"/></center></td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		</div>
	</body>
</html>