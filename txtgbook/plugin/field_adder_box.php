<?php
$skin = $this->skin;
	$contenuta = '<br />&nbsp;&nbsp;<b>Field Adder 1.0</b><br />&nbsp;&nbsp;'.$this->array_lingua['field_adder_desc'].'<br />&nbsp;<br />
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="50%" align="center" valign="top">
			<table width="100%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['campo'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>';
	$fopen = fopen("plugin/field_adder.php", "r+");
	$fread = fread($fopen, filesize("plugin/field_adder.php"));
	$p = explode("|", $fread);
	$i = 0;
	foreach ($p as $t) {
	if ($t != "") {
	$contenuta .= "<tr><td width=\"50%\">".$t."</td>
			<td width=\"50%\" align=\"center\"><input type=\"button\" value=\"".$this->array_lingua['elimina']."\" onclick=\"location.href='plugin/field_adder_inc.php?azione=elimina&amp;id=".$i."'\" /></td></tr>";
	$i++;
	}
	}
			
	$contenuta .= '</table>
			</td>
			<td width="50%" align="center" valign="top">
			<form method="post" action="plugin/field_adder_inc.php">
	<table width="90%" border="0">
    <tr class="tabella">
      <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['campo'].'</b></font></td>
	  <td width="50%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>
	<tr align="center">
	<td width="50%"><input type="text" name="nome" value="" size="20" /></td>
	<td width="50%"><input type="submit" value="'.$this->array_lingua['aggiungi'].'" /></td></tr></table>
	</form>
			</td>
  			</tr>
		</table>';
	include("skin/".$this->skin."/box_plugin.php");
?>