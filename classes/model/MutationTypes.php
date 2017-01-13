<?php
	class MutationTypes{
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
	}
?>