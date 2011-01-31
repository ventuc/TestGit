<?php
/***************************************************************************
 *                       	Txtgbook Guestbook Php						   *
 *                            -------------------						   *
 *   Contact      	      : ghx31@hotmail.it							   *
 *   Site          		  : http://www.txtgbook.altervista.org			   *
 *																		   *
 ***************************************************************************/
$comp = getenv("HTTP_USER_AGENT");
if(strstr($comp, "Windows 95")) $os= 'Windows 95';
   else if(strstr($comp, "Windows 98")) $os = 'Windows 98';
   else if(strstr($comp, "Windows 2000")) $os = 'Windows 2000';
   else if(strstr($comp, "Windows XP")) $os = 'Windows XP';
   else if(strstr($comp, "Windows ME")) $os = 'Windows ME';
   else if(strstr($comp, "Windows NT")) $os = 'Windows';
   else if(strstr($comp, "Mac")) $os = 'Macintosh';
   else if(strstr($comp, "Linux")) $os = 'Linux';
   else if(strstr($comp, "Unix")) $os = 'Unix';
   else $os = 'Sconosciuto';
?> 
