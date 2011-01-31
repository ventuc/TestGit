<?php
if ($annuncio == "annuncio") {
$scrittina = $this->array_lingua['annuncio'];
$formattazione = "<font class=\"annuncio\">";
} else {
$formattazione = "<font class=\"testo\">";
$scrittina = $this->array_lingua['messaggio'];
}

$output = '
<div class="top_box">
	<div class="left_box"><img src="skin/'.$skin.'/hdr_left_small.gif" border="0" alt="" /></div>
	<div class="right_box"><img src="skin/'.$skin.'/hdr_right_blue.gif" alt="" /></div>
</div>
<div class="tabella">
	<div class="titolo">'.$scrittina.' #'.$num.'</div>
</div>
<div class="box">
	<div class="separatore"></div>
	<table width="97%" border="0" align="center" cellspacing="0" cellpadding="0">
   		<tr>
   		<td width="28%" align="left" valign="top">
			<div align="center"><b>'.$formattazione.''.$autore.'</font></b></div>
			'.$formattazione.''.$this->mostra_mail($mail).'&nbsp;'.$this->mostra_sito($sito).'&nbsp;'.$this->mostra_ip($ip).'
			<br />&nbsp;<br />'.$data.'<br />'.$ora.'</font>&nbsp;
		</td>
		<td width="1%" valign="top" align="left" class="linea" height="100%">&nbsp;</td>
    	<td width="71%" valign="top" align="left">
			<div align="right">'.$this->ricava_link($num).'</div>
			'.$formattazione.''.$messaggio.'</font><br />&nbsp;
		</td>
 		</tr>
		<tr>
   		<td></td>
		<td width="1%" class="linea" height="100%"></td>
    	<td width="71%" valign="top" align="right">'.$box_quote.'</td>
 		</tr>
	</table>
	<div class="separatore"></div>
</div>&nbsp;';
	?>