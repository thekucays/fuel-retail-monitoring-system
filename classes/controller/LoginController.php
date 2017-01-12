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
		if(isset($hasil[0]['tipe'])){
			if($hasil[0]['tipe'] == $member){
				echo "is member";
				header("Location: tes.php");
			} else if($hasil[0]['tipe'] == $admin){
				echo "is admin";
			} else{
				echo "not allowed";
			}
		} else{
			
		}
	} catch(Exception $e){
		echo "result null";
	}
?>	