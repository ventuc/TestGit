<?php

function val($a){
	$a++;
}

function ref(&$a){
	$a++;
}

class MyC {
	public $att = "boh";
}

function myCval($a){
	$a->att = "ciao";
}

function myCref(&$a){
	$a->att = "ciao";
}

function retval($a){
	$a->att = "ciao";
	return $a;
}

function &retref($a){
	$a->att = "ciao";
	return $a;
}

function varretval(&$a){
	$a++;
	return $a;
}

function &varretref(&$a){
	$a++;
	return $a;
}

$var = 1;
echo $var."<br />"; // Stampa 1
val($var);
echo $var."<br />"; // Stampa 1
ref($var);
echo $var."<br />"; // Stampa 2

$var = new MyC();
print_r($var); // Stampa "boh"
echo "<br />";
myCval($var);
print_r($var); // Stampa "ciao"
echo "<br />";
myCref($var);
print_r($var); // Stampa "ciao"
echo "<br />";

$var = new MyC();
print_r($var); // Stampa "boh"
echo "<br />";
$var1 = retval($var);
print_r($var); // Stampa "ciao"
print_r($var1); // Stampa "ciao"
$var->att = "bello";
print_r($var); // Stampa "bello"
print_r($var1); // Stampa "bello"
echo "<br />";
$var1 = retref($var);
print_r($var); // Stampa "ciao"
print_r($var1); // Stampa "ciao"
$var->att = "bello";
print_r($var); // Stampa "bello"
print_r($var1); // Stampa "bello"
echo "<br />";

$var = 1;
echo $var."<br />"; // Stampa 1
$var1 = varretval($var);
echo $var."<br />"; // Stampa 2
echo $var1."<br />"; // Stampa 2
$var = 0;
echo $var."<br />"; // Stampa 0
echo $var1."<br />"; // Stampa 2
echo "<br />";
$var1 = varretref($var);
echo $var."<br />"; // Stampa 2
echo $var1."<br />"; // Stampa 2
$var = 0;
echo $var."<br />"; // Stampa 0
echo $var."<br />"; // Stampa 0
echo "<br />";

?>