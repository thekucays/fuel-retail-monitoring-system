<?php
	require_once('..\model\UsersTable.php');
	session_start();
	
	$nip = $_POST['nip'];
	$pass = $_POST['pass'];
	
	$userLogin = new UsersTable();
	$userLogin->setNip($nip);
	$userLogin->setPass(md5($pass));
	
	$hasil = $userLogin->login($userLogin);
	$admin = "A";
	$member = "M";
	
	try{
		if(isset($hasil[0]['tipe'])){
			// save user session, and update last login
			$_SESSION['nip'] = $nip;
			$_SESSION['subclass'] = $hasil[0]['tipe'];
			$userLogin->updateLastLogin($nip);
		
			if($hasil[0]['tipe'] == $member){
				header("Location: ../view/MemberHome.php");
			} else if($hasil[0]['tipe'] == $admin){
				header("Location: ../view/AdminHome.php");
			} else{
				echo "not allowed";
			}
		}
	} catch(Exception $e){
		echo "result null";
	}
?>	