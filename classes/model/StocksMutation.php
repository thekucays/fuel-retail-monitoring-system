<?php
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
	}
?>