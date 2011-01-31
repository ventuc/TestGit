<?php

class Single {

	private static $singleton = null;
	
	private $var;
	
	static function getInstance(){
		if (Single::$singleton == null){
			Single::$singleton = new Single();
		}
		return Single::$singleton;
	}
	
	function __construct(){
		$this->var = rand();
	}
	
	function getVar(){
		return $this->var;
	}
}

// Primo get
$single = Single::getInstance();
echo "Primo get: ".$single->getVar()."<br />";

// Secondo get
$single = Single::getInstance();
echo "Secondo get: ".$single->getVar()."<br />";

?>