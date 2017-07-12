<?php
$name = $_GET['user'];
$profile_path = "../psws/{$name}.log";
$hasuser = file_exists($profile_path);
$email = $level = 0;
if($hasuser){
	$op = fopen($profile_path, "r");
	$profile = json_decode(fread($op, filesize($profile_path)));
	$email = $profile -> email;
	$level = $profile -> level;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
	<?php
	if($hasuser) echo "{$name}的个人资料";
	else echo "查无此人！";
	?>
	</title>
</head>
<body>
<div style="margin: 5rem;box-shadow: 0px 0px 10px #eee;padding: 2rem;">
	<?php if ($hasuser): ?>
		<h1><?php echo $name; ?>的个人资料：</h1>
		<p>邮箱：<?php echo $email; ?></p>
		<p>等级：
		<?php if ($level == 5): ?>
			<span style="color: purple;">超级管理员</span>
		<?php elseif($level == 4): ?>
			<span style="color: purple;">高级管理员</span>
		<?php elseif($level == 3): ?>
			<span style="color: purple;">管理员</span>
		<?php elseif($level == 2): ?>
			<span style="color: blue;">普通用户</span>
		<?php else: ?>
			<span style="color: gray;">封禁用户</span>
		<?php endif ?>
		</p>
	<?php else: ?>
		<h1>查无此人！</h1>
	<?php endif ?>
</div>
</body>
</html>