<?php
	class DBConnector{
		// konfigurasi utama ke database
		private $server = 'localhost';
		private $username = 'emoney';
		private $password = '3m0n3y';
		private $databaseName = 'antarfuelretail';
				
		private $conn = null;
			
		public function initConnection(){
			try{
				$conn = new PDO("mysql:host=$this->server;dbname=$this->databaseName", 
							$this->username, $this->password);
				return $conn;
			} catch(PDOException $pEx){
				echo "PDO connection failed.";
			}
		}
		
		public function closeConnection($conn){
			if($conn != null){
				$conn->close();
				echo "PDO connection closed";
			}
		}
	}
?>