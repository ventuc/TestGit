<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
$tempo = 300;

if (!file_exists("online.stat")) {
$crea = @fopen("online.stat", "w+");
}
$totale = time();
$ip = $_SERVER['REMOTE_ADDR'];
$output = "";
$i = 0;
$contenuto = @file_get_contents("online.stat");
$explode = explode("\/", $contenuto);
foreach ($explode as $info) {
$dati = explode("|", $info);
if ($dati[0] != "") {
$differenza = $totale-$dati[1];
if ($differenza >= $tempo) {
$output .= "";
} else {
$output .= "$dati[0]|$dati[1]\/";
}
$i++;
if ($dati[0] == $ip) {
$esiste = "si";
}
}
}

if ($esiste != "si") {
$output .= "$ip|$totale\/";
}
$fopen = @fopen("online.stat", "w+");
$scrivi = @fwrite($fopen, $output);
$chiudi = @fclose($fopen);

$online = $i;
if ($online == 0) {
$online++;
}
?>