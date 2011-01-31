<?php


// Definizione della classe MyClass

class MyClass {

	private $att1; // primo attributo

	private $att2; // secondo attributo


	// Costruttore
	public function __construct(){
		$att1 = null;
		$att2 = null;
	}	

	// Permette di impostare $att1
	public function setAtt1($val){
		$this->att1 = $val;
	}

	// Permette di impostare $att2
	public function setAtt2($val){
		$this->att1 = $val;
	}

	// Permette di leggere $att1
	public function getAtt1(){
		return $this->att1;
	}

	// Permette di leggere $att2
	public function getAtt2(){
		return $this->att2;
	}
	
	// Controlla la validità di $att1
	private function checkAtt1($a){
		// ... codice di controllo di $a ...
		// se valido ritorno true, altrimenti false
	}

}


?>
