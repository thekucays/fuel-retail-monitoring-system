<?php
	require_once('..\model\UsersTable.php');
	
	$nip = $_POST['nip'];
	$pass = $_POST['pass'];
	
	$userLogin = new UsersTable();
	$userLogin->setNip($nip);
	$userLogin->setPass(md5($pass));
	
	$hasil = $userLogin->login($userLogin);
	$admin = "A";
	$member = "M";
	
	try{
		if($hasil[0]['tipe'] == $member){
			echo "is member";
		} else if($hasil[0]['tipe'] == $admin){
			echo "is admin";
		} else{
			echo "not allowed";
		}
	} catch(Exception $e){
		echo "result null";
	}
?>	