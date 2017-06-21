var calc = function (str) {
	str = marked(str).replace(/>\s+</g, '><').replace(/\n/g, '<br>').replace(/@\w+ /g, function (a) {
		var name = a.substr(1, a.length-2);
		return '<a href="javascript:;" onclick="at(this)" class="at">'+name+'</a>&nbsp;';
	}).replace(/(<br>)+$/g, '').replace(/<script.*>.*<\/script>/g, '');
	return str;
}
var send = function (str) {
	var names = $('#onamae').html();
	var msgs = typeof str === 'string' ? str : calc($('#msg').val());
	$('#msg').val('');
	$.post("/send.php", {
		name: names, msg: msgs
	})
	return false;
}
var at = function (a) {
	var last = $('#msg').val();
	$('#msg').val('@'+$(a).html()+' '+last);
}
var code_submit = function () {
	var code = $('#code-in').val();
	if(code === '') return alert('Enter your code!');
	$('.send-code-dlg').fadeOut(200);
	send('<pre><code>'+code.replace(/[<>"&\n]/g, function (c) {
		return {'<':'&lt;','>':'&gt;','"':'&quot;','&':'&amp;','\n':'<br>'}[c];
	})+'</code></pre>');
}
var len = 1;
$(document).ready(function () {
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
				var ctc = szb.substr(szb.indexOf('|')+1);
				newdiv.append($('<div/>').addClass('init').html(ctc));
				$('#fuck_zyy').append(newdiv);
				document.body.scrollTop = document.body.scrollHeight;
			}
		})
	}, 1000);
	$('#send-code').click(function () {
		$('.send-code-dlg').fadeIn(500)
	})
	$('#send-pictrue').click(function () {
		alert('现在你可以用![alt](link)发送网络上的图片，本地图片还在开发中。。')
	})
	$('#notice').click(function () {
		$('.notice').fadeIn(500)
	})
})
