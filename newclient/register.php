<?php 
$uname = $_POST['name'];
$psw1 = $_POST['psw1'];
$psw2 = $_POST['psw2'];
$file = "psws/{$uname}.log";
$email = $_POST['mail'];
$warning = "";
setcookie("clientname", "", time()-3600);
if(!empty($uname)){
	$hasuser = file_exists($file);
	if(!$hasuser){
		if($psw1 === $psw2){
			if(!empty($email)){
				setcookie("clientname", $uname, time()+3600);
				$profile = array('psw'=>hash("md5", hash("md5", $psw1, False), False),'email'=>$email,'level'=>1);
				$op = fopen($file, "w");
				fwrite($op, json_encode($profile));
				fclose($op);
				header("Location: /main/");
			} else $warning = "Enter your email!";
		} else $warning = "Two passwords are not the same.";
	} else $warning = "Already has that user!";
} else $warning = "我们会把密码加密保存，但不能保证绝对安全";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client-login</title>
	<link rel="stylesheet" type="text/css" href="/css/fira_code.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" href="/favicon.ico">
	<style type="text/css">
		h1{
			font-weight: lighter;
			font-size: 2.5em;
			text-align: center;
			text-indent: 0;
			height: 44px;
			font-family: 'Copperplate Gothic';
		}
		input{
			padding: 5px;
			width: 250px;
			font-family: 'Microsoft Yahei';
		}
		.p{font-family: 'Copperplate Gothic';}
	</style>
</head>
<body style="background-color: #eee;">
<center>
<div style="height: 100px;"></div>
<div style="box-shadow: 0px 0px 100px #ccc;text-align: left;width: 580px;height: 370px;text-indent: 40px;background-color: #fff;" id="p">
	<h1 style="padding:20px;">Register</h1>
	<form action="/register.php" method="post">
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
					<input type="password" name="psw1">
				</td>
			</tr>
			<tr>
				<td class="p">Repeat Password:</td>
				<td>
					<input type="password" name="psw2">
				</td>
			</tr>
			<tr>
				<td class="p">Email:</td>
				<td>
					<input type="email" name="mail">
				</td>
			</tr>
			<tr><td colspan="2"><p style="height:20px;color: red;">
			<?php echo $warning;?></p></td></tr>
			<tr>
				<td><a href="/" class="p">log in</a></td>
				<td><input type="submit" name="submit" value="Register" class="win10_button big" style="width: 265px;"></td>
			</tr>
		</table>
	</form>

</div></center>
</body>
</html>