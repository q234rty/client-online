<?php
$uname = $_POST['name'];
$psw = $_POST['psw'];
if($psw != '') $psw = hash("md5", hash("md5", $psw, False), False);
$paspath = "psws/" . $uname . ".log";
$rightpsw = 'FUCK_YOU!';
$hasuser = file_exists($paspath);
if($uname != '' && $hasuser){
	$file = fopen($paspath, "r");
	$rightpsw = fread($file, filesize($paspath));
	fclose($file);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client-login</title>
	<style type="text/css">
		*{font-family: 'Copperplate Gothic';}
		h1{font-weight: lighter;font-size: 2.5em;text-align: center;text-indent: 0;height: 44px;}
		input{padding: 5px;width: 250px;}
		.but{background-color: #66ccff;border:0;width: 265px;height: 40px;font-size: 1.7em;font-weight: lighter;}
		.but:hover{background-color: #55bbee;cursor: pointer;}
	</style>
</head>
<body>
<center>
<div style="height: 100px;"></div>
<div style="box-shadow: 0px 0px 100px #ccc;text-align: left;width: 500px;height: 300px;text-indent: 40px;" id="p">
	<h1 style="padding:20px;">Client - Online</h1>
	<form action="/index.php" method="post">
		<table>
			<tr>
				<td>User Name:</td>
				<td>
					<input type="text" name="name" value="<?php echo $uname;?>" autocomplete="1">
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="password" name="psw" id="psw">
				</td>
			</tr>
			<tr><td colspan="2"><p style="height:20px;color:red;">
			<?php
			if($uname != '' || $psw != '')
				if($uname == '')
					echo 'Please enter your name!';
				else if(!$hasuser)
					echo 'No such user!';
				else if($psw !== $rightpsw)
					echo 'Password wrong!';
				else;
			else echo '密码保存系统有改动，请重新注册。';
			?></p></td></tr>
			<tr>
				<td><a href="/register.php">register</a></td>
				<td><input type="submit" name="submit" value="Log in" class="but"></td>
			</tr>
		</table>
	</form>

</div></center>

<?php if($rightpsw === $psw): ?>

<form action="/main.php" method="post" name="dog">
	<input type="hidden" name="name" value="{$uname}">
</form><script type="text/javascript">document.dog.submit();</script>

<?php elseif($uname != ''): ?>

	<script type="text/javascript">document.getElementById('psw').focus();</script>

<?php endif ?>
</body>
</html>