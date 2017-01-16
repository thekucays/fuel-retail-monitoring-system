<?php
	require_once('..\model\UsersTable.php');
	require_once('..\model\Stocks.php');
	require_once('..\model\Currencies.php');
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
				back = function(){
					window.location = "StockOverview.php";
				};
			});
			
			
		</script>
	</head>
	<body>
		<b>Input BBM Baru</b>
		<form method="post" name="bbmbaruform" id="bbmbaruform" action="">
			<table>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" id="nama" /></td>
				</tr>
				<tr>
					<td>Harga</td>
					<td><input type="text" name="harga" id="harga" /></td>
				</tr>
				<tr>
					<td>Quality (octane / cetane)</td>
					<td><input type="text" name="quality" id="quality" /></td>
				</tr>
				<tr>
					<td>Jumlah Stok</td>
					<td><input type="text" name="jmlstok" id="jmlstok" /></td>
				</tr>
				<tr>
					<td>Satuan</td>
					<td>
						<select name="satuan" id="satuan">
							<option value="">Silahkan Pilih..</option>
							<?php
								$satuan = new Currencies();
								$resultList = $satuan->getCurrenciesList();
								echo "test";
								foreach($resultList as $val){
									echo "<option value='" . $val['id'] . "'>" . $val['nama'] . "</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" name="submitButton" id="submitButton" value="Submit" /></td>
					<td><input type="button" name="backButton" id="backButton" value="Kembali" onclick="back()" /></td>
				</tr>
			</table>
		</form>
		
		<?php
			if(isset($_POST['submitButton'])){
				$stocks = new Stocks();
				
				// prepare object to be inserted
				$stocks->setCurrenciesid($_POST['satuan']);
				$stocks->setStock($_POST['jmlstok']);
				$stocks->setHarga($_POST['harga']);
				$stocks->setNama($_POST['nama']);
				$stocks->setQuality($_POST['quality']);
				$stocks->setAddedby($_SESSION['nip']);
				
				// insert object to db
				$stocks->insertNewStock($stocks);
				
				// redirecting back
				header("Location: StockOverview.php");
			}
		?>
		
	</body>
</html>