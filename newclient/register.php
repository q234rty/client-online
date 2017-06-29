<?php 
$name = $_POST['name'];
$psw1 = $_POST['psw1'];
$psw2 = $_POST['psw2'];
$file = "psws/{$name}.log";
$hasuser = False;
if($name != "")
	$hasuser = file_exists($file);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client-login</title>
	<link rel="stylesheet" type="text/css" href="/css/fira_code.css">
	<style type="text/css">
		*{
			font-family: 'Copperplate Gothic';
		}
		h1{
			font-weight: lighter;
			font-size: 2.5em;
			text-align: center;
			text-indent: 0;
			height: 44px;
		}
		input{
			padding: 5px;
			width: 250px;
		}
		.but{
			background-color: #66ccff;
			border: 0;
			width: 265px;
			height: 40px;
			font-size: 1.7em;
			font-weight: lighter;
		}
		.but:hover{
			background-color: #55bbee;
			cursor: pointer;
		}
	</style>
</head>
<body>
<center>
<div style="height: 100px;"></div>
<div style="box-shadow: 0px 0px 100px #ccc;text-align: left;width: 580px;height: 350px;text-indent: 40px;" id="p">
	<h1 style="padding:20px;">Register</h1>
	<form action="/register.php" method="post">
		<table>
			<tr>
				<td>User Name:</td>
				<td>
					<input type="text" name="name" value="<?php echo $name;?>" autocomplete="1">
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="password" name="psw1">
				</td>
			</tr>
			<tr>
				<td>Repeat Password:</td>
				<td>
					<input type="password" name="psw2">
				</td>
			</tr>
			<tr><td colspan="2"><p style="height:20px;color: red;">
			<?php if ($hasuser): ?>
				Aleary has that user!
			<?php elseif ($name !== "" && $psw1 === ""): ?>
				Please input your password!
			<?php elseif ($name !== "" && $psw1 !== $psw2): ?>
				Two passwords are not same?
			<?php else: ?>
				Does md5 hash save?
			<?php endif ?></p></td></tr>
			<tr>
			<td><a href="/index.php">log in</a></td>
				<td><input type="submit" name="submit" value="Register" class="but"></td>
			</tr>
		</table>
	</form>

</div></center>

<?php
if(!$hasuser && $name != "" && $psw1 == $psw2 && $psw1 != ""){
	$op = fopen($file, "w");
	fwrite($op, hash("md5", hash("md5", $psw1, False), False));
	fclose($op);
echo <<<EOF
<form action="/main.php" method="post" name="dog">
	<input type="hidden" name="name" value="{$name}">
</form><script type="text/javascript">document.dog.submit();</script>
EOF;
}
?>
</body>
</html>