<?php
if (@!$_GET['l']) {
include("../language/english.php");
} else {
include("../language/".$_GET['l'].".php");
}
define("wr", $lingua['i_wr']);
define("unwr", $lingua['i_unwr']);

if (file_exists("../install.lock")) {
header("location: ../index.php");
} else {
$i = explode("/", $_SERVER['SCRIPT_NAME']);
$dir = $i[count($i)-3]."/";

$v = explode(".", phpversion());
if ($v[0] >= 4) {
	$stato_versione = '<b><font color="green">'.$lingua['i_comp'].'</font></b>';
} else {
	$stato_versione = '<b><font color="red">'.$lingua['i_incomp'].'</font></b>';
}

function permessi($ele) {
	if (@is_writable($ele)) {
		return '<b><font color="green">'.wr.'</font></b>';
	} else {
		define("problema", "si");
		return '<b><font color="red">'.unwr.'</font></b>';
	}
}

if (@$_POST['titolo']) {

$titolo = $_POST['titolo'];
$admin = $_POST['user'];
$pass = $_POST['pass'];
$mail = $_POST['mail'];
$lingua = $_POST['language'];

$handle = fopen("../config.php", 'w+');
$contenuto = '<?php
$file = "mess.php";
$titolo = "'.$titolo.'";
$per_pagina = "5";
$validazione = "no";
$antispam = "no";
$skin = "lightblue";
$admin = "'.$admin.'";
$pass = "'.$pass.'";
$maxlenght = "500";
$lingua = "'.$lingua.'";
$mail = "'.$mail.'";
$notifica = "no";
$cambio_skin_abilitato = "no";
$antiflood = "5";
?>';
$scrivi = fwrite($handle, $contenuto);
$crea = fopen("../install.lock", "w+");
header("location: ../index.php?installazione=completa");
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="generator" content="Txtgbook Pro 1.0" />
<meta name="keywords" content="txtgbook guestbook php free gratis captcha antispam filtro smiley antispam skin template" />
<meta name="description" content="Un guestbook powered by Txtgbook 6.1" />
<title>Txtgbook Pro 1.2 :: <?php echo $lingua['i']; ?></title>	
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body >
<div class="box">
	<div class="separatore_titolo"></div>
	<a href="index.php" class="title">Txtgbook Pro 1.2.2 :: <?php echo $lingua['i']; ?></a><br />
	&nbsp;<br />
	| <a href="http://www.txtgbook.altervista.org" class="scrivi"><b><?php echo $lingua['i_sito']; ?></b></a> |
    <div class="separatore_titolo"></div>

</div>&nbsp;
<div class="box">
	<div class="separatore_titolo"></div>
		<strong><?php echo $lingua['i_desc']; ?></strong>
	<div class="separatore_titolo"></div>
</div>&nbsp;
<div class="top_box">
	<div class="left_box"><img src="../skin/lightblue/hdr_left_small.gif" border="0" alt="" /></div>
	<div class="right_box"><img src="../skin/lightblue/hdr_right_blue.gif" alt="" /></div>
</div>
<div class="tabella">
	<div class="titolo"><?php echo $lingua['i']; ?></div>
</div>
<div class="box">
<div class="separatore"></div>			
<?php
switch(@$_GET['step']) {
default:
?>
<table width="94%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="100%" valign="top" align="left">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="4"></td>
        <td></td>
      </tr>
      <tr>
        <td width="27"><img src="square.gif" width="21" height="21" /></td>
        <td valign="center" align="left"><strong>Txtgbook Pro 1.2.2</strong></td>
      </tr>
    </table>
      -------------------------------------------------------<br />&nbsp;
      <div align="justify">
      <strong>Select your language</strong></div>
      <div align="center"><a href="?l=italiano&step=1">Italiano</a> | <a href="?l=english&step=1">English</a></div>&nbsp;
      </td>
  </tr>
</table>
<?php
break;
case 1:
?>
<table width="94%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="100%" valign="top" align="left">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="4"></td>
        <td></td>
      </tr>
      <tr>
        <td width="27"><img src="square.gif" width="21" height="21" /></td>
        <td valign="center" align="left"><strong>Txtgbook Pro 1.2.2</strong></td>
      </tr>
    </table>
      -------------------------------------------------------<br />&nbsp;
      <div align="justify">
      <strong><?php echo $lingua['i_c']; ?></strong><br />&nbsp;
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
 		 <tr>
   		 <td width="33%"><?php echo $lingua['i_ver']; ?>: <b><?php echo phpversion(); ?> </td>
   		 <td width="67%"><?php echo $stato_versione; ?></td>
         </tr>
	  </table>&nbsp;<br />
      <strong><?php echo $lingua['i_per']; ?></strong><br />Directory: <?php echo $dir; ?><br />
      &nbsp;
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
 		 <tr height="20">
   		 <td width="33%">./</td>
   		 <td width="67%"><?php echo permessi("../"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./smiley/parole.txt</td>
   		 <td width="67%"><?php echo permessi("../smiley/parole.txt"); ?></td>
         </tr>
        <tr height="20">
   		 <td width="33%">./smiley/smiley.txt</td>
   		 <td width="67%"><?php echo permessi("../smiley/smiley.txt"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./online.stat</td>
   		 <td width="67%"><?php echo permessi("../online.stat"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./mess.php</td>
   		 <td width="67%"><?php echo permessi("../mess.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/bbcode.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/bbcode.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/ban_check.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/ban_check.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/easy_backup.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/easy_backup.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/mess.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/mess.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/mod_plus.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/mod_plus.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/rss_maker.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/rss_maker.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/input_requirer.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/input_requirer.php"); ?></td>
         </tr>
         <tr height="20">
   		 <td width="33%">./plugin/field_adder.php</td>
   		 <td width="67%"><?php echo permessi("../plugin/field_adder.php"); ?></td>
         </tr>
	  </table>&nbsp;
      <?php
	  if (@problema != "si") {
	  	echo "<div align=\"center\"><b>".$lingua['i_ok']."</b></div>";
	  } else {
	  	echo "<div align=\"center\"><b><font color=\"red\">".$lingua['i_ko']."</font></b></div>";
	  }
	  ?>&nbsp;<div align="center"><input type="button" value="<?php echo $lingua['i_go']; ?>" onclick="location.href='<?php echo $_SERVER['PHP_SELF']."?step=2&l=".$_GET['l'].""; ?>'" /></div>
        </div></td>
  </tr>
</table>
<?php
break;
case "2":
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="29%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td align="center" valign="top"><b><?php echo $lingua['nome_gb']; ?></b><br />
              <input type="text" name="titolo" value="" />
          <br />
          &nbsp;<br />
              <b><?php echo $lingua['i_au']; ?></b><br />
          <input type="text" name="user" />
          <br />
              <b><?php echo $lingua['i_ap']; ?></b><br />
          <input type="password" name="pass" />
          <br />
              <b><?php echo $lingua['admin_mail']; ?></b><br />
          <input type="text" name="mail" />
        </td>
      </tr>
    </table></td>
    <td class="linea" width="1%">&nbsp;</td>
    <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td align="left"><div align="center"><b><?php echo $lingua['i_con']; ?></b></div>
              <textarea name="regolamento" style="width: 97%" rows="9"><?php echo $lingua['i_con_test']; ?></textarea>
              <br />&nbsp;<input type="hidden" name="language" value="<?php echo $_GET['l']; ?>" />
              <div align="center"><input type="submit" value="<?php echo $lingua['i_done']; ?>" /></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<?php
break;
}  
?> 
<div class="separatore"></div>
</div>&nbsp;
<div class="box">
	<div class="separatore"></div>
	Powered by <b><a class="copy" href="http://www.txtgbook.altervista.org">Txtgbook Pro 1.2.2</a></b>
    <div class="separatore"></div>
	</div>&nbsp;

</body>
</html>
<?php
}
}
?>
