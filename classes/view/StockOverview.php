<?php
	require_once('..\model\UsersTable.php');
	require_once('..\model\Stocks.php');
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
				viewMutasi = function(id){
					window.location = "../controller/StockController.php?action=viewmutation&stockid="+id;
				};
				tambahStock = function(id){
					window.location = "../controller/StockController.php?action=updatestock&stockid="+id;
				};
				back = function(){
					window.location = "MemberHome.php";
				};
				rekap = function(){
					window.location = "RekapPdf.php"
				};
				insert = function(){
					window.location = "InsertNewStock.php"
				};
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
			<?php
				$stockList = new Stocks();
				$result = $stockList->getAllSellingData();
			?>
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3><b>Stock Overview</b></h3>
			</div> <!-- /widget-header -->
			
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Stock saat ini</th>
							<th>Jumlah per hari</th>
							<th>Jumlah per minggu</th>
							<th>Jumlah per bulan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($result as $val){
							echo "<tr>";
							echo "<td>" . $val['nama'] . "</td>";
							echo "<td>" . $val['stock'] . "</td>";
							echo "<td>" . $val['day'] . "</td>";
							echo "<td>" . $val['week'] . "</td>";
							echo "<td>" . $val['month'] . "</td>";
							echo "<td>
								<input class='btn btn-success' type='button' value='View Mutasi' onclick='viewMutasi(". $val['id'] .")' />
								<input class='btn btn-danger' type='button' value='Update Stock' onclick='tambahStock(". $val['id'] .")' />
								</td>";
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
				<br>
				<input class="btn btn-primary" type="button" id="rekapButton" name="rekapButton" value="Rekapitulasi" onclick="rekap()" />
				<input class="btn btn-primary" type="button" id="inputButton" name="inputButton" value="Input BBM Baru" onclick="insert()" />
				<input class="btn btn-info" type="button" id="backButton" name="backButton" value="Back" onclick="back()" />
			</div>
		</div>
		</div>
	</body>
</html>