<?php


// Definizione della classe MyClass

class Intero {

	public $valore; // valore dell'intero


	// Costruttore con il valore dato
	public function __construct($valore){
		$this->valore = $valore;
	}

}

// Definisco una funzione che aggiunge 10 ad un numero (tipo primitivo)
function incrementaNum($num){
	$num += 10;
	return $num;
}

// Definisco una funzione che aggiunge 10 al valore di un oggetto Intero
function incrementaInt($intero){
	$intero->valore += 10;
	return $intero;
}


// Creo un intero con valore 3
$intero = new Intero(3);

// Creo un numero con valore 3
$num = 3;

// Incremento $num
incrementaNum($num);
echo $num; // Sia PHP 4 che PHP 5 stampano 3

// Incremento $intero
incrementaInt($intero);
echo $intero->valore; // PHP 4 stampa 3, PHP 5 stampa 13

// Passaggio per riferimento
function &incrementaNumRef(&$num){
	$num += 10;
	return $num;
}


$a = 3;
incrementaNumRef($a);
echo $a; // Stampa 13 sia in PHP 4 che in PHP 5;

$int1 = new Intero(3);
$int2 = new Intero(3);
echo $int1 == $int2;

$int1 = new Intero(3);
$int2 = clone $int1;
echo $int2->valore;

?>
