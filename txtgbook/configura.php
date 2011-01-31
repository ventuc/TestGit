<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
session_start();
include("funzioni.php");
$funzione = new funzioni();
$funzione->preleva_info();

if ($_GET['skin'] != "") {
$_SESSION['skin'] = $_GET['skin'];
header("location: index.php");
} else {

if ($funzione->verifica_login($_SESSION['user'], $_SESSION['pass']) == "si") {

if ($_GET['action'] == "dati") {
$old = $_POST['old'];
$new = $_POST['new'];

include("config.php");
if ($old != $pass) {
header("location: admin.php?aperto=si&mess=Le password vecchia non coincide con quella attuale");
} else {
$handle = fopen("config.php", 'w+');
$contenuto = '<?php
$file = "mess.php";
$titolo = "'.$titolo.'";
$per_pagina = "'.$per_pagina.'";
$validazione = "'.$validazione.'";
$antispam = "'.$antispam.'";
$skin = "'.$skin.'";
$admin = "'.$admin.'";
$pass = "'.$new.'";
$lingua = "'.$lingua.'";
$maxlenght = "'.$maxlenght.'";
$notifica = "'.$notifica.'";
$mail = "'.$mail.'";
$cambio_skin_abilitato = "'.$cambio_skin_abilitato.'";
$antiflood = "'.$antiflood.'";
?>';
$scrivi = fwrite($handle, $contenuto);
$_SESSION['pass'] = $new;
header("location: admin.php?aperto=si&mess=Password modificata con successo");
}

} else {
$titolo = $_POST['titolo'];
$per_pagina = $_POST['per_pagina'];
$validazione = $_POST['validazione'];
$skin = $_POST['skin'];
$admin = "$_SESSION[user]$_POST[user]";
$pass = "$_SESSION[pass]$_POST[pass]";
$notifica = $_POST['notifica'];
$mail = $_POST['mail'];
$maxlenght = $_POST['maxlenght'];
$lingua = $_POST['lingua'];
$antispam = $_POST['antispam'];
$antiflood = $_POST['antiflood'];
$cambio_skin_abilitato = $_POST['cambio_skin_abilitato'];

$handle = fopen("config.php", 'w+');
$contenuto = '<?php
$file = "mess.php";
$titolo = "'.$titolo.'";
$per_pagina = "'.$per_pagina.'";
$validazione = "'.$validazione.'";
$antispam = "'.$antispam.'";
$skin = "'.$skin.'";
$admin = "'.$admin.'";
$pass = "'.$pass.'";
$lingua = "'.$lingua.'";
$maxlenght = "'.$maxlenght.'";
$notifica = "'.$notifica.'";
$mail = "'.$mail.'";
$cambio_skin_abilitato = "'.$cambio_skin_abilitato.'";
$antiflood = "'.$antiflood.'";
?>';
$scrivi = fwrite($handle, $contenuto);
header("location: admin.php?aperto=si&sezione=impostazioni");

}
} else {
header("location: index.php?aperto=si");
}
}
?>