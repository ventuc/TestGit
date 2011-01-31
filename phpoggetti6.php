<?php


// Definizione della classe Animale

class Animale {

	private $specie;


	// Costruttore
	public function __construct($specie){
		$this->specie = $specie;
		echo "animale";
	}

	// Ritorna la specie
	public function getSpecie(){
		return $this->specie;
	}

	// Imposta la specie
	public function setSpecie($specie){
		$this->specie = $specie;
	}

}

// Definizione della classe Mammifero
class Mammifero extends Animale {
	private $corna;

	public function __construct($specie){
		$this->setSpecie($specie);
	}

	public function setSpecie($specie){
		if ($specie != "leone" && $specie != "leonessa"){
			die();
		}
		parent::setSpecie($specie);
	}

	public function haCorna(){
		return $this->corna;
	}

	public function setCorna($corna){
		$this->corna = $corna;
	}
}

// Creo un "leone" e una "leonessa"
$mamm = new Mammifero("leone"); // Ok
$mamm = new Mammifero("leonessa"); // Ok
// Creo una "tigre"
$mamm = new Mammifero("tigre"); // die()

// Creo una tigre come se fosse un animale qualunque
$mamm = new Animale("tigre"); // Ok, nel setSpecie() di Animale non ci sono controlli

// Definizione della classe Uccello
class Uccello extends Animale {
	private $rapace;

	public function isRapace(){
		return $this->rapace;
	}

	public function setRapace($rapace){
		$this->rapace = $rapace;
	}
}

// Costruisco un Mammifero e un Uccello
$mamm = new Mammifero("Leone"); // Stampa "animale"
$ucc = new Uccello("Gufo"); // Stampa "animale"


// Una classe non ereditabile

final class MyFinalClass {



	// ... codice della classe ...
	// metodo con override non permesso
	public final function metodo(){
		// ... codice del metodo ...
	}


}

// Una classe ereditabile

class MyClass {



	// metodo con override non permesso
	public final function metodo(){
		// ... codice del metodo ...
	}


}

// Tento di estendere MyFinalClass
class MyFinalClass2 extends MyFinalClass { // Fatal error, MyFinalClass non è ereditabile
	
	// ... codice della classe ...

}

// Estendo MyClass
class MyClass2 extends MyClass { // Ok, MyClass è ereditabile
	
	// Tento l'override di metodo()
	public function metodo(){ // Errore, metodo() non permette l'override
		// ... codice del metodo ...
	}

}


?>
