<?php
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
	}
?>