<?php
$skin = $this->skin;
	$contenuta = '<form method="post" action="plugin/bbcode_inc.php" style="display:inline"><br />&nbsp;&nbsp;<b>Bbcode Plugin</b><br />&nbsp;&nbsp;'.$this->array_lingua['bbcode_desc'].'<br />'.$this->array_lingua['bbcode_pag'].'';
	$contenuta .= '&nbsp;&nbsp;'.$this->array_lingua['stato_bbcode'].':&nbsp;<select name="attivo">';
	
	include("plugin/bbcode.php");
	if ($attivo == "si") {
	$contenuta .= "<option value=\"si\">".$this->array_lingua['attivo']."</option><option value=\"no\">".$this->array_lingua['disattivo']."</option>";
	} else {
	$contenuta .= "<option value=\"si\">".$this->array_lingua['attivo']."</option><option value=\"no\" selected=\"selected\">".$this->array_lingua['disattivo']."</option>";	
	}
	
	$contenuta .= "</select>&nbsp;<input type=\"submit\" value=\"".$this->array_lingua['conferma']."\" /></form><br />&nbsp;";
	include("skin/".$this->skin."/box_plugin.php");
	
?>