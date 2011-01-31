<?php

// Definizione della classe MyClass

class MyClass {

	public static $att1; // attributo statico public
	protected static $att2; // attributo statico protected (visibile solo alle sottoclassi)
	private static $att3; // attributo statico private (visibile solo da questa classe)

	// Metodo statico public
	public static function metodo1($a){
		echo "pubblico".$a;
	}
	
	// Metodo statico protetto (visibile solo alle sottoclassi)
	protected static function metodo2($a){
		echo "protetto".$a;
	}
	
	// Metodo statico privato (visibile solo da questa classe)
	private static function metodo3($a){
		echo "privato".$a;
	}

}


$a = 5;

// Imposto $att1, $att2, e $att3
MyClass::$att1 = $a; // Ok
MyClass::$att2 = $a; // Errore! $att2 è protected
MyClass::$att3 = $a; // Errore! $att3 è private

// Chiamo il metodo statico pubblico
MyClass::metodo1($a); // Stampa "pubblico5"
// Chiamo il metodo statico protett
MyClass::metodo2($a); // Errore! metodo2() è protected
// Chiamo il metodo statico privato
MyClass::metodo3($a); // Errore! metodo3() è private

?>
