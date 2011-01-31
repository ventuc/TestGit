<?php
session_start();
if ($_SESSION['loggato'] == "si") {


if (@$_POST['scadenza']) {

$scadenza = $_POST['scadenza'];
$giorno =(date("d"));
$mese =(date("m"));

$cont = file_get_contents("../mess.php");
$fopen = fopen("mess.php", "w+");
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);

$fopen = fopen("easy_backup.php", "w+");
$cont = '<?php
$scadenza = "'.$scadenza.'";
$eseguito = "'.$giorno.'/'.$mese.'";
?>
';
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=easy_backup");


} elseif (@$_GET['azione'] == "scarica") {
$filename = "mess.php";
header("Content-type: Application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Description: Download scheda");
readfile($filename);

} elseif (@$_GET['azione'] == "imposta") {
$cont = file_get_contents("mess.php");
$fopen = fopen("../mess.php", "w+");
$fwrite = fwrite($fopen, $cont);
unlink($fopen);
$fopen = fopen("easy_backup.php", "w+");
$cont = '<?php
$scadenza = "0";
$eseguito = "mai";
?>
';
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=easy_backup");

} elseif (@$_GET['azione'] == "backup") {

$giorno =(date("d"));
$mese =(date("m"));

$cont = file_get_contents("../mess.php");
$fopen = fopen("mess.php", "w+");
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);

include("easy_backup.php");
$fopen = fopen("easy_backup.php", "w+");
$cont = '<?php
$scadenza = "'.$scadenza.'";
$eseguito = "'.$giorno.'/'.$mese.'";
?>
';
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=easy_backup&azione=eseguito");

} else {
include("plugin/easy_backup.php");
$data = (date("d/m"));

if ($scadenza == "1") {
	if ($data != $eseguito) {
	$esegui = "si";
	}
} elseif ($scadenza == "2") {
	$k = explode("/",$eseguito);
	$ora = time();
	$time_ok = mktime(0,0,0,$k['1'],$k['0'],date("Y"));
	$time_ok = $time_ok + 604800;
	if($ora > $time_ok) {
	$esegui = "si"; 
	}	
} elseif ($scadenza == "3") {
	$k = explode("/",$eseguito);
	$mese =(date("m"));
	if ($mese != $k[1]) {
	$esegui = "si";
	}
}

if ($esegui == "si") {
$cont = file_get_contents("mess.php");
$fopen = fopen("plugin/mess.php", "w+");
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);

$fopen = fopen("plugin/easy_backup.php", "w+");
$cont = '<?php
$scadenza = "'.$scadenza.'";
$eseguito = "'.$data.'";
?>
';
$fwrite = fwrite($fopen, $cont);
$close = fclose($fopen);
}
}

}
?>