<?php
	require_once("..\DBConnector.php");
	
	class StocksMutation{
		public $id;
		public $mutation_date;
		public $nip;
		public $amount;
		public $mutation_types;
		public $stocks_id;
		
		// getters
		public function getId(){
			return $this->id;
		}
		public function getMutationdate(){
			return $this->mutation_date;
		}
		public function getNip(){
			return $this->nip;
		}
		public function getAmount(){
			return $this->amount;
		}
		public function getMutationtypes(){
			return $this->mutation_types;
		}
		public function getStocksid(){
			return $this->stocks_id;
		}
		
		// setters
		public function setId($val){
			$this->id = $val;
		}
		public function setMutationdate($val){
			$this->mutation_date = $val;
		}
		public function setNip($val){
			$this->nip = $val;
		}
		public function setAmount($val){
			$this->amount = $val;
		}
		public function setMutationtypes($val){
			$this->mutation_types = $val;
		}
		public function setStocksid($val){
			$this->stocks_id = $val;
		}
		
		// methods
		public function getStockMutation($mutation_id){
			$query = "
				select stk.id, stk.nama, stk.stock, curr.nama as 'satuan', stm.mutation_date, stm.amount, ut.nip, ut.nama as 'namapegawai', mt.nama as 'mutation_types'
				from stocks_mutation stm
					join stocks stk on stm.stocks_id = stk.id
					join currencies curr on stk.currencies_id = curr.id
					join users_table ut on ut.nip = stk.added_by
					join mutation_types mt on stm.mutation_types = mt.id
				where stk.id = :id
			";
			$result = null;
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':id', $mutation_id);
				$stmt->execute();
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC); 
				$result = $stmt->fetchAll();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
			return $result;
		}
		
		public function addStockMutation($nip, $amount, $mtype, $sid){
			$query = "
				insert into stocks_mutation (mutation_date, nip, amount, mutation_types, stocks_id)
				values(
					now(), :nip, :amount, :mtype, :sid
				)
			";
			
			try{
				$DBCon = new DBConnector();
				$conn = $DBCon->initConnection();
				$mtype = "2";
				
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':nip', $nip);
				$stmt->bindParam(':amount', $amount);
				$stmt->bindParam(':nip', $nip);
				$stmt->bindParam(':mtype', $mtype);
				$stmt->bindParam(':sid', $sid);
				$stmt->execute();
			} catch(PDOException $pEx){
				echo "Got PDO Exception: " . $pEx->getMessage();
			}
		}
	}
?>