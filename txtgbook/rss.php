<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
include('plugin/rss_maker_inc.php'); 
include("config.php");
include("plugin/rss_maker.php");

if ($attivo == "si") {
$r = new rss_maker($titolo, $path, $titolo.' :: Archivio messaggi');
$fread = file_get_contents("mess.php");
$explode = explode("(|!|)", $fread);
$i = 0;
foreach($explode as $t) {
	$i++;
	if ($t != "" AND $i <= $numero) {
	$m = explode("||", $t);
	$m[1] = htmlspecialchars($m[1]);
	$r->aggiungi_mess("Messaggio di ".$m[0], $path, $m[1], $m[0]);
}
}
$r->Output();
} else {
header("location: index.php");
}
?>