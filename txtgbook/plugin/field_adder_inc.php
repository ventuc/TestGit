<?php
session_start();
if ($_SESSION['loggato'] == "si") {

if (!$_GET['azione']) {
$nome = str_replace("|", "", $_POST['nome']);
$handle = fopen("field_adder.php", 'a+');
$contenuto = $nome."|";
$scrivi = fwrite($handle, $contenuto);
$handle = fopen("input_requirer.php", 'a+');
$contenuto = $nome."|0()";
$scrivi = fwrite($handle, $contenuto);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=field_adder");

} else {
$contenuto = "";
$id = $_GET['id'];

$i = -2;
$ip_array = explode("()", file_get_contents("input_requirer.php"));
	foreach($ip_array as $limi) {
	if ($limi != "") {
		if ($i == $id) {
		$da_levare = $limi;
		}
		$i++;
	}
	}
$uf = file_get_contents("input_requirer.php");
$st = str_replace($da_levare, "", $uf);
$st = str_replace("()()", "()", $st);
$fopen = fopen("input_requirer.php", "w+");
$scrivi = fwrite($fopen, $st);

$fopen = fopen("field_adder.php", "r+");
$fread = fread($fopen, filesize("field_adder.php"));
$p = explode("|", $fread);
$i = 0;
foreach ($p as $t) {
	if ($i != $id) {
	$contenuto .= $t."|";
	}
	$i++;
}
$contenuto = str_replace("||", "|", $contenuto);
$fopen = fopen("field_adder.php", "w+");
$fwrite = fwrite($fopen, $contenuto);
$fclose = fclose($fopen);

$content = "";
$fopen = fopen("../mess.php", "r+");
$fread = fread($fopen, filesize("../mess.php"));
$explode = explode("(|!|)", $fread);
foreach ($explode as $t) {
	if ($t != "") {
		$o = explode("||", $t);
		$field_adder = $o[8];
		$p = explode("|", $field_adder);
		$i = 0;
		foreach ($p as $c) {
			if ($i != $id) {
				$new = "|".$c;
			}
			$i++;
		}
		$t = str_replace($field_adder, $new, $t);
		$t = str_replace("|||", "||", $t);
		$content .= $t."(|!|)";
	}
}
$fopen = fopen("../mess.php", "w+");
$fwrite = fwrite($fopen, $content);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=field_adder");
}


} else {
header("location: ../index.php?aperto=si");
}
?>