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
		<script src="../../scripts/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				viewMutasi = function(id){
					window.location = "../controller/StockController.php?action=viewmutation&id="+id;
				};
				tambahStock = function(id){
					window.location = "../controller/StockController.php?action=updatestock&id="+id;
				};
			});
		</script>
	</head>
	<body>
		<?php
			$stockList = new Stocks();
			$result = $stockList->getAllSellingData();
			print_r($result);
		?>
		<input type="button" id="a" name="a" value="tesclick" onclick="viewMutasi('a')" />
		<input type="button" id="a" name="a" value="tesclick" onclick="tambahStock('b')" />
		
		<table border=1>
			<tr>
				<td>Nama</td>
				<td>Stock saat ini</td>
				<td>Jumlah per hari</td>
				<td>Jumlah per minggu</td>
				<td>Jumlah per bulan</td>
				<td>Aksi</td>
			</tr>
			<?php
				foreach($result as $val){
					echo "<tr>";
					echo "<td>" . $val['nama'] . "</td>";
					echo "<td>" . $val['stock'] . "</td>";
					echo "<td>" . $val['day'] . "</td>";
					echo "<td>" . $val['week'] . "</td>";
					echo "<td>" . $val['month'] . "</td>";
					echo "<td>
						<input type='button' value='View Mutasi' onclick='viewMutasi(". $val['id'] .")' />
						<input type='button' value='Update Stock' onclick='tambahStock(". $val['id'] .")' />
						</td>";
					echo "</tr>";
				}
			?>
		</table>
	</body>
</html>