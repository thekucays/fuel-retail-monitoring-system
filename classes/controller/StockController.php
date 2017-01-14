<?php
	require_once('..\model\UsersTable.php');
	require_once('..\model\StocksMutation.php');
	session_start();
	
	// session check
	$usersTable = new UsersTable();
	if($_SESSION['nip']=='' || $usersTable->checkSession($_SESSION['nip'])=='0'){
		session_destroy();
		header("Location: ../../index.php");
	}
	
	// get parameters
	$action = $_REQUEST['action'];
	$id = $_REQUEST['stockid'];
	if($action=="" || $ida=""){
		header("Location: ../view/StockOverview.php");
	}
	
	// redirect based on action
	if($action == "viewmutation"){
		$mutationData = new StocksMutation();
		$result = $mutationData->getStockMutation($id);
		$_SESSION['mutationData'] = $result;
		header("Location: ../view/ViewMutation.php");
	} else if($action == "updatestock"){
		$_SESSION['queryData'] = "";
		
	} else{
		header("Location: ../view/StockOverview.php");
	}
?>	