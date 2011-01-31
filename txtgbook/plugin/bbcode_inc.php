<?php
	
	if ($_POST['attivo']) {
	$fopen = fopen("bbcode.php", "w+");
	$c = '<?php
$attivo = "'.$_POST['attivo'].'";
?>';
	$scrivi = fwrite($fopen, $c);
	header("location: ../admin.php?sezione=plugin&nome=bbcode&aperto=si");
	} else {
	include("plugin/bbcode.php");
	if ($attivo == "si") {
	$messaggio = preg_replace("/\[b\](.*?)\[\/b\]/is", "<b>$1</b>", $messaggio);
	$messaggio = preg_replace("/\[u\](.*?)\[\/u\]/is", "<u>$1</u>", $messaggio);
	$messaggio = preg_replace("/\[i\](.*?)\[\/i\]/is", "<i>$1</i>", $messaggio);
	$messaggio = preg_replace('/\[quote\=(.*?)\](.*?)\[\\/quote]/', '&nbsp;</font><div class="quote"><b>$1</b><br />$2</div><font class="testo">', $messaggio);
	}
	}
?>