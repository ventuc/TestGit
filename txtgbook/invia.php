<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
session_start();
include("funzioni.php");
$funzione = new funzioni();
$funzione->preleva_info();

$nome = $_POST['autore'];
$mail = $_POST['mail'];
$sito = $_POST['sito'];
$mess = $_POST['mess'];
$username = $_POST['username'];
$ora = (date("G:i"));
$data = (date("d-m-y"));
$ip = $_SERVER['REMOTE_ADDR'];
$codice = $_POST['codice'];
$ghx = $_POST['ghx'];

$_SESSION['a'] = $nome;
$_SESSION['b'] = $mess;

	$field_adder = "";
	$fread = file_get_contents("plugin/field_adder.php");
	$p = explode("|", $fread);
	foreach ($p as $t) {
	if ($t != "") {
	$t = $funzione->formatta_testo($t);
	$field_adder .= "|".str_replace("|", "", $_POST[''.trim($t).'']);
	}
	}	
	$field_adder = "|".$field_adder;
	

if ($funzione->verifica_privato($nome) == "si") {
	header("location: scrivi.php?stato=privato");
} elseif (strtolower(trim($codice)) != strtolower(trim($ghx)))  {
	header("location: scrivi.php?codice=errato");
} else {


$check = $funzione->verifica_validatura();
if ($check == "si") { $stato = "attesa"; } else { $stato = "confermato"; }

$verifica_se_annuncio = $funzione->verifica_annuncio($nome);
if ($verifica_se_annuncio == "si") {
$stato = "confermato";
}

$controllo_spam = $funzione->verifica_spam($username);
$mail_ok = $funzione->mail_ok($mail);
$errori_field_adder = $funzione->verifica_field_adder($field_adder);
$verifica_campi = $funzione->verifica_campi($nome, $mess, $mail, $sito);

if ($verifica_campi == "si" AND $errori_field_adder != "si") {
	$nome = $funzione->formatta_testo($nome);
	$mail = $funzione->formatta_testo($mail);
	$sito = $funzione->formatta_testo($sito);
	$mess = $funzione->formatta_testo($mess);
	
	$stringa = $funzione->genera_stringa($nome, $mail, $sito, $data, $ora, $ip, $mess, $stato, $field_adder);
	
	$funzione->leggi_file();
	
	if ($controllo_spam == "superato") {
	$totale = "".$stringa."".$funzione->contenuto."";
	} else {
	$totale = $funzione->contenuto;
	}
	
	$fopen = fopen("antiflood.STAT", "w+");
	$fwrite = fwrite($fopen, mktime());
	fclose($fopen);
	$_SESSION['a'] = "";
	$_SESSION['b'] = "";
	
	$funzione->apri_file("w+");
	$funzione->scrivi($totale);	
	$funzione->notifica($nome, $mess);
	if ($stato == "confermato") {
	header("location: index.php?$x");
	} else {
	header("location: scrivi.php?stato=attesa");
	}
} else {
	header("location: scrivi.php?mess=1");
}
}
?>