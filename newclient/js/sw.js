var name, op;
var calc = function (str) {
	str = marked(str, {sanitize: op}).replace(/>\s+</g, '><').replace(/\n/g, '<br>').replace(/(<br>)+$/g, '').replace(/@\w+ /g, function (a) {
		var name = a.substr(1, a.length-2);
		return '<a href="javascript:;" onclick="at(this)" class="at">'+name+'</a>&nbsp;';
	})
	return str;
}
var len = 1;
$(document).ready(function () {
	name = $('.name').html();
	op = name != 'root';
	setInterval(function () {
		$.post("/gets.php", {}, function (ans) {
			if(typeof ans !== 'string')
				return alert('Something wrong...');
			var kkk = ans.split('\n');
			if(kkk == null) return;
			while(len < kkk.length){
				var szb = kkk[len++];
				var newdiv = $('<div/>').addClass('s');
				var time = szb.match(/^\[\d+:\d+:\d+\]/)[0];
				newdiv.append($('<span/>').html(time))
				var nm = szb.match(/\]\w+/)[0].substr(1);
				var zyy = $('<a href="javascript:;" onclick="at(this)"></a>').addClass('at').html(nm);
				newdiv.append(zyy);
				var ctc = szb.substr(szb.indexOf('|')+1).replace(/<br>/g, '\n');
				newdiv.append($('<div/>').addClass('init').html(ctc));
				$('#fuck_zyy').append(newdiv);
				document.body.scrollTop = document.body.scrollHeight;
				Prism.highlightAll();
			}
		})
	}, 1000);
	if(localStorage.client_notice != new Date().getDate()){
		$('.notice').fadeIn(500);
		localStorage.client_notice = new Date().getDate();
	}
	$('.name').click(function () {
		$('.notice').fadeIn(500);
	})
	$('#sendcode').click(function () {
		var $msg = $('#msg');
		var kk = $msg.val();
		if(kk === '' || /.*\n$/.test(kk)) $msg.val(kk+'```cpp\n```');
		else $msg.val(kk+'\n```cpp\n```');
		$msg.focus();
		var len = $msg.val().length;
		$msg[0].setSelectionRange(len-7, len-4); 
	});
	$.fn.extend({
		insertAtCaret: function(myValue, flag = 0){
			var $t = $(this)[0];
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			}
			else if ($t.selectionStart || $t.selectionStart == '0') {
				var startPos = $t.selectionStart;
				var endPos = $t.selectionEnd;
				var scrollTop = $t.scrollTop;
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
				this.focus();
				$t.selectionStart = startPos + myValue.length - flag;
				$t.selectionEnd = startPos + myValue.length - flag;
				$t.scrollTop = scrollTop;
			}
			else {
				this.value += myValue;
				this.focus();
			}
		}
	})
	$('#huaji').click(function () {
		$('#msg').insertAtCaret('![](/img/huaji.png)');
	})
	$('#sendimg').click(function () {
		$('#msg').insertAtCaret('![]()', 1);
	})
	document.execCommand("BackgroundImageCache", false, true);
})
var at = function (a) {
	var last = $('#msg').val();
	$('#msg').val(last+'@'+$(a).html()+' ');
	$('#msg').focus();
}
var send = function (str) {
	var names = $('.name').html();
	var msgs = typeof str === 'string' ? str : calc($('#msg').val());
	$('#msg').val('');
	var kk = msgs.match(/<img/g);
	if(kk !== null && kk.length > 20) return alert('图炮啊');
	if(msgs.length > 100000) return alert('嘴炮啊');
	$.post("/send.php", {
		name: names, msg: msgs
	})
	return false;
}