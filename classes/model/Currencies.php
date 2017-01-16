<?php
	class Currencies{
		public $id;
		public $nama;
		
		// getters
		public function getId(){
			return $this->id;
		}
		public function getNama(){
			return $this->nama;
		}
		
		// setters
		public function setId($val){
			$this->id = $val;
		}
		public function setNama($val){
			$this->nama = $val;
		}
		
		// methods
		public function getCurrenciesList(){
			$query = "select * from currencies";
			$result = null;
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
			return $result;
		}
	}
?>