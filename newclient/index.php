<?php
if(isset($_COOKIE['clientname']))
	header("Location: /main/");
$uname = $_POST['name'];
$psw = $_POST['psw'];
$warning = "";
if(!empty($uname) || !empty($psw))
	if(!empty($uname) && !empty($psw)){
		$paspath = "psws/{$uname}.log";
		$hasuser = file_exists($paspath);
		if($hasuser){
			$psw = hash("md5", hash("md5", $psw, False), False);
			$file = fopen($paspath, "r");
			$rightpsw = json_decode(fread($file, filesize($paspath)));
			fclose($file);
			if($psw === $rightpsw -> psw){
				setcookie("clientname", $uname, time()+2592000);
				header("Location: /main/");
			} else $warning = "Password Wrong!";
		} else $warning = "No such user!";
	} else $warning = "fill the blanks!";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client-login</title>
	<link rel="stylesheet" type="text/css" href="/css/fira_code.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<style type="text/css">
		.p{font-family: 'Copperplate Gothic';}
		h1{font-weight: lighter;font-size: 2.5em;text-align: center;text-indent: 0;height: 44px;}
	</style>
	<link rel="icon" href="/favicon.ico">
</head>
<body style="background-color: #eee;">
<center>
<div style="height: 100px;"></div>
<div style="box-shadow: 0px 0px 100px #ccc;text-align: left;width: 500px;height: 300px;text-indent: 40px;background-color: #fff;" id="p">
	<h1 style="padding:20px;" class="p">Client - Online</h1>
	<form action="/" method="post">
		<table>
			<tr>
				<td class="p">User Name:</td>
				<td>
					<input type="text" name="name" value="<?php echo $uname;?>" autocomplete="1">
				</td>
			</tr>
			<tr>
				<td class="p">Password:</td>
				<td>
					<input type="password" name="psw" id="psw">
				</td>
			</tr>
			<tr><td colspan="2"><p style="height:20px;color:red;">
			<?php echo $warning; ?>
			</p></td></tr>
			<tr>
				<td><a href="/register.php" class="p">register</a></td>
				<td align="right"><input type="submit" name="submit" value="Log in >" class="win10_button button_font"></td>
			</tr>
		</table>
	</form>

</div></center>
</body>
</html>