<?php
if(!empty($_POST['user'])){
	$name = $_POST['user'];
	if(file_exists("psws/{$name}.log")){
		$file = fopen("psws/{$name}.log", "r");
		$rd = json_decode(fread($file, filesize("psws/{$name}.log")));
		fclose($file);
		$x = $rd -> exp;
		if($x == 3.14) echo "5";
		else if($x > 4500) echo "4";
		else if($x > 1500) echo "3";
		else if($x > 200) echo "2";
		else if($x < 0) echo "0";
		else echo "1";
	} else echo "0";
} else echo "0";
?>