<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
$vettore = array(
'MSIE 2' => 'IE 2',
'MSIE 3' => 'IE 3',
'MSIE 4.5' => 'IE 4.5',
'MSIE 4' => 'IE 4',
'MSIE 5.5' => 'IE 5.5',
'MSIE 5' => 'IE 5',
'MSIE 6.0' => 'IE 6',
'MSIE 7' => 'IE 7',
'Lynx' => 'Lynx',
'Links' => 'Links',
'amaya' => 'Amaya',
'Konqueror' => 'Konqueror',
'Epiphany' => 'Epiphany',
'Galeon' => 'Galeon',
'Avant Browser' => 'Avant Browser',
'Googlebot' => 'Googlebot',
'Safari' => 'Safari',
'Wget' => 'Wget',
'Opera' => 'Opera',
'Netscape/7' => 'Netscape 7',
'Netscape7' => 'Netscape 7',
'Netscape/6' => 'Netscape 6',
'Netscape6' => 'Netscape 6',
'Netscape/5' => 'Netscape 5',
'Mozilla/4' => 'Netscape 4',
'Mozilla/3' => 'Netscape 3',
'Firebird' => 'Mozilla',
'Firefox' => 'Firefox',
'Mozilla' => 'Mozilla');

$chiave =  $_SERVER["HTTP_USER_AGENT"];

$contatore = 1;
$temp = array_keys($vettore);
$conteggio = count($temp);		
while($contatore < $conteggio) {
if (strstr($chiave, $temp[$contatore])) {
$browser = $vettore[$temp[$contatore]];
return;
} else {
$browser = "N/d";
}	
$contatore++;
}
?>
