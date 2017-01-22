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
		<link rel="stylesheet" href="../../css/commons.css" />
		<link rel="stylesheet" href="../../css/bootstrap.min.css" />
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
		<div class="span7">   
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3><b>Stock Mutation (satuan dalam <?php echo $results[0]['satuan']; ?> )</b></h3>
			</div> <!-- /widget-header -->
			
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Nama</td>
							<td>Tanggal</td>
							<td>Jumlah</td>
							<td>Pegawai</td>
						</tr>
					</thead>
					<tbody>
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
					</tbody>
				</table>
			</div>
			<div>
				<input class="btn btn-info" type="button" value="Kembali" onclick="back()" />
			</div>
		</div>
		</div>
	</body>
	
</html>