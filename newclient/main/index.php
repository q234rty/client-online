<?php
$name = $_POST['name'];
if($name == '') header("Location: /");
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
	<div style="position: relative;width: 90%;">
		<div id="fuck_zyy" class="main"></div>
		<div style="position: relative;background-color: #ccc;border: 1px solid #555;padding: 5px;margin-top: 10px;">
			<textarea id="msg" style="width: 99%;max-width: 99%;height: 73px;float: top;" placeholder="Styling with Markdown is supported"></textarea>
			<button onclick="send()" style="top: 5px;left: 0;height: 40px;width: 200px;float: right;font-size: 2em;" class="win10_button big">commit</button>
			<ul class="toolbar">
				<li id="sendimg"><img src="/img/send-img.svg"></li>
				<li id="sendcode"><img src="/img/send-code.svg"></li>
				<li id="huaji"><img src="/img/huaji.png"></li>
			</ul>
			<div style="height: 55px;"></div>
		</div>
		<div style="height: 100px;">
<!--[if IE]>
<script type="text/javascript">document.body.innerHTML='<p>你正在使用<strong>过时</strong>的浏览器，Client暂不支持。请 <a href="http://browsehappy.com/">升级浏览器</a>以获得更好的体验！</p>'</script>
<![endif]-->
		</div>
	</div>
</center>
<div class="head">
	<div class="item tit">Client - Online</div>
	<div class="item name"><?php echo $name?></div>
</div>
<div class="notice">
	<h1>Notice</h1>
	<div style="text-align: left;padding-left: 20px;">
		<h2 style="margin: 0;">6.27 update</h2>
		<p>又加了点css特效，新加了几张壁纸，设置为自动切换，希望大家喜欢⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</p>
		<p>什么？听说你想盗图？我怎么可能会让你这么轻松就盗走？</p>
	</div>
	<div style="position: absolute;top: 5px;right: 5px;">
		<a href="javascript:;" onclick="$('.notice').fadeOut(500)">Close</a>
	</div>
</div>
</body>
</html>