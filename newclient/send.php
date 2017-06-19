<?php
$name = $_POST['name'];
$msg = $_POST['msg'];
if($name === "" || $msg === "") exit;
$outputfile = 'logs/' . date("Y-n-d") . ".log";
$file = fopen($outputfile, "a");
fwrite($file, "\n" . date("[H:i:s]") . $name . "|" . $msg);
fclose($file);
echo "ok.";
?>