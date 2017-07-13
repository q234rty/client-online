<?php
if(isset($_COOKIE['clientname']))
	header("Location: /main/");
$uname = $_POST['name'];
$psw = $_POST['psw'];
$warning = "为了显示头像，我需要收集邮箱，劳烦再一次重新注册（原帐号密码已清空）";
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
				setcookie("clientname", $uname, time()+3600);
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
	<style type="text/css">
		*{font-family: 'Copperplate Gothic';}
		h1{font-weight: lighter;font-size: 2.5em;text-align: center;text-indent: 0;height: 44px;}
		input{padding: 5px;width: 250px;}
		.but{background-color: #66ccff;border:0;width: 265px;height: 40px;font-size: 1.7em;font-weight: lighter;}
		.but:hover{background-color: #55bbee;cursor: pointer;}
	</style>
	<link rel="icon" href="/favicon.ico">
</head>
<body>
<center>
<div style="height: 100px;"></div>
<div style="box-shadow: 0px 0px 100px #ccc;text-align: left;width: 500px;height: 300px;text-indent: 40px;" id="p">
	<h1 style="padding:20px;">Client - Online</h1>
	<form action="/" method="post">
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
			<?php echo $warning; ?>
			</p></td></tr>
			<tr>
				<td><a href="/register.php">register</a></td>
				<td><input type="submit" name="submit" value="Log in" class="but"></td>
			</tr>
		</table>
	</form>

</div></center>
</body>
</html>