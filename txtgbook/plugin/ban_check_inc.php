<?php
session_start();
if ($_SESSION['loggato'] == "si") {

if ($_GET['azione'] == "aggiungi") {
$ipa = $_POST['ipa'];
$ipa .= $_GET['ipa'];

include("ban_check.php");
$ip = $ip."|".$ipa."";

$k = substr($ip, -1, 1);
if ($k == "|") {
$ip = substr($ip, 0, -1);
}
$k = substr($ip, 0,1);
if ($k == "|") {
$ip = substr($ip, 1);
}
$apri = fopen("ban_check.php", "w+");
$stringa = '<?php
$ip = "'.$ip.'";
?>';
$scrivi = fwrite($apri, $stringa);
fclose($apri);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=ban_check");

} elseif ($_GET['azione'] == "elimina") {
$ipa = $_GET['ipa'];
include("ban_check.php");

$ip = str_replace($ipa, "", $ip);
$ip = str_replace("||", "|", $ip);

$k = substr($ip, -1, 1);
if ($k == "|") {
$ip = substr($ip, 0, -1);
}
$k = substr($ip, 0,1);
if ($k == "|") {
$ip = substr($ip, 1);
}
$apri = fopen("ban_check.php", "w+");
$stringa = '<?php
$ip = "'.$ip.'";
?>';
$scrivi = fwrite($apri, $stringa);
fclose($apri);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=ban_check");
}


}
?>