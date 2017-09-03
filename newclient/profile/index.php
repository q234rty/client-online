<?php
$name = $_GET['user'];
$profile_path = "../psws/{$name}.log";
$hasuser = file_exists($profile_path);
$email = $exp = $level = $top = 0;
if($hasuser){
	$op = fopen($profile_path, "r");
	$profile = json_decode(fread($op, filesize($profile_path)));
	fclose($op);
	$email = $profile -> email;
	$exp = $profile -> exp;
	if($exp == 3.14) {
		$level = 5;
		$top = 10000;
	}
	else if($exp > 4500) {
		$level = 4;
		$top = 10000;
	}
	else if($exp > 1500) {
		$level = 3;
		$top = 4500;
	}
	else if($exp > 200) {
		$level = 2;
		$top = 1500;
	}
	else if($exp < 0) {
		$level = 0;
		$top = 1;
	}
	else {
		$level = 1;
		$top = 200;
	}
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
<div style="margin: 5rem;padding: 2rem;">
	<?php if ($hasuser): ?>
		<h1><?php echo $name; ?>的个人资料：</h1>
		<?php if($level > 0): ?>
		<div><span>经验：</span><div style="background-color: #ccc;width: 200px;height: 10px;display: inline-block;"><div style="background-color: #39C5BB;height: 10px;width: <?php echo $level == 5 ? 200 : min($exp/$top*200, 200); ?>px;"></div></div><span><?php echo ($level == 5 ? $top : $exp) . "/" . $top; ?></span></div>
		<?php endif ?>
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