<?php
	require_once("..\DBConnector.php");

	class Stocks{
		public $id;
		public $currencies_id;
		public $stock;
		public $harga;
		public $nama;
		public $quality;
		public $added_by;
		
		// getters
		public function getId(){
			return $this->id;
		}
		public function getCurrenciesid(){
			return $this->currencies_id;
		}
		public function getStock(){
			return $this->stock;
		}
		public function getHarga(){
			return $this->harga;
		}
		public function getNama(){
			return $this->nama;
		}
		public function getQuality(){
			return $this->quality;
		}
		public function getAddedby(){
			return $this->added_by;
		}
		
		// setters
		public function setId($val){
			$this->id = $val;
		}
		public function setCurrenciesid($val){
			$this->currencies_id = $val;
		}
		public function setStock($val){
			$this->stock = $val;
		}
		public function setHarga($val){
			$this->harga = $val;
		}
		public function setNama($val){
			$this->nama = $val;
		}
		public function setQuality($val){
			$this->quality = $val;
		}
		public function setAddedby($val){
			$this->added_by = $val;
		}
		
		// methods
		
		// dijalanin pada saat ada penjualan..jika penjualan > stock, maka ditolak
		public function checkStock($id){
			//$query = "select * from stocks where id = :id";
			$query = "
				select stk.*, curr.nama as 'satuan' from stocks stk 
				join currencies curr on stk.currencies_id = curr.id
				where stk.id = :id
			";
			$result = null;
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
			return $result[0];
		}
		
		public function getAllSellingData(){
			$query = "
				select stk.id, stk.nama, stk.stock,
					(
						select sum(amount) from stocks_mutation  -- mutation types 1 purchase, 2 stock adding
						where mutation_date between now() - interval 1 day and now()
						and mutation_types = 1
					) as 'day',
					(
						select sum(amount) from stocks_mutation  
						where mutation_date between now() - interval 7 day and now()
						and mutation_types = 1
					) as 'week',
					(
						select sum(amount) from stocks_mutation  
						where mutation_date between now() - interval 30 day and now()
						and mutation_types = 1
					) as 'month'
					from stocks stk
			";
			$result = null;
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
			return $result;
		}
		
		public function addStock($stockid, $amount){
			$query = "
				update stocks
				set stock = stock + :amount
				where id = :stockid
			";
					
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':amount', $amount);
				$stmt->bindParam(':stockid', $stockid);
				$stmt->execute();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
		}
	}
?>