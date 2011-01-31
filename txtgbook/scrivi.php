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
$funzione->elabora_contenuto();
$funzione->carica_lingua();

include("plugin/rss_maker.php");
include("plugin/ban_check.php");
$ip_array = explode("|", $ip);
foreach($ip_array as $limi) {
	if ($_SERVER['REMOTE_ADDR'] == $limi) {
		define ("ban", "si");
	} 
}

$last = file_get_contents("antiflood.STAT");
$diff = mktime()-$last;
if ($diff <= $funzione->antiflood) {
	define ("flood", "si");
}

if ($_GET['quote'] != "") {
$num = 0;
$explode = explode("(|!|)", $funzione->contenuto);
	foreach ($explode as $val) {
		$num++;
		if  ($num == $_GET['quote']) {
			$dati = explode("||", $val);
			$dati[1] = str_replace("]<br />", "]", $dati[1]);
			$dati[1] = str_replace("<br />", chr(13), $dati[1]);
			$dati[1] = preg_replace('/\[quote\=(.*?)\](.*?)\[\\/quote]/', '', $dati[1]);
			$funzione->stringa_quote = '[quote='.$dati[0].']'.$dati[1].'[/quote]';
		}
	}
}

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="generator" content="Txtgbook Pro 1.0" />
<meta name="keywords" content="txtgbook guestbook php free gratis captcha antispam filtro smiley antispam skin template" />
<meta name="description" content="Un guestbook powered by Txtgbook 6.1" />
<title>'.$funzione->titolo.' :: '.$funzione->array_lingua['invia_mess'].'</title>	
';
$funzione->carica_css();
if ($attivo == "si") {
$urlsito = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
echo '<link rel="alternate" type="application/rss+xml" title="Feed Rss di '.$funzione->titolo.'" href="'.$urlsito.'" />';
}
echo '
<script type="text/javascript" language="javascript">
var max = '.$funzione->maxlenght.';
</script>
<script type="text/javascript" language="javascript" src="javascript.js"></script>
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


if (ban == "si") {
echo '<div class="box">
	<div class="separatore"></div>
	<span class="alert"><b>'.$funzione->array_lingua['messaggio_ban'].'<b/></span>
	<div class="separatore"></div>
</div>&nbsp;';
} elseif ($_GET['stato'] == "attesa") {
echo '<div class="box">
	<div class="separatore"></div>
	<span class="alert"><b>'.$funzione->array_lingua['in_attesa'].'<b/></span>
	<div class="separatore"></div>
</div>&nbsp;';
} elseif (flood == "si") {
echo '
<div class="box">
	<div class="separatore"></div>
	<span class="alert"><b>'.$funzione->array_lingua['antiflood'].'<b/></span>
	<div class="separatore"></div>
</div>&nbsp;
';
} else {
if ($_GET['stato'] == "privato") {
echo '
<div class="box">
	<div class="separatore"></div>
	<span class="alert">'.$funzione->array_lingua['nick_gia_usato'].'</span>
	<div class="separatore"></div>
</div>&nbsp;
';
} elseif ($_GET['mess'] == "1") {
echo '
<div class="box">
	<div class="separatore"></div>
	<span class="alert">'.$funzione->array_lingua['campi_richiesti'].'</span>
	<div class="separatore"></div>
</div>&nbsp;
';
} elseif ($_GET['codice'] == "errato") {
echo '
<div class="box">
	<div class="separatore"></div>
	<span class="alert">'.$funzione->array_lingua['codice_errato'].'</span>
	<div class="separatore"></div>
</div>&nbsp;
';
} else {
echo '
<div class="box">
	<div class="separatore"></div>
	'.$funzione->array_lingua['scrivi_mess'].'
	<div class="separatore"></div>
</div>&nbsp;
';

}

$funzione->box_scrittura();
$funzione->box_stat();
}
echo '
</body>
</html>
';
?>