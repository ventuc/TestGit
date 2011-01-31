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
$funzione->elabora_smiley();
$funzione->mostra_smiley();
$funzione->leggi_file();
$funzione->carica_lingua();

if ($funzione->verifica_login($_SESSION['user'], $_SESSION['pass']) == "si" OR $_SESSION['loggato'] == "mod") {

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="generator" content="Txtgbook Pro 1.0" />
<meta name="keywords" content="txtgbook guestbook php free gratis captcha antispam filtro smiley antispam skin template" />
<meta name="description" content="Un guestbook powered by Txtgbook 6.1" />
<title>'.$funzione->titolo.'</title>	
';
$funzione->carica_css();
echo '
<script language="JavaScript" type="text/JavaScript">
function smiley(code) {
 var testo = document.form.mess.value; 
 this.code = code;
 document.form.mess.value = testo + code;
}
</script>
</head>
<body>
<div class="box">
	<div class="separatore_titolo"></div><a href="index.php" class="title">';
	$funzione->mostra_titolo();	
	echo '</a><br />&nbsp;<br />
	| <a href="scrivi.php"><b>'.$funzione->array_lingua['scrivi_nuovo_mess'].'</b></a> | <a href="index.php"><b>'.$funzione->array_lingua['torna_al_gb'].'</b></a> |
	<div class="separatore_titolo"></div>
</div>&nbsp;
';

if ($_GET['stato'] == "attesa") {

} else {

if ($_GET['mess'] == "1") {
echo '
<div class="box">
	<div class="separatore"></div>
	<span class="alert">'.$funzione->array_lingua['nick_richiesto'].'</span>
	<div class="separatore"></div>
</div>&nbsp;
';
} else {
echo '
<div class="box">
	<div class="separatore"></div>
	'.$funzione->array_lingua['modifica_mess'].' #'.$_GET['num'].'
	<div class="separatore"></div>
</div>&nbsp;';

}
$funzione->info_mess($_GET['num']);
$funzione->box_stat();
}
echo '
</body>
</html>
';

} else {
header("location: index.php?aperto=si");
}
?>