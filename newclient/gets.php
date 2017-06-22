<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

readfile('logs/' . date("Y-n-d") . ".log");

ob_flush();
flush();
?>