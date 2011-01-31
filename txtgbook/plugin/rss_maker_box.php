<?php
include("plugin/rss_maker.php");
	if ($attivo == "no") {
	$u = "selected=\"selected\"";
	}
	$skin = $this->skin;
	$contenuta = '<br />&nbsp;&nbsp;<b>Rss Maker</b><br />&nbsp;&nbsp;'.$this->array_lingua['rss_maker_desc'].'<br />&nbsp;<br />
	<form method="post" action="plugin/rss_maker_inc.php">
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	<td height="20" width="22%"><b>'.$this->array_lingua['rss_maker_attivo'].':</b></td>
	<td><select name="attivo"><option value="si">'.$this->array_lingua['si'].'</option><option value="no" '.$u.'>'.$this->array_lingua['no'].'</option></select></td>
	</tr>
	<tr>
	<td height="20"><b>'.$this->array_lingua['rss_maker_url'].':</b></td>
	<td><input type="text" name="path" size="50" value="'.$path.'" /></td>
	</tr>
	<tr>
	<td height="20"><b>'.$this->array_lingua['rss_maker_mess_mostrati'].':</b></td>
	<td><input type="text" name="numero" size="2" value="'.$numero.'" /></td>
	</tr>
	<tr>
	<td height="20"><b><input type="submit" value="'.$this->array_lingua['modifica'].'" /></b></td>
	<td></td>
	</tr>
	</table>
	</form>';
	include("skin/".$this->skin."/box_plugin.php");
?>
