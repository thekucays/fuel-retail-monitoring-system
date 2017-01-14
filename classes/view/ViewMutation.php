<?php
	require_once('..\model\UsersTable.php');
	session_start();
	
	// session check
	$usersTable = new UsersTable();
	if($_SESSION['nip']=='' || $usersTable->checkSession($_SESSION['nip'])=='0'){
		session_destroy();
		header("Location: ../../index.php");
	}
	if(!isset($_SESSION['mutationData'])){
		header("Location: StockOverview.php");
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
	
		<?php
			$results = $_SESSION['mutationData'];
		?>
	
		<b>Stock Mutation (satuan dalam <?php echo $results[0]['satuan']; ?> )</b>
		<table border=1>
			<tr>
				<td>Nama</td>
				<td>Tanggal</td>
				<td>Jumlah</td>
				<td>Pegawai</td>
			</tr>
			<?php
				foreach($results as $val){
					echo "<tr>";
					echo "<td>" . $val['nama'] . "</td>";
					echo "<td>" . $val['mutation_date'] . "</td>";
					echo "<td>";
						if($val['mutation_types']=="P") echo "-";
						echo $val['amount'];
					echo "</td>";
					echo "<td>" . $val['nip'] . " - " . $val['namapegawai'] . "</td>";
					echo "</tr>";
				}
			?>
		</table>
		<input type="button" value="Kembali" onclick="back()" />
	</body>
	
</html>