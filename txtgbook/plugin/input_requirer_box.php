<?php
	$skin = $this->skin;
	$contenuta = '<form method="post" action="plugin/input_requirer_inc.php?azione=edit" style="display:inline"><br />&nbsp;&nbsp;<b>Input requirer</b><br />&nbsp;&nbsp;'.$this->array_lingua['input_requirer_desc'].'
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="50%" align="center" valign="top">&nbsp;<br /><b>'.$this->array_lingua['input_requirer_fa'].'</b>
			<table width="100%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['campo'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['input_requirer_obb'].'</b></font></td>
    </tr>';
	$i = 0;
	$ip_array = explode("()", file_get_contents("plugin/input_requirer.php"));
	foreach($ip_array as $limi) {
	if ($limi != "") {
	$f = explode("|", $limi);
	if ($f[1] == "0") {
			$a = "<input type=\"checkbox\" name=\"campo".$i."\" value=\"attivo\" />";
	} else {
			$a = "<input type=\"checkbox\" name=\"campo".$i."\" value=\"attivo\" checked=\"checked\" />";
	}	
	$contenuta .= "<tr><td width=\"50%\">".$f[0]."</td><td width=\"50%\" align=\"center\">".$a."</td></tr>";		
	$i++;
	}
	}
	$contenuta .= '</table>
			&nbsp;</td>
			<td width="50%" align="center" valign="top">&nbsp;
			</td>
  			</tr>
		</table>&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$this->array_lingua['conferma'].'" /></form>';
	
	include("skin/".$this->skin."/box_plugin.php");
?>