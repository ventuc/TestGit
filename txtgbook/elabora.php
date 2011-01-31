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



if ($funzione->verifica_login($_SESSION['user'], $_SESSION['pass']) == "si" OR $_SESSION['loggato'] == "mod") {


if ($_GET['azione'] == "elimina") {
$num = $_GET['num'];
$funzione->leggi_file();
$stringa = $funzione->stringa_da_num($num);
$funzione->apri_file("w+");
$funzione->elimina($stringa);
header("location: index.php?aperto=si");



} elseif ($_GET['azione'] == "elimina_smiley") {
$codice = str_replace("||", " ", $_GET['codice']);
$funzione->elimina_smiley($codice);
header("location: admin.php?aperto=si&sezione=smiley");



} elseif ($_GET['azione'] == "aggiungi_smiley") {
$img = $_POST['img'];
$codice = $_POST['codice'];
$totale = " - $img $codice";
$funzione->aggiungi_smiley($totale);
header("location: admin.php?aperto=si&sezione=smiley");



} elseif ($_GET['azione'] == "valida") {
$num = $_GET['num'];
$funzione->leggi_file();

$stringa_old = $funzione->stringa_da_num($num);
$stringa = str_replace("attesa", "confermato", $stringa_old);
$funzione->apri_file("w+");
$funzione->sovrascrivi($stringa, $stringa_old);

header("location: index.php?aperto=si");


} else {
$nome = $_POST['autore'];
$mail = $_POST['mail'];
$sito = $_POST['sito'];
$mess = $_POST['mess'];
$num = $_POST['num'];
$data = $_POST['data'];
$ora = $_POST['ora'];
$ip = $_POST['ip'];
$stato = "confermato";

$autore_old = $_POST['autore_old'];
$mess_old = $_POST['mess_old'];
$mail_old = $_POST['mail_old'];
$sito_old = $_POST['sito_old'];

$nome = $funzione->formatta_testo($nome);
$mail = $funzione->formatta_testo($mail);
$sito = $funzione->formatta_testo($sito);
$mess = $funzione->formatta_testo($mess);

$funzione->leggi_file();

$funzione->apri_file("w+");

$p = $funzione->stringa_da_num($num);
$t = explode("||", $p);
$field_adder = "||".$t[8];
$stringa = $funzione->genera_stringa($nome, $mail, $sito, $data, $ora, $ip, $mess, $stato, $field_adder);
$stringa_old = $funzione->stringa_da_num($num);

$funzione->sovrascrivi($stringa, $stringa_old);

header("location: index.php");

}

} else {
header("location: index.php?aperto=si");
}
?>