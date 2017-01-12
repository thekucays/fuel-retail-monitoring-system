<?php
	class Subclass{
		public $id;
		public $tipe;
		
		// getters
		public function getId(){
			return $this->id;
		}
		public function getTipe(){
			return $this->tipe;
		}
		
		// setters
		public function setId($val){
			$this->id = $val;
		}
		public function setTipe($val){
			$this->tipe = $val;
		}
	}
?>