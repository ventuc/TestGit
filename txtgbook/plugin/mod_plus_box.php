<?php
	include("plugin/mod_plus.php");
	$skin = $this->skin;
	$contenuta = '<br />&nbsp;&nbsp;<b>Mod plus</b><br />&nbsp;&nbsp;'.$this->array_lingua['mod_plus_desc'].'
	<br />&nbsp;<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="40%" align="center" valign="top">
			<table width="100%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['mod_plus_moderatore'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>';
	$i = 0;
	$mod_user_array = explode("|", $mod_user);
	$mod_pass_array = explode("|", $mod_pass);
	foreach($mod_user_array as $limi) {
	if ($limi != "") {
			$contenuta .= "<tr><td width=\"50%\">".$limi."</td>
			<td width=\"50%\" align=\"center\"><input type=\"button\" value=\"".$this->array_lingua['elimina']."\" onclick=\"location.href='plugin/mod_plus_inc.php?azione=elimina&amp;mod=$limi&pass=$mod_pass_array[$i]'\" /></td></tr>";
	$i++;
	}
	}
	$contenuta .= '</table>
			&nbsp;</td>
			<td width="60%" align="center" valign="top">
			<form method="post" action="plugin/mod_plus_inc.php?azione=aggiungi">
	<table width="90%" border="0">
    <tr class="tabella">
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['mod_plus_user'].'</b></font></td>
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['mod_plus_pass'].'</b></font></td>
	  <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>
	<tr align="center">
	<td width="33%"><input type="text" name="mod" value="" size="10" /></td>
	<td width="33%"><input type="text" name="pass" size="10" value="" /></td>
	<td width="33%"><input type="submit" value="'.$this->array_lingua['aggiungi'].'" /></td></tr></table>
	</form>
			</td>
  			</tr>
		</table>';
	
	include("skin/".$this->skin."/box_plugin.php");
?>
