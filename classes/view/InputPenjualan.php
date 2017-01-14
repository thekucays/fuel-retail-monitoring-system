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
				viewMutasi = function(id){
					window.location = "../controller/StockController.php?action=viewmutation&stockid="+id;
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
					<td><input type="text" name="nip" id="nip" /></td>
				</tr>
				<tr>
					<td>BBM</td>
					<td>
						<select name="bbm" id="bbm">
							<option value="">Silahkan Pilih..</option>
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
			
			}
		?>
	</body>
</html>