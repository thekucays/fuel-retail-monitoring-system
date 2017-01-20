<?php
	//require_once('..\..\libs\html2pdf\html2pdf.class.php');
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
	$penjualanBbm = $stocks->getBbmSellingReport();
	//$rekapPerBulan = $stocks->rekapPerBulan();
	print_r($penjualanBbm);
	
	// page footer / end
	$content = $content . "
		</body>
		</html>
	";
	
	// generate pdf
	/*$html2pdf = new HTML2PDF($mode,'A4','de',true,'UTF-8',array(10, 10, 10, 10)); 
	$html2pdf->WriteHTML($content); 
	$html2pdf->Output($filename.'.pdf'); */
?>

<html>
		<head>
			<title>Rekapitulasi</title>
		</head>
		<body>
			<b>PT. Salsa Kusuma Jaya SPBU 34 - 16715</b> <br>
			<b>Laporan Penjualan Bulanan</b> <br>
			<br>
			
			<div>
				Penjualan BBM
			</div>
			<div style='margin-top: 10px;'>
				<table border=1>
					<tr>
						<td>No</td>
						<td>Keterangan</td>
						<td>Jumlah Penjualan</td>
						<td>Satuan</td>
						<td>Penjualan Rata-Rata</td>
					</tr>
					<?php
						$numbering = 0;
						$rekapSource;
						foreach($penjualanBbm as $pBbm){
							echo "<tr>";
							echo "<td>" . ($numbering + 1) . "</td>";
							echo "<td>" . $pBbm['nama'] . "</td>";
							if($pBbm['jumlahpenjualan'] != ""){
								echo "<td>" . $pBbm['jumlahpenjualan'] . "</td>";
							} else{
								echo "<td>-</td>";
							}
							echo "<td>" . $pBbm['satuan'] . "</td>";
							if($pBbm['penjualanratarata'] != ""){
								echo "<td>" . $pBbm['penjualanratarata'] . "</td>";
							} else{
								echo "<td>-</td>";
							}
							echo "</tr>";
							
							// populate data for Stocks->rekapPerBulan()
							$rekapSource[$numbering][0] = $pBbm['id'];
							$rekapSource[$numbering][1] = $pBbm['nama'];
							
							$numbering++;
						}
					?>
				</table>
			</div>
			<?php
				// print rekap penjualan harian
				$numbering2 = 0;
				foreach($rekapSource as $rekapVal){
					$rekapPenjualanHarian = $stocks->rekapPerBulan($rekapSource[$numbering2][0]);
						
					// test
					/*echo "rekap source: " . $rekapSource[$numbering2][0] . "<br>";
					$numbering2++;
					print_r($rekapPenjualanHarian);*/
					
					echo "<div style='margin-top: 30px;'>";
					echo "Rekap Penjualan Harian Produk " . $rekapSource[$numbering2][1] . "<br>";
					echo "<table border=1>";
					echo "<tr>";
					echo "<td>No</td>";
					echo "<td>Hari-Tanggal-Bulan-Tahun</td>";
					echo "<td>Jumlah Penjualan</td>";
					echo "<td>Nilai Penjualan</td>";
					echo "</tr>";
					
					$numberingTableOnly = 0;
					foreach($rekapPenjualanHarian as $val){
						echo "<tr>";
						echo "<td>" . ($numberingTableOnly + 1) . "</td>";
						echo "<td>" . $val['mutation_date'] . "</td>";
						echo "<td>" . $val['amount'] . "</td>";
						echo "<td>" . $val['nilaipenjualan'] . "</td>";
						echo "</tr>";
						$numberingTableOnly++;
					}
					
					echo "</table>";
					echo "</div>";
					$numbering2++;
				}
			?>
		</body>
</html>