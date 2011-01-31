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

if (!$_POST['mail']) {

$testo = "";
	$caratteri = array(1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,h,i,l,m,n,o,p,r,s,t,u,v,z);
	for ($i = 0; $i < 5; $i++) {
	$numero = rand(0,29);
	$testo .= $caratteri[$numero]." ";
	$ghx .= $caratteri[$numero];
	}


echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="generator" content="Txtgbook 6.5" />
<meta name="keywords" content="txtgbook guestbook php free gratis captcha antispam filtro smiley antispam skin template" />
<meta name="description" content="Un guestbook powered by Txtgbook 6.1" />
<title>'.$funzione->titolo.' :: Email</title>	
';
$funzione->carica_css();

echo '
</head>
<body>
<div class="box">
	<div class="separatore_titolo"></div><a href="index.php" class="title">';
	$funzione->mostra_titolo();	
	echo ' | '.$funzione->array_lingua['invia_mail'].'</a><br />&nbsp;<br />
	| <a href="#" onclick="window.close()"><b>'.$funzione->array_lingua['chiudi'].'</b></a> |
	<div class="separatore_titolo"></div>
</div>&nbsp;
';

if (ban == "si") {
echo '<div class="box">
	<div class="separatore"></div>
	<b><font color="red">'.$funzione->array_lingua['messaggio_ban'].'</font></b>
	<div class="separatore"></div>
</div>&nbsp;';
} elseif ($_GET['inviata'] == "si") {
echo '<div class="box">
	<div class="separatore"></div>
	<b><font color="red">'.$funzione->array_lingua['mail_inviata'].'</font></b>
	<div class="separatore"></div>
</div>&nbsp;';
} elseif ($_GET['inviata'] == "no") {
echo '<div class="box">
	<div class="separatore"></div>
	<b><font color="red">Error! Please try later</font></b>
	<div class="separatore"></div>
</div>&nbsp;';
} else {
$skin = $funzione->skin;
echo '
<form method="post" action="manda_mail.php" name="form" style="display:inline;">
<input type="hidden" name="mail" value="'.$_GET['mail'].'" />
<div class="tabella"></div>
<div class="box">
	<div class="separatore"></div>
	<table width="97%" border="0" align="center" cellspacing="0" cellpadding="0">
   		<tr>
   		<td width="28%" align="left" valign="top">
			<div align="center"><b>'.$funzione->array_lingua['oggetto'].'</b><br /><input type="text" name="oggetto" value="" /><br /><b>'.$funzione->array_lingua['tua_mail'].'</b><br /><input type="text" name="sender_mail" value="" />
			<br />&nbsp;<br /><b>'.$funzione->array_lingua['codice_verifica'].'</b><br /><img src="codice.php?testo='.$testo.'" border="0" alt="" /><br /><input type="text" name="codice" /><input type="hidden" name="ghx" value="'.$ghx.'" /><br />&nbsp;
</div>
		</td>
		<td width="1%" valign="top" class="linea" align="left"></td>
    	<td width="71%" valign="top" align="left">
				<div align="center"><b>'.$funzione->array_lingua['testo_mail'].'</b></div>
				<textarea name="testo" style="width: 99%" rows="9" cols=""></textarea>
		</td>
 		</tr>
	</table>
	<div class="separatore"></div>
</div>&nbsp;
<div style="display:none">
	<input type="text" name="username" value="" />
</div>
<div class="box">
	<div class="separatore"></div>
	<input type="submit" name="invia" value="'.$funzione->array_lingua['invia_mail'].'" />
	<div class="separatore"></div>
</div>
</form>&nbsp;
';

}
echo '
</body>
</html>
';

} else {
$destinatario = trim($_POST['mail']);
$oggetto = trim($_POST['oggetto']);
$sender_mail = trim($_POST['sender_mail']);
$testo = trim($_POST['testo']);

if ($_POST['codice'] != $_POST['ghx']) {
header("location: manda_mail.php");
} else {
$header = "To: <".$destinatario.">\n";
$header .= "From: <".$sender_mail.">\n";
if (mail($destinatario, $oggetto, $testo, $header)) {
header("location: manda_mail.php?inviata=si");
} else {
header("location: manda_mail.php?inviata=no");
}
}
}
?>