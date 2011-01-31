<?php
session_start();
if ($_SESSION['loggato'] == "si") {
if ($_GET['azione'] == "edit") {
$stringa = "";
$i = 0;

	$ip_array = explode("()", file_get_contents("input_requirer.php"));
	foreach($ip_array as $limi) {
	if ($limi != "") {
		$f = explode("|", $limi);
		if ($_POST['campo'.$i] == "attivo") {
			$stringa .= $f[0]."|1()";
		} else {
			$stringa .= $f[0]."|0()";
		}
		$i++;
	}
	}
$fopen = fopen("input_requirer.php", "w+");
$scrivi = fwrite($fopen, $stringa);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=input_requirer");
} else {

}
}
?>