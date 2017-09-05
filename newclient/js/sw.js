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
					return '<a href="/profile/?user=' + name + '" class="at lv' + lv + '">' + name + '</a> ';
				});
				var zyy = $('<a href="/profile/?user=' + nm + '" ></a>').addClass('at').html(nm);
				zyy.addClass('lv' + getlevel(nm));
				newdiv.append($('<img/>').attr('src', 'https://cn.gravatar.com/avatar/' + getemail(nm) + '?d=mm').addClass('tx'));
				newdiv.append($('<div/>').addClass('fq').append($('<div/>').append(zyy).append($('<span/>').html(time).addClass('tm')).append($('<span/>').html('回复').attr('onclick', 'reply("' + nm + '")').addClass('reply')).addClass('txt')).append($('<div/>').addClass('init').html(ctc)))
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
		$('#msg').insertAtCaret('![rotate](/img/huaji.png)');
	})
	$('#sendimg').click(function() {
		$('#msg').insertAtCaret('![]()', 1);
	})
	var openmenu = function() {
		$_('a').className = $_('a').className.replace(/2/g, '1');
		$('#menu').fadeIn(300);
	}
	var closemenu = function() {
		$_('a').className = $_('a').className.replace(/1/g, '2');
		$('#menu').fadeOut(300);
	}
	$_('a').onclick = openmenu;
	$_('menu').onmouseleave = closemenu;
	$_('sb').onclick = function(str) {
		var msgs = typeof str === 'string' ? str : calc($('#msg').val());
		$.post("/send.php", {msg: msgs}, function (a) {eval(a);});
		return false;
	}
	$_('show-notice').onclick = function() {
		$('.notice').fadeIn(500);
		closemenu();
	}
})
var reply = function(a) {
	var last = $('#msg').val();
	$('#msg').val(last + '@' + a + ' ');
	$('#msg').focus();
}
