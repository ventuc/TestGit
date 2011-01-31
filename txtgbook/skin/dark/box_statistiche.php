<?php
echo '
<div class="tabella">
	<div class="titolo">'.$this->array_lingua['statistiche'].'</div>
</div>
<div class="box">
	<div class="separatore"></div>
	<table width="98%" border="0" align="center" cellspacing="0" cellpadding="0">
			<tr align="left">
    		<td width="33%">
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['ip'].': </b>'.$this->ip().'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['browser'].': </b>'.$this->browser().'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['os'].': </b>'.$this->os().'</div>
			</td>
			<td width="1%" class="linea">&nbsp;</td>
			<td width="33%">
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['online'].': </b>'.$this->online().'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['validazione'].': </b>'.ucfirst($this->validazione).'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['skin'].': </b>'.$this->select_skin().'</div>
			</td>
			<td width="1%" class="linea">&nbsp;</td>
			<td width="33%">
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['mess'].': </b>'.$this->conteggia_mess().'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['pagg'].': </b>'.$this->conteggia_pag().'</div>
			<div style="height:15px">&nbsp;<b>'.$this->array_lingua['per_pag'].': </b>'.$this->per_pagina.'</div>
			</td>
  			</tr>
			</table>
	<div class="separatore"></div>
</div>&nbsp;';
	?>