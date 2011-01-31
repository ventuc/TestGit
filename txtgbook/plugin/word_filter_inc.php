<?php
session_start();
if ($_SESSION['loggato'] == "si") {

if (@$_GET['azione'] == "elimina") {
	$codice = str_replace("||", " ", $_GET['codice']);
	$parole = "../smiley/parole.txt";
	$leggi = file_get_contents($parole);
	
	$contenuto = str_replace($codice, "", $leggi);
	$apri = @fopen("../smiley/parole.txt", "w+");
	$scrivi = @fwrite($apri, $contenuto);
	header("location: ../admin.php?aperto=si&sezione=plugin&nome=word_filter");
	
} elseif ($_POST['parola']) {
	$_POST['parola'] = trim($_POST['parola']);
	$_POST['replace'] = trim($_POST['replace']);
	$codice =  " - ".$_POST['parola']." ".$_POST['replace'];
	$apri = @fopen("../smiley/parole.txt", "a+");
	$scrivi = @fwrite($apri, $codice);
	header("location: ../admin.php?aperto=si&sezione=plugin&nome=word_filter");
}

}
?>