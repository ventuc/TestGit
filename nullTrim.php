<?php
$v1 = "";
$v2 = "ciao";
$v3 = null;

echo "trim di stringa vuota: ".trim($v1).". E' una stringa: ".is_string(trim($v1))."<br />";
echo "trim di stringa 'ciao': ".trim($v2).". E' una stringa: ".is_string(trim($v2))."<br />";
echo "trim di stringa null: ".trim($v3).". E' una stringa: ".is_string(trim($v3))."<br />";

?>