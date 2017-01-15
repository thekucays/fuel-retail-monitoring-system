<?php
	require_once('..\model\Stocks.php');
	
	$stock = new Stock();
	$result = $stock->getStockList();
	
	echo json_encode($result);
?>