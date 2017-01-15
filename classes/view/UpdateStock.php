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
	
	// get stock data to be updated
	if($_REQUEST['stockid'] == ""){
		header("Location: StockOverview.php");
	} else{
		$stockId = $_REQUEST['stockid'];
		$stocks = new Stocks();
		$result = $stocks->checkStock($stockId);
		
		print_r($result);
	}
?>

<html>
	<head>
		<title>Fuel Retail v0.1 Member Home Page</title>
		<script src="../../scripts/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				back = function(id){
					window.location = "StockOverview.php";
				};
			});
		</script>
	</head>
	<body>
		<b>Update Fuel Stock for <?php echo $result['nama']; ?></b>
		
		<form method="post" name="updateForm" id="updateForm" action="">
			<table>
				<tr>
					<td>Pegawai</td>
					<td><input type="text" name="pegawai" id="pegawai" value="<?php echo $_SESSION['nip']; ?>" readonly /></td> 
				</tr>
				<tr>
					<td>BBM</td>
					<td><input type="text" name="bbm" id="bbm" value="<?php echo $result['nama']; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Satuan</td>
					<td><input type="text" name="satuan" id="satuan" value="<?php echo $result['satuan']; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td><input type="text" name="jumlah" id="jumlah" /></td>
				</tr>
				<tr>
					<input type="hidden" name="stockid" id="stockid" value="<?php echo $result['id']; ?>" />
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
					$stocks->addStock($stocksId, $amount);
					
					// add stocks mutation data
					$stocksMutation = new StocksMutation();
					$nip = $_SESSION['nip'];
					$mtype = "2";
					$stocksMutation->addStockMutation($nip, $amount, $mtype, $stocksId);
					
					// redirecting back
					header("Location: StockOverview.php");
				}
			}
		?>
		
	</body>
</html>