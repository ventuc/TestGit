<?php
$skin = $this->skin;
include("plugin/easy_backup.php");
	
	$contenuta = '<br />&nbsp;&nbsp;<b>Recovery tool</b><br />&nbsp;&nbsp;'.$this->array_lingua['easy_backup_desc'].'<br />&nbsp;<br />';
	
	if ($eseguito == "mai") {
	$contenuta .= "&nbsp;&nbsp;-> ".$this->array_lingua['easy_backup_no_eseguiti']."<br />&nbsp;";
	} else {
	$contenuta .= "&nbsp;&nbsp;-> ".$this->array_lingua['easy_backup_ultimo']." <b>".$eseguito."</b>&nbsp;&nbsp;&nbsp;<b><a  target=\"_blank\" href='plugin/easy_backup_inc.php?azione=scarica'\">".$this->array_lingua['easy_backup_scarica']."</a></b>&nbsp;|&nbsp;<b><a href='plugin/easy_backup_inc.php?azione=imposta'\">".$this->array_lingua['easy_backup_utilizza']."</a></b> // ".$this->array_lingua['easy_backup_utilizza_desc']."<br />&nbsp;";
	}
	
	$contenuta .= '<br />&nbsp;&nbsp;<b>'.$this->array_lingua['easy_backup_pianifica'].'</b><br />&nbsp;&nbsp;'.$this->array_lingua['easy_backup_pianifica_desc'].': 
	<form method="post" action="plugin/easy_backup_inc.php" style="display:inline"><select name="scadenza">';
	
	if ($scadenza == "0") {
	$contenuta .= '<option value="1">'.$this->array_lingua['easy_backup_1'].'</option><option value="2">'.$this->array_lingua['easy_backup_2'].'</option><option value="3">'.$this->array_lingua['easy_backup_3'].'</option><option selected="seletected" value="0">'.$this->array_lingua['easy_backup_0'].'</option>';
	} elseif ($scadenza == "1") {
	$contenuta .= '<option selected="seletected" value="1">'.$this->array_lingua['easy_backup_1'].'</option><option value="2">'.$this->array_lingua['easy_backup_2'].'</option><option value="3">'.$this->array_lingua['easy_backup_3'].'</option><option>'.$this->array_lingua['easy_backup_0'].'</option>';
	} elseif ($scadenza == "2") {
	$contenuta .= '<option value="1">'.$this->array_lingua['easy_backup_1'].'</option><option selected="seletected" value="2">'.$this->array_lingua['easy_backup_2'].'</option><option value="3">'.$this->array_lingua['easy_backup_3'].'</option><option>'.$this->array_lingua['easy_backup_0'].'</option>';
	} elseif ($scadenza == "3") {
	$contenuta .= '<option value="1">'.$this->array_lingua['easy_backup_1'].'</option><option value="2">'.$this->array_lingua['easy_backup_2'].'</option><option selected="seletected" value="3">'.$this->array_lingua['easy_backup_3'].'</option><option>'.$this->array_lingua['easy_backup_0'].'</option>';
	}
	
	$contenuta .= '</select>&nbsp;<input type="submit" value="'.$this->array_lingua['conferma'].'" /> // '.$this->array_lingua['easy_backup_conferma_desc'].'</form>&nbsp;<br />';
	
	if (@$_GET['azione'] == "eseguito") {
	$t = "// ".$this->array_lingua['easy_backup_done']."";
	}
	
	$contenuta .= '<br />&nbsp;&nbsp;<b>'.$this->array_lingua['easy_backup_singolo'].'</b><br />&nbsp;&nbsp;'.$this->array_lingua['easy_backup_singolo_desc'].':&nbsp;<input type="button" onclick="location.href=\'plugin/easy_backup_inc.php?azione=backup\'" value="'.$this->array_lingua['easy_backup_esegui'].'" />&nbsp;'.$t.'<br />&nbsp;';
		
	include("skin/".$this->skin."/box_plugin.php");
	
?>