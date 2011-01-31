<?php
	$output .= '
<div class="top_box">
	<div class="left_box"><img src="skin/'.$skin.'/hdr_left_small.gif" border="0" alt="" /></div>
	<div class="right_box"><img src="skin/'.$skin.'/hdr_right_blue.gif" alt="" /></div>
</div>
<div class="tabella">
	<div class="titolo">'.$this->array_lingua['messaggio'].' #'.$num.'</div>
</div>
<div class="box">
	<div class="separatore"></div>
	<table width="97%" border="0" align="center" cellspacing="0" cellpadding="0">
   		<tr>
   		<td width="28%" align="left" valign="top">
			<div align="center"><b>'.$autore.'</b></div>
				'.$this->mostra_mail($mail).'&nbsp;'.$this->mostra_sito($sito).'&nbsp;'.$this->mostra_ip($ip).'<br />&nbsp;<br />
				'.$data.'<br />
				'.$ora.'
		</td>
		<td width="1%" valign="top" class="linea" align="left"></td>
    	<td width="71%" valign="top" align="left">
			<div align="right">'.$this->ricava_link($num).'</div>
			'.$messaggio.'<br /><input type="button" onclick="location.href=\'elabora.php?azione=valida&amp;num='.$num.'\'" value="'.$this->array_lingua['conferma'].'" /><br />&nbsp;
		</td>
 		</tr>
	</table>
	<div class="separatore"></div>
</div>&nbsp;';
	?>
