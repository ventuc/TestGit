<?php
session_start();

if (@$_SESSION['loggato'] == "si") {
if (@$_POST['numero']) {
$attivo = $_POST['attivo'];
$path = $_POST['path'];
$numero = $_POST['numero'];

$fopen = fopen("rss_maker.php", "w+");
$cont = '<?php
$attivo = "'.$attivo.'";
$path = "'.$path.'";
$numero = "'.$numero.'";
?>
';
$fwrite = fwrite($fopen, $cont);
header("location: ../admin.php?aperto=si&sezione=plugin&nome=rss_maker");
}
}

class rss_maker 
{
  var $Articles = array();

  // Channel info
  var $title = '';
  var $link = '';
  var $description = '';

  function rss_maker($title, $link, $description) {
    $this->title = $title;
    $this->link = $link;
    $this->description = $description;
  }

  function aggiungi_mess($titolo, $link, $messaggio, $autore) {
  $i = array_push($this->Articles, array('title' => $titolo, 'link' => $link, 'description' => $messaggio, 'author' => $autore));
  }

  function Output(){
    $out = '<?xml version="1.0"?>' . "\n" .
        '<rss version="2.0">' . "\n" .
        '<channel>' . "\n";

    $out .= "<title>$this->title</title>\n" .
        "<link>$this->link</link>\n" .
        "<description>$this->description</description>\n";

    for( $i = 0, $c = count($this->Articles); $i < $c; $i++ ){
      $out .= "<item>\n";
      
      while(list($k, $v) = each($this->Articles[$i]))
      {
        $out .= "<".$k.">".$v."</".$k.">\n";
      }
        
      $out .= "</item>\n";
    }

    $out .= "</channel>\n</rss>";

	$out = str_replace("à", "a'", $out);
	$out = str_replace("è", "e'", $out);
	$out = str_replace("ì", "i'", $out);
	$out = str_replace("ò", "o'", $out);
	$out = str_replace("ù", "u'", $out);
      header("Content-type: application/xml");
	  echo $out;
  }
}
?>