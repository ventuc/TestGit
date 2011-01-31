<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
session_start();
error_reporting(4);

include("funzioni.php");
$funzione = new funzioni();
$funzione->preleva_info();
$funzione->carica_lingua();
$funzione->leggi_file();
$funzione->elabora_in_attesa();

$loggato = $funzione->verifica_login($_SESSION['user'], $_SESSION['pass']);
if ($loggato == "si") {

if ($_GET['aperto'] == "si") {
$onload = "onload=\"apri_box()\"";
}

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="generator" content="Txtgbook Pro 1.0" />
<meta name="keywords" content="txtgbook guestbook php free gratis captcha antispam filtro smiley antispam skin template" />
<meta name="description" content="Un guestbook powered by Txtgbook 6.1" />
<title>'.$funzione->titolo.' :: '.$funzione->array_lingua['admin_area'].'</title>	
';
$funzione->carica_css();
?>
<script type="text/javascript" language="javascript" src="javascript.js"></script>
<?php
echo '
</head>
<body '.$onload.'>
<div class="box">
	<div class="separatore_titolo"></div><a href="index.php" class="title">';
	$funzione->mostra_titolo();	
	echo '</a><br />&nbsp;<br />
	| <a href="index.php"><b>'.$funzione->array_lingua['torna_al_gb'].'</b></a> | <a href="#" onclick="apri_box()"><b>'.$funzione->array_lingua['amministrazione'].'</b></a> |
	<div class="separatore_titolo"></div>
</div>&nbsp;
<div align="center" id="div" style="display:none">';
echo $funzione->ricava_box($_SESSION['loggato']);
echo '</div>&nbsp;';

if ($_GET['sezione'] == "validazione") {
$funzione->mostra_mess();
} elseif ($_GET['sezione'] == "smiley") {
$funzione->box_smiley();
} elseif ($_GET['sezione'] == "scrivi_annuncio") {
$funzione->scrivi_annuncio();
} elseif ($_GET['sezione'] == "plugin" AND $_GET['nome'] != "") {
$funzione->plugin($_GET['nome']);
} elseif ($_GET['sezione'] == "plugin") {
$funzione->plugin("");
} elseif ($_GET['sezione'] == "impostazioni") {
$funzione->box_impostazioni();
} else {
$funzione->box_home();
}
$funzione->box_stat();
echo '
</body>
</html>
';
} else {
header("location: index.php");
}
?>