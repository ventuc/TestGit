<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>
<body>
<?php 
$character=array(
		  array("name"=>"bob",
		  		"occupation"=>"superhero",
				"age"=>30,
				"specialty"=>"x-ray vision"),
   		  array("name"=>"sally",
		  		"occupation"=>"superhero",
				"age"=>24,
				"specialty"=>"superhuman strength"),
   		  array("name"=>"mary",
		  		"occupation"=>"arc villain",
				"age"=>63,
				"specialty"=>"nanotechnology"));
print $character[0]["occupation"];
?>
</body>
</html>
