<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>
<body>
<?php 
/*QUESTO E' IL TESTO DEL LIBRO:
PER DEFINIRE UN ARRAY ASSOCIATIVO CON LA FUNZIONE ARRAY(), è NECESSARIO DEFINIRE PER OGNI ELEMENTO SIA LA CHIAVE CHE IL VALORE. IL CODICE SEGUENTE CREA UN ARRYA ASSOCIATIVO, CHIAMATO $CHARACTER, E VI INSERISCE QUATTRO ELEMENTI:
$character=array(
			name=>"bob,
			occupation=>"superhero",
			age=>30,
			"special power"=>"x-ray vision"
				);
A QUESTO PUNTO è POSSIBILE ACCEDERE A UNO QUALSIASI DEGLI ELEMENTI DI $CHARACTER:
print $character[age];

LE CHIAVI DI UN ARRAY ASSOCIATIVO SONO STRINGHE, MA NN è NECESSARIO KE SIANO RACCHIUSE TRA APICI,A MENO KE NN SIANO FORMATE DA + PAROLE


IO HO SCIRTTO LA PORZIONE DI CODICE MA MI DA ERRORE ALLA RIGA 28 QUANDO LA MANDO IN ESECUZIONE.PERCHE'????*/


$character=array(
			"name"=>"bob",
			'occupation'=>"superhero",
			'age'=>30,
			'special power'=>"x-ray vision"
				);
print $character['age'];
?>
</body>
</html>
