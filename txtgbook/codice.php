<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
header("Content-type: image/png");

$img = imagecreate(90, 15);
$bianco = imagecolorallocate($img, 255, 255, 255);
$grigio = imagecolorallocate($img, 150, 150, 150);
$nero = imagecolorallocate($img, 0, 0, 0);

imagerectangle($img, 0, 0, 89, 29, $grigio); 

// Orizzontali
imageline($img, 0,8, 89, 8, $grigio);
// Verticali
imageline($img, 15,0, 15, 29, $grigio);
imageline($img, 30,0, 30, 29, $grigio);
imageline($img, 45,0, 45, 29, $grigio);
imageline($img, 60,0, 60, 29, $grigio);
imageline($img, 75,0, 75, 29, $grigio);

imagettftext($img, 10, 0, 10, 13, $nero, "smiley/verdana.ttf", $_GET['testo']);

imagegif($img);
imagedestroy($img);
?>