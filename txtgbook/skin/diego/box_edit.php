<?php
$output = '<form method="post" action="elabora.php" name="form" style="display:inline"><input type="hidden" name="azione" value="modifica">
	<input type="hidden" name="num" value="'.$num.'"><input type="hidden" name="data" value="'.$data.'">
	<input type="hidden" name="ora" value="'.$ora.'"><input type="hidden" name="ip" value="'.$ip.'">
	<input type="hidden" name="autore_old" value="'.$autore.'"><input type="hidden" name="mess_old" value="'.$messaggio.'">
	<input type="hidden" name="mail_old" value="'.$mail.'"><input type="hidden" name="sito_old" value="'.$sito.'">
<!--<div class="top_box">
	<div class="left_box"><img src="skin/'.$skin.'/hdr_left_small.gif" border="0" alt="" /></div>
	<div class="right_box"><img src="skin/'.$skin.'/hdr_right_blue.gif" alt="" /></div>
</div>-->
<div class="tabella">
	<div class="titolo">'.$this->array_lingua['modifica_mess'].'</div>
</div>
<div class="box">
	<div class="separatore"></div>
	<table width="97%" border="0" align="center" cellspacing="0" cellpadding="0">
   		<tr>
   		<td width="28%" align="left" valign="top">
			<div align="center"><b>'.$this->array_lingua['tuo_nome'].'</b><br><input type="text" name="autore" value="'.$autore.'"><br>&nbsp;<br>
				<b>'.$this->array_lingua['tua_mail'].'</b><br><input type="text" name="mail" value="'.$mail.'"><br>
				<b>'.$this->array_lingua['tuo_sito'].'</b><br><input type="text" name="sito" value="'.$sito.'"></div>
		</td>
		<td width="1%" valign="top" class="linea" align="left"></td>
    	<td width="71%" valign="top" align="left">
				<div align="center"><b>'.$this->array_lingua['messaggio'].'</b></div>
				<textarea name="mess" style="width: 99%" rows="9">'.$messaggio.'</textarea>
				<div align="center">'.$this->faccine.'</div>
		</td>
 		</tr>
	</table>
	<div class="separatore"></div>
</div>&nbsp;
<div class="box">
	<div class="separatore"></div>
	<input type="submit" name="invia" value="'.$this->array_lingua['modifica_mess'].'" />
	<div class="separatore"></div>
</div></form>&nbsp;';
	?>