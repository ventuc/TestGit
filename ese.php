<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>
<body>
<?php

// VERSIONE CORRETTA
print "<p>VERSIONE CORRETTA:</p>";

function tabellaCorretta($a,$b,$c,$d)
	{
	$tabella = "";
	$tabella .= "<table border=3>";
	$tabella .= "<tr>";
	$tabella .= "<td>";
	$tabella .= $a/*="Italia "*/;
	$tabella .= "</td>";
	$tabella .="\t<td>";
	$tabella .= $b/*= "Campione "*/;
	$tabella .= "</td>";
	$tabella .="\t<td>";
	$tabella .= $c/*= "del "*/;
	$tabella .= "</td>";
	$tabella .="\t<td>";
	$tabella .= $d/*= "Mondo!!!!"*/;
	$tabella .= "</td>";
	$tabella .= "</tr>";
	$tabella .= "</table>";
	
	return $tabella;
	}

$a = "Italia ";
$b = "Campione ";
$c = "del ";
$d = "Mondo!!!!";
print tabellaCorretta($a, $b, $c, $d);

// VERSIONE SBAGLIATA
print "<p>VERSIONE SBAGLIATA:</p>";

function tabella($a,$b,$c,$d)
	{
	print "<table border=3>";
	print "<tr>";
	print "<td>";
	print $a/*="Italia "*/;
	print "</td>";
	print"\t<td>";
	print $b/*= "Campione "*/;
	print "</td>";
	print"\t<td>";
	print $c/*= "del "*/;
	print "</td>";
	print"\t<td>";
	print $d/*= "Mondo!!!!"*/;
	print "</td>";
	print "</tr>";
	print "</table>";
	
	}
	return tabella();
print $a= "Italia ";
print $b= "Campione ";
print $c= "del ";
print $d= "Mondo!!!!";

?>
</body>
</html>
