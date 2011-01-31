<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
class funzioni {

	var $notifica;
	var $mail;
	var $file;
	var $output;
	var $maxlenght;
	var $skin;
	var $open;
	var $lingua;
	var $dimen;
	var $contenuto;
	var $titolo;
	var $validazione;
	var $faccine;
	var $per_pagina;
	var $mostra_pagine;
	var $inizio;
	var $stringa_quote;
	var $fine;
	var $admin;
	var $pass;
	var $vuoto;
	var $antispam;
	var $cambio_skin_abilitato;
	var $array_lingua;
	var $antiflood;
	
	function errore($tipo) {
	switch($tipo) {
		case 0:
		echo "File config.php does not exist. A new <a href=install/index.php>installation</a> can solve the problem";
		exit;
		break;
		
		case 1:
		echo "Unable to open mess.php file. Check the chmod permission";
		exit;
		break;
		
		case 4:
		echo "Unable to edit mess.php. Check the chmod permission";
		exit;
		break;
		
		case 5:
		echo "Unable to read smiley/smiley.txt file. Check the chmod permission";
		exit;
		break;
	}
	}

	function preleva_info() {
	if (file_exists("config.php")) {
		include("config.php");
		$this->file = $file;
		$this->cambio_skin_abilitato = $cambio_skin_abilitato;
		if (@$_GET['skin'] != "" and $cambio_skin_abilitato == "si") {
		$this->skin = $_GET['skin'];
		} elseif ($_SESSION['skin'] and $cambio_skin_abilitato == "si") {
		$this->skin = $_SESSION['skin'];
		} else {
		$this->skin = $skin;
		}
		$this->output = "";
		$this->titolo = $titolo;
		$this->maxlenght = $maxlenght;
		$this->validazione = $validazione;
		$this->per_pagina = $per_pagina;
		$this->admin = $admin;
		$this->pass = $pass;
		$this->lingua = $lingua;
		$this->notifica = $notifica;
		$this->mail = $mail;
		$this->antispam = $antispam;
		$this->antiflood = $antiflood;
	} else {
		$this->errore(0);
	}
	}
	
	function verifica_privato($nome) {
	$admin = $this->admin;
	if ($admin == $nome AND $_SESSION['loggato'] != "si") {
		return "si";
	} 
	}
	
	function carica_css() {
	echo '<link rel="stylesheet" type="text/css" href="skin/'.$this->skin.'/style.css" />';
	}
	
	function mostra_titolo() {
	echo $this->titolo;
	}
	
	function apri_file($modo) {
	$fopen = @fopen($this->file, $modo);
	if ($fopen === false) {
		$this->errore(1);
	} else {
		$this->open = $fopen;
	}
	}
	
	function leggi_file() {
	$contenuto = @file_get_contents($this->file);
	if ($contenuto === false) {
		$this->vuoto == "si";
	} else {
		$this->contenuto = $contenuto;
	}
	}
	
	function scrivi($stringa) {
	$fwrite = fwrite($this->open, $stringa);
	if ($fwrite === false) {
		$this->errore(4);
	} else {
		return "ok";
	}
	}
	
	function sovrascrivi($stringa, $stringa_old) {
	$contenuto = str_replace($stringa_old, $stringa, $this->contenuto);
	$contenuto = str_replace("(|!|)(|!|)", "(|!|)", $contenuto);
	$fwrite = fwrite($this->open, $contenuto);
	if ($fwrite === false) {
		$this->errore(4);
	} else {
		return "ok";
	}
	}
	
	function elimina($stringa) {
	$contenuto = str_replace($stringa, "",  $this->contenuto);
	$contenuto = str_replace("(|!|)(|!|)", "(|!|)", $contenuto);
	$fwrite = fwrite($this->open, $contenuto);
	if ($fwrite === false) {
		$this->errore(4);
	} else {
		return "ok";
	}
	}
	
	function mail_ok($email) {
	$email = trim($email);
	if(!$email) {
		return false;
	}
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return false;
	}
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return false;
	}
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return false;
	}
	return "si";
	}

	
	function notifica($autore, $messaggio) {
	if ($this->notifica == "si") {
		mail($this->mail, $this->array_lingua['nuovo_mess_nel_gb'], "".$this->array_lingua['da'].": $autore || $messaggio");
	}
	}
	
	function carica_lingua() {
	include("language/".$this->lingua.".php");
	$this->array_lingua = $lingua;
	}
	
	function elabora_contenuto() {
	$num = 0;
	$contenuto = $this->contenuto;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $val) {
		$num++;
		if  ($num > $this->inizio AND $num <= $this->fine) {
			$dati = explode("||", $val);
			$autore = $dati[0];
			$messaggio = $dati[1];
			include("plugin/bbcode_inc.php");
			$stato = $dati[2];
			$data = $dati[3];
			$ora = $dati[4];
			$mail = $dati[5];
			$sito = $dati[6];
			$ip = $dati[7];
			$field_adder = $dati[8];
			$o = explode("|", $field_adder);
			
				$c = "";
				$id = $_GET['id'];
				$fopen = fopen("plugin/field_adder.php", "r+");
				$fread = fread($fopen, filesize("plugin/field_adder.php"));
				$p = explode("|", $fread);
				$i = 0;
				foreach ($p as $t) {
					if ($t != "" AND $o[$i] != "") {
					$c .= "<i>$t</i>:<br /> $o[$i]<br />";
					$i++;
				}
				}
					
			$data = $c.'<br />'.$data;
			$confermato = $this->verifica_stato($stato);
			$verifica_se_annuncio = $this->verifica_annuncio($autore);
			if ($verifica_se_annuncio == "si") {
				$this->impagina_mess($autore, $messaggio, $data, $ora, $mail, $sito, $ip, $num, "annuncio", $field_adder);
			} elseif ($confermato == "si") {
				$this->impagina_mess($autore, $messaggio, $data, $ora, $mail, $sito, $ip, $num, "", $field_adder);
			} 
		}
	}
	}
	
	function verifica_stato($stato) {
	if ($stato == "confermato") {
		return "si";
	} else {
		return "no";
	}
	}
	
	function rileva_link($mess) {
	$mess = ereg_replace("(((http|ftp|https)://)|(www\.))+(([a-zA-Z0-9\._-]+\.[a-zA-Z]{2,6})|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(/[a-zA-Z0-9\&%_\./-~-]*)?","<a href=\"http://\\0\" target=\"_blank\" class=\"mess\">\\0</a>", $mess); 
	return $mess;
	}
	
	function impagina_mess($autore, $messaggio, $data, $ora, $mail, $sito, $ip, $num, $annuncio) {
	$messaggio = stripslashes($messaggio);
	$messaggio = str_replace("<br>", "<br />", $messaggio);
	$messaggio = wordwrap($messaggio, 55, "<br />");
	$messaggio = $this->rileva_link($messaggio);
	$messaggio = $this->converti_smiley($messaggio);
	$messaggio = $this->converti_parole($messaggio);
	$skin = $this->skin;
	include("plugin/bbcode.php");
	if ($attivo == "si") {
	$box_quote = '<a href="scrivi.php?quote='.$num.'"><img src="skin/'.$this->skin.'/quote.gif" border="0" alt="" /></a>';
	}
	include("skin/".$this->skin."/impaginazione_mess.php");
	$this->output .= $output;
	}
	
	function mostra_mail($mail) {
	if ($mail != "email" AND $mail != "") {
		return '<a href="#" onclick="window.open(\'manda_mail.php?mail='.$mail.'\',\'window\',\'width=600,height=300\')"><img src="skin/'.$this->skin.'/email.gif" alt="" border="0" /></a>';
	} else {
		return "&nbsp;";
	}
	}
	
	function mostra_sito($sito) {
	if ($sito != "http://" AND $sito != "") {
		return '<a href="'.$sito.'" target="_blank"><img src="skin/'.$this->skin.'/url.gif" alt="" border="0" /></a>';
	} else {
		return "&nbsp;";
	}
	}
	
	function mostra_ip($ip) {
	if ($_SESSION['loggato'] == "si") {
		return $ip."<div class=\"separatore\"></div><div align=\"center\"><input type=\"button\" value=\"".$this->array_lingua['banna_ip']."\" onclick=\"location.href='plugin/ban_check_inc.php?azione=aggiungi&amp;ipa=".$ip."'\" /></div>";
	} else {
		return "&nbsp;";
	}
	}
	
	function mostra_mess() {
	echo $this->output;
	}
	
	function box_scrittura() {
	$skin = $this->skin;
	
	$i = -2;
	$ip_array = explode("()", file_get_contents("plugin/input_requirer.php"));
		
	$l = 0;
	$contenutu = "";
	$fopen = fopen("plugin/field_adder.php", "r+");
	$fread = fread($fopen, filesize("plugin/field_adder.php"));
	$p = explode("|", $fread);
	foreach ($p as $t) {
	if ($t != "") {
	foreach($ip_array as $limi) {
	if ($limi != "") {
		if ($i == $id) {
		$u = explode("|", $limi);
		if ($u[1] == "1") {
			$urg = "*";
		}
		}
		$i++;
	}
	}
	$contenutu .= "<b>".$t.$urg."</b><br /><input type=\"text\" name=\"".trim($t)."\" /><br />";
	$l++;
	}
	}	
	

	
	if ($this->antispam == "si") {
	$testo = "";
	$caratteri = array(1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,h,i,l,m,n,o,p,r,s,t,u,v,z);
	for ($i = 0; $i < 5; $i++) {
	$numero = rand(0,29);
	$testo .= $caratteri[$numero]." ";
	$ghx .= $caratteri[$numero];
	}
	$codice = ''.$contenutu.'<br /><b>'.$this->array_lingua['codice_verifica'].'</b><br /><img src="codice.php?testo='.$testo.'" border="0" alt="" /><br /><input type="text" name="codice" /><input type="hidden" name="ghx" value="'.$ghx.'" /><br />&nbsp;';
	} else {
	$codice = $contenutu."&nbsp;";
	}
	$i = -2;
	$this->array_lingua['tuo_nome'] .= "*";
	$this->array_lingua['messaggio'] .= "*";
	$array = explode("()", file_get_contents("plugin/input_requirer.php"));
	$o = explode("|", $array[0]);
	if ($o[1] == "1") {
		$this->array_lingua['tua_mail'] .= "*";
	}
	$o = explode("|", $array[1]);
	if ($o[1] == "1") {
		$this->array_lingua['tuo_sito'] .= "*";
	}
	
	include("skin/".$this->skin."/box_scrittura.php");
	echo $output;
	}
	
	function scrivi_annuncio() {
	$skin = $this->skin;
	$admin = $this->admin;
	include("skin/".$this->skin."/scrivi_annuncio.php");
	echo $output;
	}
	
	function verifica_campi($nome, $mess, $mail, $sito) {
	$mess = str_replace("[b]", "", $mess);
	$mess = str_replace("[/b]", "", $mess);
	$mess = str_replace("[i]", "", $mess);
	$mess = str_replace("[/i]", "", $mess);
	$mess = str_replace("[u]", "", $mess);
	$mess = str_replace("[/u]", "", $mess);
	$mess = str_replace("[quote=]", "", $mess);
	$mess = str_replace("[quote]", "", $mess);
	$mess = str_replace("[/quote]", "", $mess);
	$array = explode("()", file_get_contents("plugin/input_requirer.php"));
	$m = explode("|", $array[0]);
	$s = explode("|", $array[1]);
	if (($m[1] == "1" AND trim($mail) == "email") OR ($m[1] == "1" AND trim($mail) == "")) {
		return "no";
	}
	if ($m[1] == "1") {
		$mail_ok = $this->mail_ok($mail);
		if ($mail_ok != "si") {
			return "no";
		}
	}
	if (($s[1] == "1" AND trim($sito) == "") OR ($s[1] == "1" AND trim($sito) == "http://")) {
		return "no";
	}
	if (trim($nome) != "" AND trim($mess) != "") {
		return "si";
	} else {
		return "no";
	}
	}
	
	function verifica_field_adder($field_adder) {
	$field_adder = str_replace("||", "", $field_adder);
	$field_adder = explode("|", $field_adder);
	$c = 0;
	$ip_array = explode("()", file_get_contents("plugin/input_requirer.php"));
	for ($i = 2; $i<=count($ip_array);$i++) {
	$f = explode("|", $ip_array[$i]);
	if ($f[1] == "1" AND trim($field_adder[$c]) == "") {
	return "si";
	}
	$c++;
	}	
	}
	
	function formatta_testo($stringa) {
	$stringa = htmlspecialchars($stringa, ENT_QUOTES);
	$stringa = str_replace("||", "", $stringa);
	$stringa = str_replace("(|!|)", "", $stringa);
	$stringa = str_replace("\n", "", $stringa);
	$stringa = str_replace(chr(13), "<br />", $stringa);
	$stringa = str_replace("<br>", "<br />", $stringa);
	$stringa = stripslashes($stringa);	
	return $stringa;
	}
	
	function verifica_spam($username) {
	if ($username == "") {
		return "superato";
	} else {
		return "fallito";
	}
	}
	
	function verifica_validatura() {
	$validazione = $this->validazione;
	if ($validazione == "si") {
		return "si";
	} else {
		return "no";
	}
	}
	
	function genera_stringa($nome, $mail, $sito, $data, $ora, $ip, $mess, $stato, $campi_opzionali) {
	$stringa = ''.$nome.'||'.$mess.'||'.$stato.'||'.$data.'||'.$ora.'||'.$mail.'||'.$sito.'||'.$ip.''.$campi_opzionali.'(|!|)';
	return $stringa;
	}
	
	function elabora_smiley() {
	$smiley = "smiley/smiley.txt";
	$apri = fopen($smiley, 'r+');
	$grandezza = filesize($smiley);
	$leggi = fread($apri, $grandezza);
	$controllo = explode(" - ", $leggi);
	return $controllo;
	}
	
	function elabora_parole() {
	$parole = "smiley/parole.txt";
	$apri = fopen($parole, 'r+');
	$grandezza = filesize($parole);
	$leggi = fread($apri, $grandezza);
	$controllo = explode(" - ", $leggi);
	return $controllo;
	}
	
	function mostra_smiley() {
	foreach($this->elabora_smiley() as $limi) {
	$ciao = explode(" ", $limi);
	if ($ciao[0] != "") {
		$faccine .= '<img src="smiley/'.$ciao[0].'.gif" alt="" style="cursor:pointer" onclick="smiley(\' '.$ciao[1].' \')" />';
		}
	}
	$this->faccine = $faccine;
	include("plugin/bbcode.php");
	if ($attivo == "si") {
	$this->faccine .= '&nbsp;&nbsp;<img class="bbcode" style="cursor:pointer" onclick="bbcode(\'b\')" src="smiley/b.gif" border="0" alt="" /><img style="cursor:pointer" onclick="bbcode(\'u\')" class="bbcode" src="smiley/u.gif" border="0" alt="" /><img class="bbcode" src="smiley/i.gif"style=" cursor:pointer" onclick="bbcode(\'i\')" border="0" alt="" />';
	}
	}
	
	function converti_smiley($testo) {
	foreach($this->elabora_smiley() as $limi) {
		$ciao = explode(" ", $limi);
		$testo = str_replace($ciao[1], "<img src=\"smiley/$ciao[0].gif\" alt=\"\" />", $testo);
	}
	return $testo;
	}
	
	function converti_parole($testo) {
	foreach($this->elabora_parole() as $limi) {
		$ciao = explode(" ", $limi);
		$testo = str_replace($ciao[0], $ciao[1], $testo);
	}
	return $testo;
	}
	
	function conteggia_mess() {
	$tot = 0;
	$contenuto = $this->contenuto;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $dati) {
		$info = explode("||", $dati);
		if ($info[2] == "confermato") {
			$tot++;
		}
	}
	return $tot;
	}
	
	function conteggia_mess_attesa() {
	$tot = 0;
	$contenuto = $this->contenuto;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $dati) {
		$info = explode("||", $dati);
		if ($info[2] == "attesa") {
			$tot++;
		}
	}
	return $tot;
	}
	
	function conteggia_pag() {
	$tot = ceil($this->conteggia_mess()/$this->per_pagina);
	return $tot;
	}
	
	function footer() {
	$urlsito = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	echo '
	<div class="box">
	<div class="separatore"></div>
	Powered by <b><a class="copy" href="http://www.txtgbook.altervista.org">Txtgbook Pro 1.2.2</a></b><div class="separatore"></div><a href="http://validator.w3.org/check?uri=referer"><img src="smiley/xhtml.jpg" alt="Valid XHTML 1.0 Transitional" border="0" /></a>&nbsp;<a href="http://jigsaw.w3.org/css-validator/validator?uri='.$urlsito.'"><img src="smiley/css.gif" alt="Valid Css" border="0" /></a>&nbsp;<a href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.it"><img src="smiley/cc.png" alt="Licenza Creative Commons" border="0" /></a>
	<div class="separatore"></div>
	</div>&nbsp;';
	}
	
	function header_impaginazione() {
	$conteggio = "&nbsp;";
	$i = 1;
	$l = 1;
	if (!$_GET['l']) {
		$_GET['l'] = 1;
	}
			
		$this->inizio = $this->per_pagina*($_GET['l']-1);
		$this->fine = $this->inizio+$this->per_pagina;
	
	if ($this->conteggia_mess() <= $this->per_pagina) {
	} else {
		$tot = ceil($this->conteggia_mess()/$this->per_pagina);
			while ($i <= $tot) {
			if ($i == "1") {
				$inizioa = "0";
				$finea = $this->per_pagina;
			} else {
				$inizioa = $this->per_pagina*$l;
				$finea = $inizioa+$this->per_pagina;
				$l++;
			}
			if ($_GET['l'] == $l) {
				$conteggio .= '| '.$l.' ';
			} else {
				if ($l == "1") {
				$conteggio .= '| <b><a href="index.php">'.$i.'</a></b> ';
				} else {
				$conteggio .= '| <b><a href="index.php?l='.$l.'">'.$i.'</a></b> ';
				}
			}
			$i++;
			}
			$conteggio .= " |";
			}
	$this->mostra_pagine = $conteggio;
	}
	
	function box_frecce() {
	if ($_GET['l'] == "1") {
	$p = '';
	} elseif ($_GET['l'] == "2") {
	$p = '<a href="index.php">&lt;&lt;</a>';
	} else {
	$pp = $_GET['l']-1;
	$p = '<a href="index.php?l='.$pp.'">&lt;&lt;</a>';
	}
	$tot = $this->conteggia_pag();
	if ($_GET['l'] == $tot) {
	$s = '';
	} else {
	$ss = $_GET['l']+1;
	$s = '<a href="index.php?l='.$ss.'">&gt;&gt;</a>';
	}
	echo '
	<div class="box">
		<div class="separatore"></div>
		<table cellspacing="0" cellpadding="0" border="0" width="98%" align="center" style="height:15px"><tr>
			<td align="left" width="10%">'.$p.'</td>
			<td width="80%" align="center"><a href="scrivi.php" class="scrivi"><b>| '.$this->array_lingua['scrivi_corto'].' |</b></a></td>
			<td width="10%" align="right">'.$s.'</td>
		</tr></table>
		<div class="separatore"></div>
	</div>&nbsp;
	';
	}
	
	function box_pagine_su() {
	if (str_replace("&nbsp;", "", trim($this->mostra_pagine)) != "") {
	echo '
	<div class="box">
		<div class="separatore"></div>
		'.$this->mostra_pagine.'
		<div class="separatore"></div>
	</div>&nbsp;
	';
	}
	}
	
	function box_pagine_giu() {
	echo '
	<div class="box">
		<div class="separatore"></div>
		'.$this->mostra_pagine.'
		<div class="separatore"></div>
	</div>&nbsp;
	';
	}
	
	function box_info() {
	echo '<div class="box">
	<div class="separatore"></div>
		'.$this->array_lingua['mess_totali'].'<b>'.$this->conteggia_mess().'</b> | '.$this->array_lingua['pag_totali'].'<b>'.$this->conteggia_pag().'</b>
	<div class="separatore"></div>
	</div>&nbsp;';
	}
	
	function box_stat() {
	$skin = $this->skin;
	include("skin/".$this->skin."/box_statistiche.php");
	$this->footer();
	}
	
	function browser() {
	include("browser.php");
	return $browser;
	}
	
	function ip() {
	return $_SERVER['REMOTE_ADDR'];
	}
	
	function os() {
	include("os.php");
	return $os;
	}
	
	function online() {
	include("online.php");
	return $online;
	}
	
	function verifica_login($username, $password) {
	include("plugin/mod_plus.php");
	if ($username == "" AND  $password == "") {
		return "no";
	}
	$mod_user_array = explode("|", $mod_user);
	$mod_pass_array = explode("|", $mod_pass);
	$i = 0;
	foreach($mod_user_array as $limi) {
	if ($username == $limi AND $password == $mod_pass_array[$i]) {
		$is_mod = "si";
	}
	$i++;
	}
	if ($this->admin == $username AND $this->pass == $password) {
		return "si";
	} elseif ($is_mod == "si") {
		return "mod";
	} else {
		return "no";
	}
	}
	
	function login_fallito() {
	echo '
	<div class="box">
		<div class="separatore"></div>
		'.$this->array_lingua['login_fallito'].'
		<div class="separatore"></div>
	</div>&nbsp;
	';
	}
	
	function ricava_box($loggato) {
	if ($loggato == "si") {
		return '
		<div class="tab_box">
			<br /><b>
			<a href="admin.php?aperto=si">'.$this->array_lingua['home'].'</a></b> | <b>
			<a href="admin.php?aperto=si&sezione=impostazioni">'.$this->array_lingua['impostazioni'].'</a></b> | <b>
			<a href="admin.php?aperto=si&amp;sezione=validazione">'.$this->array_lingua['validazione_mess'].' ('.$this->conteggia_mess_attesa().')</a></b> | <b>
			<a href="admin.php?aperto=si&amp;sezione=scrivi_annuncio">'.$this->array_lingua['annunci'].'</a></b> | <b>
			<a href="admin.php?aperto=si&amp;sezione=smiley">'.$this->array_lingua['gestione_smiley'].'</a></b> | <b>
			<a href="admin.php?aperto=si&amp;sezione=plugin">'.$this->array_lingua['plugin'].'</a></b> | <b>
			<a href="logout.php">'.$this->array_lingua['logout'].'</a>
			</b><br />&nbsp;
		</div>';
	} elseif ($loggato == "mod") {
			return '
		<div class="tab_box">
			<div class="separatore"></div>
			'.$this->array_lingua['ciao'].' <b>'.$_SESSION['nick'].' | <a href="logout.php">'.$this->array_lingua['logout'].'</a></b>
			<div class="separatore"></div>
		</div>';
	} else {
		return '
		<div class="tab_box">
			<div class="separatore"></div><div class="separatore"></div>
			<form method="post" action="login.php" style="display:inline"><b>'.$this->array_lingua['username'].': </b><input type="text" name="user" />&nbsp;
			<b>'.$this->array_lingua['password'].': </b><input type="password" name="pass" />&nbsp;
			<input type="submit" value="'.$this->array_lingua['login'].'" /></form><div class="separatore"></div><div class="separatore"></div>
		</div>';
	}
	}	
	
	function ricava_link($num) {
	$skin = $this->skin;
	if ($_SESSION['loggato'] == "si" OR $_SESSION['loggato'] == "mod") {
		return '<a href="edita.php?num='.$num.'" title="'.$this->array_lingua['modifica'].'"><img src="skin/'.$skin.'/edita.gif" border="0" alt="" /></a>
		<a href="#" title="'.$this->array_lingua['elimina'].'" onclick="elimina('.$num.')"><img src="skin/'.$skin.'/elimina.gif" border="0" alt="" /></a>';
	} else {
		return '&nbsp;';	
	}
	}
	
	function info_mess($id) {
	$num = 0;
	$contenuto = $this->contenuto;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $val) {
		$num++;
		if  ($num == $id) {
			$dati = explode("||", $val);
			$autore = $dati[0];
			$messaggio = $dati[1];
			$stato = $dati[2];
			$data = $dati[3];
			$ora = $dati[4];
			$mail = $dati[5];
			$sito = $dati[6];
			$ip = $dati[7];
			$field_adder = $dati[8];
			$this->box_edit($autore, $messaggio, $mail, $sito, $data, $ora, $ip, $num, $field_adder);
		}
	}
	}
	
	function stringa_da_num($id) {	
	$contenuto = $this->contenuto;
	$num = 0;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $val) {
		$num++;
		if  ($num == $id) {
			$dati = explode("||", $val);
			$autore = $dati[0];
			$messaggio = $dati[1];
			$stato = $dati[2];
			$data = $dati[3];
			$ora = $dati[4];
			$mail = $dati[5];
			$sito = $dati[6];
			$ip = $dati[7];
			$field_adder = "".$dati[8];
			return ''.$autore.'||'.$messaggio.'||'.$stato.'||'.$data.'||'.$ora.'||'.$mail.'||'.$sito.'||'.$ip.'||'.$field_adder.'(|!|)';
		}
	}
	}
	
	function select_skin() {
	if ($this->cambio_skin_abilitato == "si" and $_SESSION['loggato'] != "si") {
	$dir = "skin";
	$option = "<select name=\"skin\" id=\"skin\" onchange=\"checkskin()\">";
	$open = opendir($dir);
	while ($read = readdir($open)) {
		if ($read != "." AND $read != "..") {
			if ($read == $this->skin) {
			$option .= '<option value="'.$read.'" selected="selected">'.ucfirst($read).'</option>';
			} else {
			$option .= '<option value="'.$read.'">'.ucfirst($read).'</option>';
			}
		}
	}
	$option .= "</select>";
	return $option;
	} else {
	return ucfirst($this->skin);
	}
	}
			
	function box_edit($autore, $messaggio, $mail, $sito, $data, $ora, $ip, $num) {
	$skin = $this->skin;
	$messaggio = str_replace("<br />", chr(13), $messaggio);
	$messaggio = str_replace("<br>", chr(13), $messaggio);
	include("skin/".$this->skin."/box_edit.php");
	echo $output;
	}
	
	function verifica_annuncio($nome) {
	$admin = $this->admin;
	if ($admin == $nome) {
		return "si";
	} else {
		return "no";
	}
	}
		
	function box_impostazioni() {
	$skin = $this->skin;
	if ($this->validazione == "si") {
		$si = "selected=\"selected\"";
	} else {
		$no = "selected=\"selected\"";
	}	
	
	$dir = "skin";
	$open = opendir($dir);
	while ($read = readdir($open)) {
		if ($read != "." AND $read != "..") {
			if ($read == $skin) {
			$option .= '<option value="'.$read.'" selected="selected">'.ucfirst($read).'</option>';
			} else {
			$option .= '<option value="'.$read.'">'.ucfirst($read).'</option>';
			}
		}
	}
	
	$dir = "language";
	$open = opendir($dir);
	while ($read = readdir($open)) {
		if ($read != "." AND $read != "..") {
			$read = str_replace(".php", "", $read);
			if ($read == $this->lingua) {
			$lingua .= '<option value="'.$read.'" selected="selected">'.ucfirst($read).'</option>';
			} else {
			$lingua .= '<option value="'.$read.'">'.ucfirst($read).'</option>';
			}
		}
	}
	if(@imagecreate(200, 300)) {
	$gd = "attivate";
	@imagedestroy($img);
	} else {
	$gd = "disattivate";
	}
	
	if ($this->notifica == "si") {
		$notifica = "<option value=\"si\">".$this->array_lingua['si']."</option><option value=\"no\">".$this->array_lingua['no']."</option>";
	} else {
		$notifica = "<option value=\"si\">".$this->array_lingua['si']."</option><option value=\"no\" selected=\"selected\">".$this->array_lingua['no']."</option>";
	}
	if ($this->antispam == "no") {
		$antispam = "<option value=\"no\">".$this->array_lingua['no']."</option><option value=\"si\">".$this->array_lingua['si']."</option>";
	} else {
		$antispam = "<option value=\"si\">".$this->array_lingua['si']."</option><option value=\"no\">".$this->array_lingua['no']."</option>";
	}
	if ($this->cambio_skin_abilitato == "no") {
		$cambio_skin_abilitato = "<option value=\"no\">".$this->array_lingua['no']."</option><option value=\"si\">".$this->array_lingua['si']."</option>";
	} else {
		$cambio_skin_abilitato = "<option value=\"si\">".$this->array_lingua['si']."</option><option value=\"no\">".$this->array_lingua['no']."</option>";
	}
	
	if(@imagecreate(200, 300) === false) {
	$antispam = "<option value=\"no\">".$this->array_lingua['no']."</option>'";
	}
		
	$outputa = '
	<br />
			<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr align="left">
    		<td width="30%" height="20"><b>'.$this->array_lingua['file_mess'].':</b></td>
    		<td><input type="text" name="file" size="30" disabled="disabled" value="'.$this->file.'" /></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['nome_gb'].':</b></td>
    		<td><input type="text" name="titolo" size="30" value="'.$this->titolo.'" /></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['admin_mail'].':</b></td>
    		<td><input type="text" name="mail" size="30" value="'.$this->mail.'" /></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['per_pagina'].':</b></td>
    		<td><input type="text" name="per_pagina" size="6" value="'.$this->per_pagina.'" /></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['validazione_mess'].':</b></td>
    		<td><select name="validazione"><option value="si" '.$si.'>'.$this->array_lingua['si'].'</option><option value="no" '.$no.'>'.$this->array_lingua['no'].'</option></select> // Richiede validazione admin</td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['skin_gb'].':</b></td>
    		<td><select name="skin">'.$option.'</select></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['mail_notifica'].':</b></td>
    		<td><select name="notifica">'.$notifica.'</select></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['maxchar'].':</b></td>
    		<td><input type="text" name="maxlenght" value="'.$this->maxlenght.'" size="4" /></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['lingua'].':</b></td>
    		<td><select name="lingua">'.$lingua.'</select></td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['codice_antispam'].':</b></td>
    		<td><select name="antispam">'.$antispam.'</select> '.$this->array_lingua['codice_desc'].'</td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['cambio_skin_utente'].':</b></td>
    		<td><select name="cambio_skin_abilitato">'.$cambio_skin_abilitato.'</select> '.$this->array_lingua['cambio_skin_desc'].'</td>
  			</tr>
			<tr align="left">
    		<td height="20"><b>'.$this->array_lingua['antiflod'].':</b></td>
    		<td><input type="text" name="antiflood" value="'.$this->antiflood.'" size="4" /> // '.$this->array_lingua['antiflood_desc'].'</td>
  			</tr>
			</table>
		<input type="submit" value="'.$this->array_lingua['conferma'].'" /><br />&nbsp;
	';
	include("skin/".$this->skin."/box_impostazioni.php");
	}
	
	function elabora_in_attesa() {
	$num = 0;
	$contenuto = $this->contenuto;
	$explode = explode("(|!|)", $contenuto);
	foreach ($explode as $val) {
		$num++;
		if  ($val != "") {
			$dati = explode("||", $val);
			$autore = $dati[0];
			$messaggio = $dati[1];
			$stato = $dati[2];
			$data = $dati[3];
			$ora = $dati[4];
			$mail = $dati[5];
			$sito = $dati[6];
			$ip = $dati[7];
			$field_adder = $dati[8];
			$confermato = $this->verifica_stato($stato);
			if ($confermato == "no") {
				$this->impagina_mess_validazione($autore, $messaggio, $data, $ora, $mail, $sito, $ip, $num);
			} 
		}
	}
	}
	
	function impagina_mess_validazione($autore, $messaggio, $data, $ora, $mail, $sito, $ip, $num, $field_adder) {
	$messaggio = wordwrap($messaggio, 55, "<br />");
	$messaggio = $this->rileva_link($messaggio);
	$messaggio = $this->converti_smiley($messaggio);
	$messaggio = $this->converti_parole($messaggio);
	$skin = $this->skin;
	include("skin/".$this->skin."/impagina_mess_validazione.php");
	$this->output .= $output;
	}
	
	function tabella_smiley() {
	$output = '<table width="30%" border="0">
    <tr class="tabella">
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['immagine'].'</b></font></td>
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['codice'].'</b></font></td>
	  <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>';
	foreach($this->elabora_smiley() as $limi) {
		$ciao = explode(" ", $limi);
		if ($ciao[0] != "") {
			$output .= "<tr align=\"center\"><td width=\"33%\"><img src=\"smiley/$ciao[0].gif\" alt=\"\" /></td><td width=\"33%\">$ciao[1]</td>
			<td width=\"33%\"><input type=\"button\" value=\"".$this->array_lingua['elimina']."\" onclick=\"location.href='elabora.php?azione=elimina_smiley&amp;codice=$ciao[0]||$ciao[1]'\" /></td></tr>";
		}
	}
	$output .= "</table>";
	return $output;
	}
	
	function tabella_aggiunta_smiley() {
	$output = '<form method="post" action="elabora.php?azione=aggiungi_smiley">
	<table width="30%" border="0">
    <tr class="tabella">
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['immagine'].'</b></font></td>
      <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['codice'].'</b></font></td>
	  <td width="33%" align="center"><font color="white"><b>'.$this->array_lingua['azione'].'</b></font></td>
    </tr>
	<tr align="center">
	<td width="33%"><input type="text" name="img" value="" /></td>
	<td width="33%"><input type="text" name="codice" value=":)" onclick="this.value=\'\'" /></td>
	<td width="33%"><input type="submit" value="'.$this->array_lingua['aggiungi'].'" /></td></tr></table>&nbsp;<br />'.$this->array_lingua['desc_smiley'].'
	</form>';
	return $output;
	}
	
	function elimina_smiley($codice) {
	$smiley = "smiley/smiley.txt";
	$apri = fopen($smiley, 'r+');
	$grandezza = filesize($smiley);
	$leggi = fread($apri, $grandezza);
	
	$contenuto = str_replace($codice, "", $leggi);
	$apri = @fopen("smiley/smiley.txt", "w+");
	$scrivi = @fwrite($apri, $contenuto);
	if ($scrivi) {
		return "ok";
	} else {
		return $this->errore(5);
	}
	}
	
	function aggiungi_smiley($codice) {
	$apri = @fopen("smiley/smiley.txt", "a+");
	$scrivi = @fwrite($apri, $codice);
	if ($scrivi) {
		return "ok";
	} else {
		return $this->errore(5);
	}
	}
	
	function box_smiley() {
	$skin = $this->skin;
	include("skin/".$this->skin."/box_smiley.php");
	}
	
	function plugin($nome_plugin) {
	if ($nome_plugin == "") {
	echo '
	<div class="box">
	<div align="left">
	';
	$dir = opendir("plugin");
	while($o = readdir($dir)) {
	if ($o != "." AND $o != "..") {
	$lunghezza = strlen($o);
	if (strpos($o, "_inc") === false AND substr($o,-5,1) == "c") {
	$uno = "si";
	$o = str_replace(".php", "", $o);
	include("plugin/$o.php");
	$o = str_replace("_desc", "", $o);
	$nome = ucfirst(str_replace("_", " ", $o));
	echo '
	&nbsp;<br />&nbsp;&nbsp;<b><a href="admin.php?aperto=si&amp;sezione=plugin&amp;nome='.$o.'">'.$nome.'</a></b><br />&nbsp;&nbsp;'.$descrizione[$this->lingua].'<br />&nbsp;
	';
	}
	}
	}
	if ($uno != "si") {
	echo "<div class=\"separatore\"></div>&nbsp;&nbsp;No plugin installated<div class=\"separatore\"></div>";
	}
	echo '
	</div></div>&nbsp;
	';
	} else {
	include("plugin/".$nome_plugin."_box.php");
	}	
	}
	
	function permessi($ele) {
	if (@is_writable($ele)) {
		return '<b><font color="green">'.wr.'</font></b>';
	} else {
		define("problema", "si");
		return '<b><font color="red">'.unwr.'</font></b>';
	}
	}
	
	function box_home() {
	$skin = $this->skin;
	$contenuta = '
	<div class="separatore"></div>
	<div style="width:98%;margin:auto;">
	<b>'.$this->array_lingua['ciao'].' '.$_SESSION['user'].'</b><br />
	'.$this->array_lingua['ben_admin'].'<br />&nbsp;<br />
	<strong>-&gt; '.$this->array_lingua['i_sito'].'</strong><br />
	<a class="scrivi" href="http://www.txtgbook.altervista.org">http://www.txtgbook.altervista.org</a><br>&nbsp;<br>
	<strong>-&gt; '.$this->array_lingua['check_version'].'</strong><br>
	<a class="scrivi" href="http://www.txtgbook.altervista.org/index.php?versione=p1.2.2">'.$this->array_lingua['v_update'].'</a>
	<br />&nbsp;<br />'.$_GET['mess'].'&nbsp;<form method="post" action="configura.php?action=dati">
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr align="left">
    		<td width="20%" height="20"><b>'.$this->array_lingua['i_vp'].':</b></td>
    		<td><input type="password" name="old" /></td>
  			</tr>
			<tr align="left">
    		<td width="20%" height="20"><b>'.$this->array_lingua['i_np'].':</b></td>
    		<td><input type="password" name="new" /></td>
  			</tr>
			<tr align="left">
    		<td width="20%" height="20"><input type="submit" value="'.$this->array_lingua['cambio_dati'].'" /></td>
    		<td>&nbsp;</td>
  			</tr>
	</table>	
	</form>
	</div>';
	include("skin/".$skin."/box_home.php");
	}
	

}
?>