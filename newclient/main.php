<?php
$name = $_POST['name'];
if($name == '') header("Location: /index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client - Online</title>
	<script type="text/x-mathjax-config">
      MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <script type="text/javascript" async
      src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML">
    </script>
	<script src="/js/jquery.js"></script>
	<script src="/js/marked.js"></script>
	<script src="/js/sw.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<center>
	<div style="position: relative;width: 90%;">
		<div id="fuck_zyy" class="main"></div>
		<div style="position: relative;">
			<textarea id="msg" style="margin-top: 5px;width: 99%;max-width: 99%;height: 73px;float: top;" placeholder="Styling with Markdown is supported"></textarea>
			<button onclick="send()" style="top: 5px;left: 0;height: 40px;width: 200px;float: right;font-size: 2em;" class="but big">commit</button>
			<div style="height: 100px;"></div>
		</div>
	</div>
</center>
<div style="position: fixed;right: 0;top: 45px;box-shadow: -2px 2px 4px #999;">
	<ul class="ops" onmouseleave="$(this).hide(200);">
		<li id="send-code">Send code</li>
		<li id="send-pictrue">Send pictrue</li>
		<li id="notice">Notice</li>
	</ul>
</div>
<div class="head">
	<span style="padding: 5px;font-size: 2em;margin: 0;font-weight: bold;display: inline-block;" class="big">Client - Online</span>
	<span class="upd" onclick="$('.ops').show(200);" id="onamae"><?php echo $name?></span>
</div>
<div class="notice">
	<h1>Notice</h1>
	<div style="text-align: left;padding-left: 20px;">
		<h2 style="margin: 0;">6.21 update</h2>
		<p>只是把UI写的更加丑了点而已。</p>
		<p>现在支持传统的Markdown了。</p>
	</div>
	<div style="position: absolute;top: 5px;right: 5px;">
		<a href="javascript:;" onclick="$('.notice').fadeOut(500)">Close</a>
	</div>
</div>
</body>
</html>