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
$funzione->leggi_file();
$funzione->header_impaginazione();
$funzione->carica_lingua();
$funzione->elabora_contenuto();
$funzione->elabora_smiley();

include("plugin/rss_maker.php");
include("plugin/easy_backup_inc.php");
include("plugin/ban_check.php");
$ip_array = explode("|", $ip);
foreach($ip_array as $limi) {
	if ($_SERVER['REMOTE_ADDR'] == $limi) {
		define ("ban", "si");
	} 
}

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
<title>'.$funzione->titolo.'</title>	
';
$funzione->carica_css();
if ($attivo == "si") {
$urlsito = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
echo '<link rel="alternate" type="application/rss+xml" title="Feed Rss di '.$funzione->titolo.'" href="'.$urlsito.'" />';
}
?>
<script type="text/javascript" language="javascript" src="javascript.js"></script>
<?php

echo '</head>
<body '.$onload.'>';

echo '<div id="head"><img src="head.gif" /></div>';

/**
echo '
<body '.$onload.'>
<div class="box">
	<div class="separatore_titolo"></div><a href="index.php" class="title">';
	$funzione->mostra_titolo();	
	echo '</a><br />&nbsp;<br />| <a href="#" onclick="apri_box()"><b>'.$funzione->array_lingua['amministrazione'].'</b></a> |';
	if ($attivo == "si") { 
	echo '&nbsp;<a href="rss.php"><b>'.$funzione->array_lingua['feed_rss'].'</b></a> |'; 
	}
	echo '<div class="separatore_titolo"></div>
</div>&nbsp;
';

echo '<div align="center" id="div" style="display:none">';
echo $funzione->ricava_box($_SESSION['loggato']);
echo '</div>&nbsp;';
**/

if ($_GET['installazione'] == "completa") {
echo '
<div class="box">
	<div class="separatore"></div>
	<b><font color="red">'.$funzione->array_lingua['installazione_completa'].'</font></b>
	<div class="separatore"></div>
</div>&nbsp;';
}

if ($_GET['login'] == "fallito") {
$funzione->login_fallito();
}

if (ban == "si") {
echo '<div class="box">
	<div class="separatore"></div>
	<b><font color="red">'.$funzione->array_lingua['messaggio_ban'].'</font></b>
	<div class="separatore"></div>
</div>&nbsp;';
} else {

$funzione->box_frecce();
$funzione->box_pagine_su();
$funzione->mostra_mess();
$funzione->box_pagine_giu();
$funzione->box_frecce();
$funzione->box_info();
$funzione->box_stat();

}

echo '
<div class="box">
	<!--<div class="separatore_titolo"></div><a href="index.php" class="title">';
	$funzione->mostra_titolo();	
	echo '</a><br />&nbsp;--><br />| <a href="#" onclick="apri_box()"><b>'.$funzione->array_lingua['amministrazione'].'</b></a> |';
	if ($attivo == "si") { 
	echo '&nbsp;<a href="rss.php"><b>'.$funzione->array_lingua['feed_rss'].'</b></a> |'; 
	}
	echo '<div class="separatore_titolo"></div>
</div>&nbsp;
';

echo '<div align="center" id="div" style="display:none">';
echo $funzione->ricava_box($_SESSION['loggato']);
echo '</div>&nbsp;';

echo '
</body>
</html>
';
?>