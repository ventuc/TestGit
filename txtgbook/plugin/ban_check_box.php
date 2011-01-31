<?php
	include("plugin/ban_check.php");
	$skin = $this->skin;
	$contenuta = '<br />&nbsp;&nbsp;<b>Ban check</b><br />&nbsp;&nbsp;'.$this->array_lingua['ban_check_desc'].'
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="40%" align="center" valign="top">&nbsp;
			<table width="100%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['ban_check_ip'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>';
	$i = 0;
	$ip_array = explode("|", $ip);
	foreach($ip_array as $limi) {
	if ($limi != "") {
			$contenuta .= "<tr><td width=\"50%\">".$limi."</td>
			<td width=\"50%\" align=\"center\"><input type=\"button\" value=\"".$this->array_lingua['elimina']."\" onclick=\"location.href='plugin/ban_check_inc.php?azione=elimina&amp;ipa=".$limi."'\" /></td></tr>";
	$i++;
	}
	}
	$contenuta .= '</table>
			&nbsp;</td>
			<td width="60%" align="center" valign="top">&nbsp;
			<form method="post" action="plugin/ban_check_inc.php?azione=aggiungi">
	<table width="90%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['ban_check_ip'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>
	<tr align="center">
	<td width="50%"><input type="text" name="ipa" value="" /></td>
	<td width="50%"><input type="submit" value="'.$this->array_lingua['aggiungi'].'" /></td></tr></table>
	</form>
			</td>
  			</tr>
		</table>';
	
	include("skin/".$this->skin."/box_plugin.php");
?>
