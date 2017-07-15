<?php
$name = $_GET['user'];
$profile_path = "../psws/{$name}.log";
$hasuser = file_exists($profile_path);
$email = $level = 0;
if($hasuser){
	$op = fopen($profile_path, "r");
	$profile = json_decode(fread($op, filesize($profile_path)));
	fclose($op);
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
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div style="margin: 5rem;box-shadow: 0px 0px 10px #ccc;padding: 2rem;">
	<?php if ($hasuser): ?>
		<h1><?php echo $name; ?>的个人资料：</h1>
		<p>邮箱：<?php echo $email; ?></p>
		<p>等级：
		<?php if ($level == 5): ?>
			LV5 <span class="lv5">超级管理员</span>
		<?php elseif($level == 4): ?>
			LV4 <span class="lv4">管理员</span>
		<?php elseif($level == 3): ?>
			LV3 <span class="lv3">高级用户</span>
		<?php elseif($level == 2): ?>
			LV2 <span class="lv2">中级用户</span>
		<?php elseif($level == 1): ?>
			LV1 <span class="lv1">普通用户</span>
		<?php else: ?>
			LV0 <span class="lv0">封禁用户</span>
		<?php endif ?>
		<a href="/level.html" style="color:gray;font-size: x-small;">这是什么？</a>
		</p>
	<?php else: ?>
		<h1>查无此人！</h1>
	<?php endif ?>
</div>
</body>
</html>