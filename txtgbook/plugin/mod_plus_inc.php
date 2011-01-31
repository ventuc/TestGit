<?php
session_start();
if ($_SESSION['loggato'] == "si") {

if ($_GET['azione'] == "aggiungi") {
$mod = $_POST['mod'];
$pass = $_POST['pass'];

include("mod_plus.php");
$mod_user = $mod_user."|".$mod."";
$mod_pass = $mod_pass."|".$pass."";

$k = substr($mod_user, -1, 1);
if ($k == "|") {
$mod_user = substr($mod_user, 0, -1);
$mod_pass = substr($mod_pass, 0, -1);
}
$k = substr($mod_user, 0,1);
if ($k == "|") {
$mod_user = substr($mod_user, 1);
$mod_pass = substr($mod_pass, 1);
}

$apri = fopen("mod_plus.php", "w+");
$stringa = '<?php
$mod_user = "'.$mod_user.'";
$mod_pass = "'.$mod_pass.'";
?>';
$scrivi = fwrite($apri, $stringa);
fclose($apri);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=mod_plus");

} elseif ($_GET['azione'] == "elimina") {
$mod = $_GET['mod'];
$pass = $_GET['pass'];
include("mod_plus.php");

$mod_user = str_replace($mod, "", $mod_user);
$mod_user = str_replace("||", "|", $mod_user);
$mod_pass = str_replace($pass, "", $mod_pass);
$mod_pass = str_replace("||", "|", $mod_pass);

$k = substr($mod_user, -1, 1);
if ($k == "|") {
$mod_user = substr($mod_user, 0, -1);
$mod_pass = substr($mod_pass, 0, -1);
}
$k = substr($mod_user, 0,1);
if ($k == "|") {
$mod_user = substr($mod_user, 1);
$mod_pass = substr($mod_pass, 1);
}

$apri = fopen("mod_plus.php", "w+");
$stringa = '<?php
$mod_user = "'.$mod_user.'";
$mod_pass = "'.$mod_pass.'";
?>';
$scrivi = fwrite($apri, $stringa);
fclose($apri);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=mod_plus");
}


}
?>