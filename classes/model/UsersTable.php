<?php
	require_once("..\DBConnector.php");

	class UsersTable{
		public $nip;
		public $nama;
		public $alamat;
		public $pass;
		public $subclass;
		public $last_login;
		public $is_logged;
		
		// getters
		public function getNip(){
			return $this->nip;
		}
		public function getNama(){
			return $this->nama;
		}	
		public function getAlamat(){
			return $this->alamat;
		}
		public function getPass(){
			return $this->pass;
		}
		public function getSubclass(){
			return $this->subclass;
		}
		public function getLastlogin(){
			return $this->last_login;
		}
		public function getIslogged(){
			return $this->is_logged;
		}
		
		// setters
		public function setNip($val){
			$this->nip = $val;
		}
		public function setNama($val){
			$this->nama = $val;
		}
		public function setAlamat($val){
			$this->alamat = $val;
		}
		public function setPass($val){
			$this->pass = $val;
		}
		public function setSubclass($val){
			$this->subclass = $val;
		}
		public function setLastlogin($val){
			$this->last_login = $val;
		}
		public function setIslogged($val){
			$this->is_logged = $val;
		}
		
		// methods'
		public function login($userObj){
			$result = null;
			$query = "select sb.tipe from users_table ut
					join subclass sb on ut.subclass = sb.id
					where nip= :nip and pass= :pass";
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$nip = $userObj->getNip();
				$pass = $userObj->getPass();
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':nip', $nip);
				$stmt->bindParam('pass', $pass);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
			return $result;
		}
		
		public function updateLastLogin($nip){
			$query = "update users_table
					set last_login = now(), is_logged = '1'
					where nip = :nip";
			
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':nip', $nip);
				$stmt->execute();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
		}
		
		public function invalidateSession($nip){
			$query = "update users_table
					set is_logged = '0'
					where nip = :nip";
					
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->execute();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
		}
	
		public function checkSession($nip){
			$query = "select is_logged from users_table
					where nip = :nip";
					
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':nip', $nip);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
		}
	} 
?>