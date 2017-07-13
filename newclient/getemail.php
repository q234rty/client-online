<?php
$email = "";
if(!empty($_POST['user'])){
	$name = $_POST['user'];
	if(file_exists("psws/{$name}.log")){
		$file = fopen("psws/{$name}.log", "r");
		$rd = json_decode(fread($file, filesize("psws/{$name}.log")));
		fclose($file);
		$email = $rd -> email;
	}
}
echo md5(strtolower(trim("{$email} ")));
?>