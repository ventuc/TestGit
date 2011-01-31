<?php
	$skin = $this->skin;
	$contenuta = '<br />&nbsp;&nbsp;<b>Word Filter</b><br />&nbsp;&nbsp;'.$this->array_lingua['word_filter_desc'].'
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="50%" align="center">&nbsp;
			<table width="100%" border="0">
    <tr class="tabella">
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['word_filter_parola'].'</b></font></td>
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['word_filter_sostituzione'].'</b></font></td>
	  <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>';
	foreach($this->elabora_parole() as $limi) {
		$ciao = explode(" ", $limi);
		if ($ciao[0] != "") {
			$contenuta .= "<tr><td width=\"33%\">".$ciao[0]."</td><td width=\"33%\">$ciao[1]</td>
			<td width=\"33%\" align=\"center\"><input type=\"button\" value=\"".$this->array_lingua['elimina']."\" onclick=\"location.href='plugin/word_filter_inc.php?azione=elimina&amp;codice=$ciao[0]||$ciao[1]'\" /></td></tr>";
		}
	}
	$contenuta .= '</table>
			&nbsp;</td>
			<td width="50%" align="center" valign="top">&nbsp;
			<form method="post" action="plugin/word_filter_inc.php">
	<table width="90%" border="0">
    <tr class="tabella">
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['word_filter_parola'].'</b></font></td>
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['word_filter_sostituzione'].'</b></font></td>
	  <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>
	<tr align="center">
	<td width="33%"><input type="text" name="parola" value="" size="10" /></td>
	<td width="33%"><input type="text" name="replace" size="10" /></td>
	<td width="33%"><input type="submit" value="'.$this->array_lingua['aggiungi'].'" /></td></tr></table>
	</form>
			</td>
  			</tr>
		</table>';
	
	include("skin/".$this->skin."/box_plugin.php");
?>
