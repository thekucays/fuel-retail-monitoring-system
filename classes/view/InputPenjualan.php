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
		<title>Fuel Retail v0.1 Member Home Page</title>
		<script src="../../scripts/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				back = function(){
					window.location = "MemberHome.php";
				};
			});
			
			
		</script>
	</head>
	<body>
		<b>Input Penjualan</b>
		<form method="post" name="inputpenjualanform" id="inputpenjualanform" action="">
			<table>
				<tr>
					<td>NIP</td>
					<td><input type="text" name="nip" id="nip" value="<?php echo $_SESSION['nip']; ?>" readonly /></td>
				</tr>
				<tr>
					<td>BBM</td>
					<td>
						<select name="stockid" id="stockid">
							<option value="">Silahkan Pilih..</option>
							<?php
								$stocks = new Stocks();
								$resultList = $stocks->getStockList();
								echo "test";
								foreach($resultList as $val){
									echo "<option value='" . $val['id'] . "'>" . $val['nama'] . "</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Satuan</td>
					<td><input type="text" name="satuan" id="satuan" /></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td><input type="text" name="jumlah" id="jumlah" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="submitButton" id="submitButton" value="Submit" /></td>
					<td><input type="button" name="backButton" id="backButton" value="Kembali" onclick="back()" /></td>
				</tr>
			</table>
		</form>
		
		<?php
			if(isset($_POST['submitButton'])){
				// cek if amount empty
				if($_POST['jumlah'] == ""){
					echo "<script>alert('jumlah harus diisi');</script>";
				} else{
					// update stocks data
					$stocks = new Stocks();
					$stocksId = $_POST['stockid'];
					$amount = $_POST['jumlah'];
					$stocks->reduceStock($stocksId, $amount);
				
					// add stocks mutation data
					$stocksMutation = new StocksMutation();
					$nip = $_SESSION['nip'];
					$mtype = "1";
					$stocksMutation->addStockMutation($nip, $amount, $mtype, $stocksId);
				
					// redirecting back
					header("Location: StockOverview.php");
				}
			}
		?>
	</body>
</html>