<?php
	//require_once('..\..\libs\html2pdf\html2pdf.class.php');
	require_once('..\..\libs\html2pdf\vendor\autoload.php');
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
	
	// get the HTML
    ob_start();
    include('Rekap.php');
    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple00.pdf');
		
		header("Location: StockOverview.php");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>