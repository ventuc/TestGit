<?php

// Definizione dell'interfaccia Forma
interface Forma {

// Disegna la forma
function disegna();

// Cambia il colore
function colore($colore);

}

// Definizione della classe Rettangolo
abstract class Rettangolo implements Forma {

public function disegna(){
// ... disegna il rettangolo ...
}

}

// Definizione della classe Cerchio
class Cerchio implements Forma {

public function disegna(){
// ... disegna il cerchio ...
}

public function colore($colore){
// ... imposta il colore ...
}

}

// Costruisco una Forma, un Rettangolo e un Cerchio
//$f = new Forma(); // Errore! Forma è un interfaccia
$c = new Cerchio(); // Ok
$c->disegna(); // Disegna il cerchio
$c->colore("verde"); // Imposta il colore

?>