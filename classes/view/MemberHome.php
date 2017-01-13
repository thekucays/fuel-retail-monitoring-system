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
	</head>
	<body>
		hello :)
	</body>
</html>