<?php
$output .= '
<form method="post" action="invia.php" name="form">
<input type="hidden" name="autore" value="'.$admin.'" />
<div class="tabella">
	<div class="titolo">'.$this->array_lingua['scrivi_annuncio'].'</div>
</div>
<div class="box">
	<div class="separatore"></div>
	<table width="97%" border="0" align="center" cellspacing="0" cellpadding="0">
   		<tr>
   		<td width="28%" align="left" valign="top">
			<div align="center"><b>'.$this->array_lingua['tuo_nome'].'</b><br /><input type="text" disabled="disabled" name="autor" value="'.$_SESSION['user'].'" /><br />&nbsp;<br />
				<b>'.$this->array_lingua['tua_mail'].'</b><br /><input type="text" name="mail" value="email" /><br />
				<b>'.$this->array_lingua['tuo_sito'].'</b><br /><input type="text" name="sito" value="http://" /><br />&nbsp;
				'.$codice.'</div>
		</td>
		<td width="1%" valign="top" class="linea" align="left"></td>
    	<td width="71%" valign="top" align="left">
				<div align="center"><b>'.$this->array_lingua['annuncio'].'</b></div>
				<textarea name="mess" style="width: 99%" rows="9" cols=""></textarea>
		</td>
 		</tr>
	</table>
	<div class="separatore"></div>
</div>&nbsp;
<div style="display:none">
	<input type="text" name="username" value="" />
</div>
<div class="box">
	<div class="separatore"></div>
	<input type="submit" name="invia" value="'.$this->array_lingua['invia_annuncio'].'" />
	<div class="separatore"></div>
</div>
</form>&nbsp;';

?>