<?php
if(!isset($_COOKIE['clientname'])) exit;
$name = $_COOKIE['clientname'];
$msg = $_POST['msg'];
if(empty($name) || empty($msg)) exit;
$outputfile = 'logs/' . date("Y-n-d") . ".log";
$file = fopen($outputfile, "a");
fwrite($file, "\n" . date("[H:i:s]") . $name . "|" . $msg);
fclose($file);

$file = fopen("psws/{$name}.log", "r");
$rd = json_decode(fread($file, filesize("psws/{$name}.log")));
fclose($file);

$x = $rd -> exp;
if($x == 3.14) exit;
if($x < 0) exit;
$rd -> exp = $x + $_POST['exp'];

$op = fopen("psws/{$name}.log", "w");
fwrite($op, json_encode($rd));
fclose($op);

echo "ok.";
?>