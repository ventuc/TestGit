<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
session_start();
$username = $_POST['user'];
$password = $_POST['pass'];

include("funzioni.php");
$funzione = new funzioni();
$funzione->preleva_info();
$loggato = $funzione->verifica_login($username, $password);

if ($loggato == "si") {
	$_SESSION['user'] = $username;
	$_SESSION['pass'] = $password;
	$_SESSION['loggato'] = "si";
	header("location: index.php?aperto=si");
} elseif ($loggato == "mod") {
	$_SESSION['loggato'] = "mod";
	$_SESSION['nick'] = $username;
	header("location: index.php?aperto=si");
} else {
	header("location: index.php?login=fallito");
}
?>