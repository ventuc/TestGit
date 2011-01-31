<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>

<body>

<?php


// Definizione della classe MyClass

class MyClass {

	var $att1; // primo attributo

	var $att2; // secondo attributo



	// Costruttore
	function __construct(){

		$this->att1 = 10;

		$this->att2 = null;
	}

	// Definizione di un metodo
	function myMethod(){
		echo "Sono un metodo";
	}

	// Distruttore
	function __destruct(){
		// ... codice del distruttore ...
	}

}

?>

</body>
</html>
