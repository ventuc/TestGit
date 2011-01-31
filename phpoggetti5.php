<?php

// Definizione della classe Animale

class Animale {

	private $specie;
	
	// Costruttore
	public function __construct($specie){
		$this->specie = $specie;
	}

	// Ritorna la specie
	public function getSpecie(){
		return $this->specie;
	}

	// Imposta la specie
	public function setSpecie($specie){
		$this->specie = $specie;
	}
	
	public function __destruct(){
		echo "muoio animale";
	}

}

// Definizione della classe Mammifero
class Mammifero extends Animale {
	private $corna;

	public function __construct($specie){
		$this->setSpecie($specie);
	}

	public function haCorna(){
		return $this->corna;
	}

	public function setCorna($corna){
		$this->corna = $corna;
	}
}

// Definizione della classe Uccello
class Uccello extends Animale {
	private $rapace;

	public function __construct($specie){
		$this->setSpecie($specie);
	}

	public function isRapace(){
		return $this->rapace;
	}

	public function setRapace($rapace){
		$this->rapace = $rapace;
	}
}

// Creo un animale

$anim = new Animale("giraffa");
// Cambio da giraffa a leone
$anim->setSpecie("Leone");
// Tento di impostare che il leone non ha corna
//$anim->setCorna(false); // Errore!!! setCorna() è di Mammifero, non di Animale

// Creo il leone come Mammifero
$mamm = new Mammifero("leone");
$mamm->setCorna(false); // Ok
// Cambio da leone a cervo
$mamm->setSpecie("cervo"); // Ok, setSpecie() ereditato
// Il cervo ha le corna
$mamm->setCorna(true); // Ok

// Creo un uccello
$ucc = new Uccello("gufo");
// Il gufo non ha corna
//$ucc->setCorna(false); // Errore! setCorna() non è di Uccello (non esiston uccelli con le corna)
// Il gufo non è rapace
$ucc->setRapace(false); // Ok

?>