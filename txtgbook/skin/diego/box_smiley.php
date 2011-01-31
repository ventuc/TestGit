<?php
echo '
<!--<div class="top_box">
	<div class="left_box"><img src="skin/'.$skin.'/hdr_left_small.gif" border="0" alt="" /></div>
	<div class="right_box"><img src="skin/'.$skin.'/hdr_right_blue.gif" alt="" /></div>
</div>-->
<div class="tabella">
	<div class="titolo">Smiley</div>
</div>
<div class="box">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  			<tr>
    		<td width="50%" align="center">&nbsp;
			'.$this->tabella_smiley().'
			&nbsp;</td>
			<td width="50%" align="center" valign="top">&nbsp;
			'.$this->tabella_aggiunta_smiley().'
			</td>
  			</tr>
		</table>
</div>&nbsp;
	';
	?>
