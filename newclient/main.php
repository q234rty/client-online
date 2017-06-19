<?php
$name = $_POST['name'];
if($name == '') header("Location: /index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client - Online</title>
	<script src="/js/jquery.js"></script>
	<script src="/js/sw.js"></script>
	<style type="text/css">
	body{margin: 0;}h1,.big{font-family: 'Copperplate Gothic';font-weight: lighter;}
	.head{width: 100%;box-shadow: 0px 0px 10px #ccc;background-color: #fff;font-family: 'Copperplate Gothic';display: table;position: fixed;top: 0;}
	.upd{display: table-cell;vertical-align: middle;text-align: center;position: relative;}
	.upd:hover{background-color: #eee;cursor: pointer;}
	.upd:before{content: "";position: absolute;left: 0; top: 0;width: 100%;height: 2px;opacity: 0;}
	.upd:hover:before{background-color: #66ccff;opacity: 1;}
	.ops{margin: 0;padding: 0;display: none;background-color: #fff;}
	.ops li{padding: 15px;list-style-type: none;font-family: 'Copperplate Gothic';width: 150px;position: relative;}
	.ops li:hover{background-color: #eee;cursor: pointer;}
	.ops li:before{content: "";position: absolute;left: 0; top: 0;width: 5px;height: 100%;opacity: 0;}
	.ops li:hover:before{background-color: #66ccff;opacity: 1;}
	.main{text-align: left;}
	.at{text-decoration: none;}
	.at:before{content: "@";color: black;}
	.s1{background-color: #ccc;padding-left: 20px;padding-right: 20px;}
	.s0{background-color: #ddd;padding-left: 20px;padding-right: 20px;}
	.fixed-bottom{position: fixed;bottom: 0;}
	.send-code-dlg{box-shadow: 0px 0px 100px #999; position: fixed;z-index:1;top: 30%;left: 50%;margin: -141px 0 0 -301px;width: 600px;height:280px;text-align:center;background-color:#F4F4F4;overflow:hidden;display: none;}
	.notice{box-shadow: 0px 0px 100px #999; position: fixed;z-index:1;top: 30%;left: 50%;margin: -141px 0 0 -301px;width: 600px;height:280px;text-align:center;background-color:#F4F4F4;overflow:hidden;display: none;}
	.but{background-color: #66ccff;border: 0;width: 70px;height:30px;font-weight: lighter;margin: 5px;}
	.but:hover{background-color: #55bbee;cursor: pointer;}
	pre{margin: 0;padding: 0;background-color: #999;padding: 10px;word-wrap: break-word;white-space: pre-wrap;tab-size: 4;}
	pre code{font-family: 'Courier New';word-break: break-all;word-wrap: break-word;}
	::selection{background-color: #777;}::-moz-selection{background-color: #777;}
	a{text-decoration: none;color: #55bbdd;}
	</style>
</head>
<body>
<div style="position: relative;">
	<div style="height: 45px;"></div>
	<!-- menu -->
	<div style="width: 100%;">
	<!-- view -->
		<div id="fuck_zyy" class="main"></div>
		<div style="height: 50px;"></div>
		<!-- console -->
	</div>
</div>
<footer style="width: 100%;height: 50px;background-color: #ccc;box-shadow: 0px 0px 10px #999;" class="fixed-bottom">
	<form onsubmit="return send();" style="width: 100%;">
		<table style="width: 100%;">
			<tr>
				<td style="width: 80%;">
					<input type="text" id="msg" style="width: 100%;height: 40px;font-size: 2em;">
				</td>
				<td>
					<input type="submit" name="submit" style="width: 100%;height: 45px;font-size: 2em;font-family: 'Copperplate Gothic';" value="SEND">
				</td>
			</tr>
		</table>
	</form>
</footer>
<div style="position: fixed;right: 0;top: 45px;box-shadow: -2px 2px 4px #999;">
	<ul class="ops" onmouseleave="$(this).hide(200);">
		<li id="send-code">Send code</li>
		<li id="send-pictrue">Send pictrue</li>
		<li id="notice">Notice</li>
	</ul>
</div>
<div class="head">
	<span style="padding: 5px;font-size: 2em;margin: 0;font-weight: bold;display: inline-block;">Client - Online</span>
	<span class="upd" onclick="$('.ops').show(200);" id="onamae"><?php echo $name?></span>
</div>
<div class="send-code-dlg">
	<h1>Input your code here</h1>
	<textarea id="code-in" style="width: 550px;height: 130px;max-width: 550px;max-height: 130px;"></textarea>
	<div style="padding-left: 20px;position: relative;padding-right: 20px;padding-top: 10px;">
		<div style="text-align: left;float:left;margin: 5px;">
			<span class="big">language</span>
			<select id="code-lang"><option var="cpp">cpp</option><option var="1c">1c</option><option var="actionscript">actionscript</option><option var="apache">apache</option><option var="applescript">applescript</option><option var="asciidoc">asciidoc</option><option var="autohotkey">autohotkey</option><option var="avrasm">avrasm</option><option var="axapta">axapta</option><option var="bash">bash</option><option var="brainfuck">brainfuck</option><option var="clojure">clojure</option><option var="cmake">cmake</option><option var="coffeescript">coffeescript</option><option var="cs">cs</option><option var="css">css</option><option var="d">d</option><option var="delphi">delphi</option><option var="diff">diff</option><option var="django">django</option><option var="dos">dos</option><option var="erlang">erlang</option><option var="erlang-repl">erlang-repl</option><option var="fix">fix</option><option var="fsharp">fsharp</option><option var="glsl">glsl</option><option var="go">go</option><option var="haml">haml</option><option var="handlebars">handlebars</option><option var="haskell">haskell</option><option var="http">http</option><option var="ini">ini</option><option var="java">java</option><option var="javascript">javascript</option><option var="json">json</option><option var="lasso">lasso</option><option var="lisp">lisp</option><option var="livecodeserver">livecodeserver</option><option var="lua">lua</option><option var="makefile">makefile</option><option var="markdown">markdown</option><option var="mathematica">mathematica</option><option var="matlab">matlab</option><option var="mel">mel</option><option var="mizar">mizar</option><option var="nginx">nginx</option><option var="objectivec">objectivec</option><option var="ocaml">ocaml</option><option var="oxygene">oxygene</option><option var="parser3">parser3</option><option var="perl">perl</option><option var="php">php</option><option var="profile">profile</option><option var="python">python</option><option var="r">r</option><option var="rib">rib</option><option var="rsl">rsl</option><option var="ruby">ruby</option><option var="ruleslanguage">ruleslanguage</option><option var="rust">rust</option><option var="scala">scala</option><option var="scilab">scilab</option><option var="scss">scss</option><option var="smalltalk">smalltalk</option><option var="sql">sql</option><option var="tex">tex</option><option var="vala">vala</option><option var="vbnet">vbnet</option><option var="vbscript">vbscript</option><option var="vhdl">vhdl</option><option var="xml">xml</option></select>
			
		</div>
		<div style="float:right;text-align: right;"><button onclick="code_submit()" class="but big">Submit</button><button onclick="$('.send-code-dlg').fadeOut(500);" class="but big">Cannel</button></div>
	</div>
</div>
<div class="notice">
	<h1>Notice</h1>
	<div style="text-align: left;padding: 10px;">
		<h2 style="margin: 0;">6.19 update</h2>
		<p>新增发送代码以及两项简单的markdown（超链接和图片）</p>
	</div>
	<div style="position: absolute;top: 5px;right: 5px;">
		<a href="javascript:;" onclick="$('.notice').fadeOut(500)">Close</a>
	</div>
</div>
</body>
</html>