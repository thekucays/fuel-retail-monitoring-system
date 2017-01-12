<?php
	require_once("classes\DBConnector.php");
	
	$DBCon = new DBConnector();
	$con = $DBCon->initConnection();
?>

<html>
	<head>
		<title> Fuel Retail v0.1 Login Page</title>
	</head>
	<body>
		Silahkan Login
		<form name="loginform" method="post" id="loginform" action="classes\controller\LoginController.php">
			<table>
				<tr>
					<td> NIP </td>
					<td> <input type="text" name="nip" id="nip" /> </td>
				</tr>
				<tr>
					<td> Password </td>
					<td> <input type="password" name="pass" id="pass" /> </td>
				</tr>
				<tr>
					<td colspan=2>
						<input type="submit" value="login" />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>