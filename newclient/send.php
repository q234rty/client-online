<?php
if(!isset($_COOKIE['clientname'])){
	echo "alert('please login.');";
	exit;
}
$name = $_COOKIE['clientname'];
$msg = $_POST['msg'];
if(empty($msg) || $msg === "") exit;

$outputfile = 'logs/' . date("Y-n-d") . ".log";
$userfile = "psws/{$name}.log";

if(!file_exists($userfile)){
	echo "alert('Did you have registered?');";
	exit;
}

// read userfile
$file = fopen($userfile, "r");
$rd = json_decode(fread($file, filesize($userfile)));
fclose($file);

// check permissions
$level = 0;
$img_num = preg_match_all("/<img/", $msg);
$code_num = preg_match_all("/<pre>[\s\S]{50,}<\/pre>/", $msg);
$msglenth = strlen($msg);
$exp = $img_num * 3 + ($code_num > 0 ? 10 : 0) + 1;
if($rd -> exp == 3.14) $level = 5;
else if($rd -> exp > 4500) $level = 4;
else if($rd -> exp > 1500) $level = 3;
else if($rd -> exp > 200) $level = 2;
else if($rd -> exp < 0) $level = 0;
else $level = 1;
if ($level == 0){
	echo "alert('抱歉，您已被封禁！');";
	exit;
}
if ($level == 1 && $img_num > 5 ||
	$level == 2 && $img_num > 10 ||
	$level == 3 && $img_num > 20){
	echo "alert('图片数量超过限制');";
	exit;
}
if ($level == 1 && $msglength > 5000 ||
	$level == 2 && $msglength > 10000 ||
	$level == 3 && $msglength > 50000){
	echo "alert('字数超过限制');";
	exit;
}

// record
$file = fopen($outputfile, "a");
fwrite($file, "\n" . date("[H:i:s]") . $name . "|" . $msg);
fclose($file);

// calc exp
$x = $rd -> exp;
if($level < 5 && $level > 0)
	$rd -> exp = $x + $exp;

// update userfile
$op = fopen($userfile, "w");
fwrite($op, json_encode($rd));
fclose($op);

echo "console.log('Massage send successfully. Exp += {$exp}');";
echo "$('#msg').val('');"
?>