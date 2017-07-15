$(document).ready(function() {
	var levels = new Array();
	var getlevel = function(name) {
		if (!levels[name])
			$.ajax({
				type: "post",
				url: "/getlevel.php",
				data: "user=" + name,
				async: false,
				success: function(ans) {
					levels[name] = parseInt(ans) + 1;
				}
			});
		return levels[name] - 1;
	}
	var emails = new Array();
	var getemail = function(name) {
		if (!emails[name])
			$.ajax({
				type: "post",
				url: "/getemail.php",
				data: "user=" + name,
				async: false,
				success: function(ans) {
					emails[name] = ans;
				}
			});
		return emails[name];
	}
	var len = 1;
	var name = $('.name').html();
	var level = getlevel(name);
	var calc = function(str) {
		return marked(str, {
			sanitize: (level < 4)
		}).replace(/>\s+</g, '><').replace(/\n/g, '<br>').replace(/(<br>)+$/g, '');
	}
	var $_ = function(id) {
		return document.getElementById(id);
	}
	setInterval(function() {
		$.post("/gets.php", {}, function(ans) {
			if (typeof ans !== 'string')
				return alert('Something wrong...');
			var kkk = ans.split('\n');
			if (kkk == null)
				return;
			while (len < kkk.length) {
				var szb = kkk[len++];
				var newdiv = $('<div/>').addClass('s');
				var time = szb.match(/^\[\d+:\d+:\d+\]/)[0];
				var nm = szb.match(/\]\w+/)[0].substr(1);
				var ctc = szb.substr(szb.indexOf('|') + 1).replace(/<br>/g, "\n").replace(/@\w+ /g, function(dat) {
					var name = dat.substr(1, dat.length - 2);
					var lv = getlevel(name);
					return '<a href="javascript:;" onclick="at(this)" class="at lv' + lv + '">' + name + '</a> ';
				});
				var zyy = $('<a href="javascript:;" onclick="at(this)"></a>').addClass('at').html(nm);
				zyy.addClass('lv' + getlevel(nm));
				newdiv.append($('<img/>').attr('src', 'https://cn.gravatar.com/avatar/' + getemail(nm) + '?d=mm').addClass('tx'));
				newdiv.append($('<div/>').addClass('fq').append($('<div/>').append(zyy).append($('<span/>').html(time).addClass('tm')).addClass('txt')).append($('<div/>').addClass('init').html(ctc)))
				$('#fuck_zyy').append(newdiv);
				document.body.scrollTop = document.body.scrollHeight;
				Prism.highlightAll();
			}
		})
	}, 1000);
	if (localStorage.client_notice != new Date().getDate()) {
		$('.notice').fadeIn(500);
		localStorage.client_notice = new Date().getDate();
	}
	$('#sendcode').click(function() {
		var $msg = $('#msg');
		var kk = $msg.val();
		if (kk === '' || /.*\n$/.test(kk))
			$msg.val(kk + '```cpp\n```');
		else
			$msg.val(kk + '\n```cpp\n```');
		$msg.focus();
		var len = $msg.val().length;
		$msg[0].setSelectionRange(len - 7, len - 4);
	});
	$.fn.extend({
		insertAtCaret: function(myValue, flag=0) {
			var $t = $(this)[0];
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			} else if ($t.selectionStart || $t.selectionStart == '0') {
				var startPos = $t.selectionStart;
				var endPos = $t.selectionEnd;
				var scrollTop = $t.scrollTop;
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
				this.focus();
				$t.selectionStart = startPos + myValue.length - flag;
				$t.selectionEnd = startPos + myValue.length - flag;
				$t.scrollTop = scrollTop;
			} else {
				this.value += myValue;
				this.focus();
			}
		}
	})
	$('#huaji').click(function() {
		$('#msg').insertAtCaret('![滑稽](/img/huaji.png)');
	})
	$('#sendimg').click(function() {
		$('#msg').insertAtCaret('![]()', 1);
	})
	var openmenu = function() {
		$_('a').className = $_('a').className.replace(/2/g, '1');
		$('#menu').show(300);
	}
	var closemenu = function() {
		$_('a').className = $_('a').className.replace(/1/g, '2');
		$('#menu').hide(300);
	}
	$_('a').onclick = openmenu;
	$_('menu').onmouseleave = closemenu;
	$_('sb').onclick = function(str) {
		if (!level)
			return alert('抱歉，您的账户已被封禁！');
		var msgs = typeof str === 'string' ? str : calc($('#msg').val());
		$('#msg').val('');
		var kk = msgs.match(/<img/g);
		if (kk != null) {
			if (level == 1 && kk.length > 5)
				return alert('图片数量超过限制');
			if (level == 2 && kk.length > 10)
				return alert('图片数量超过限制');
			if (level == 3 && kk.length > 20)
				return alert('图片数量超过限制');
		}
		if (level == 1 && msgs.length > 5000)
			return alert('字数超过限制');
		if (level == 2 && msgs.length > 10000)
			return alert('字数超过限制');
		if (level == 3 && msgs.length > 50000)
			return alert('字数超过限制');
		$.post("/send.php", {
			name: name,
			msg: msgs
		})
		return false;
	}
	$_('show-notice').onclick = function() {
		$('.notice').fadeIn(500);
		closemenu();
	}
})
var at = function(a) {
	var last = $('#msg').val();
	$('#msg').val(last + '@' + $(a).html() + ' ');
	$('#msg').focus();
}
