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
	if($hasuser) echo "{$name}の個人情報";
	else echo "誰？";
	?>
	</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/fira_code.css">
	<style type="text/css">h1{font-weight: lighter;}*{font-family: Microsoft Yahei;}td{padding: 0;}</style>
</head>
<body>
<div style="margin: 5rem;padding: 2rem;">
	<?php if ($hasuser): ?>
		<h1><span class="lv<?php echo $level; ?>"><?php echo $name; ?></span>の個人情報：</h1>
		<table>
		<?php if($level > 0): ?><tr>
		<td><span>経験：</span></td><td><div style="background-color: #ccc;width: 200px;height: 20px;display: inline-block;"><div style="background-color: #39C5BB;height: 20px;width: <?php echo $level == 5 ? 200 : min($exp/$top*200, 200); ?>px;"></div></div><span><?php echo ($level == 5 ? $top : min($exp, $top)) . "/" . $top; ?></span></td></tr>
		<?php endif ?>
		<tr><td style="width: 70px;">
		<span>メール：</span></td><td><span><?php echo $email; ?></span></td></tr><tr>
		<td><span>レベル：</span></td><td><span>
		<?php if ($level == 5): ?>
			<span class="lv5">LV5 スーパー管理者</span>
		<?php elseif($level == 4): ?>
			<span class="lv4">LV4 管理者</span>
		<?php elseif($level == 3): ?>
			<span class="lv3">LV3 上級ユーザー</span>
		<?php elseif($level == 2): ?>
			<span class="lv2">LV2 中級ユーザー</span>
		<?php elseif($level == 1): ?>
			<span class="lv1">LV1 普通のユーザー</span>
		<?php else: ?>
			<span class="lv0">LV0 禁止されたユーザー</span>
		<?php endif ?>
		<a href="/level.html" style="color:gray;font-size: x-small;">これは何ですか</a></span>
		</span></tr>
		</table>
	<?php else: ?>
		<h1><ruby><rb>申</rb><rt>もう</rt></ruby>し<ruby><rb>訳</rb><rt>わけ</rt></ruby>ありませんが、「<?php echo $name; ?>」というユーザーが<ruby><rb>見</rb><rt>み</rt>つかりません。</ruby></h1>
	<?php endif ?>
</div>
</body>
</html>