<?php
	require_once('..\model\UsersTable.php');
	session_start();
	
	echo $_SESSION['nip'];
	
	// invalidate session in database
	$logout = new UsersTable();
	$logout->invalidateSession($_SESSION['nip']);
	
	session_destroy();
	header("Location: ../../index.php");
?>