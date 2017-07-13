<?php
if(!isset($_COOKIE['clientname']))
	header("Location: /");
$name = $_COOKIE['clientname'];
if(empty($name))
	header("Location: /");
?>
<!DOCTYPE html>
<html>
<head>
	<base target="_blank">
	<meta charset="utf-8">
	<title>Client - Online</title>
	<script src="/js/jquery.js"></script>
	<script src="/js/marked.js"></script>
	<script src="/js/prism.js"></script>
	<script src="/js/sw.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/fira_code.css">
	<link rel="stylesheet" type="text/css" href="/css/prism.css">
	<link rel="icon" href="/favicon.ico">
</head>
<body>
<center>
	<div id="fuck_zyy" class="main"></div>
	<div style="position: relative;margin-top: 10px;width: 90%;">
		<textarea id="msg" placeholder="Styling with Markdown is supported"></textarea>
		<ul class="toolbar">
			<li id="sendimg"><img src="/img/send-img.svg"></li>
			<li id="sendcode"><img src="/img/send-code.svg"></li>
			<li id="huaji"><img src="/img/huaji.png"></li>
		</ul>
		<div style="height: 40px;width: 200px;float: right;font-size: 2em;margin: 0;" class="win10_button big" id="sb">commit</div>
	</div>
</center>

<div class="notice">
	<h1>Notice</h1>
	<div style="text-align: left;padding-left: 20px;">
	<?php readfile("../notice.log"); ?>
	</div>
	<div style="position: absolute;top: 5px;right: 5px;">
		<a href="javascript:;" onclick="$('.notice').fadeOut(500)">Close</a>
	</div>
</div>

<div class="head">
	<div class="item tit">Client - Online</div>
	<div class="item name menu-icon-2" id="a"><?php echo $name?></div>
	<div id="menu">
		<ul class="menu-bar">
			<li><a href="/profile/?user=<?php echo $name;?>" class="link profile-icon" target="_self">我的资料</a></li>
			<li class="hr"></li>
			<li class="link notice-icon" id="show-notice">查看公告</li>
			<li><a href="/upload" class="link upload-icon">上传文件</a></li>
			<li class="hr"></li>
			<li><a href="/logout.php" class="link logout-icon" target="_self">登出</a></li>
		</ul>
	</div>
</div>

<!--[if IE]>
<script type="text/javascript">document.body.innerHTML='<p>你正在使用<strong>过时</strong>的浏览器，Client暂不支持。请 <a href="http://browsehappy.com/">升级浏览器</a>以获得更好的体验！</p>'</script>
<![endif]-->
</body>
</html>