var calc = function (str) {
	str = str.replace(/!\[.*\]\(.+\)/g, function (a) {
		var link = a.match(/\(.+\)$/)[0];
		link = link.substr(1, link.length-2);
		var alt = a.substr(2, a.indexOf(']')-2);
		alt = alt === '' ? '' : (' alt="'+alt+'"');
		return '<img src="'+link+'"'+alt+'>';
	})
	str = str.replace(/\[.+\]\(.+\)/g, function (a) {
		var link = a.match(/\(.+\)$/)[0];
		link = link.substr(1, link.length-2);
		var alt = a.substr(1, a.indexOf(']')-1);
		return '<a href="'+link+'" target="view_window">'+alt+'</a>';
	})
	str = str.replace(/@\w+&nbsp;/g, function (a) {
		var name = a.substr(1, a.length-7);
		return '<a href="javascript:;" onclick="at(this)" class="at">'+name+'</a>&nbsp;';
	})
	return str;
}
var send = function (str) {
	var names = $('#onamae').html();
	var msgs = typeof str === 'string' ? str : calc($('#msg').val().replace(/[<>"& ]/g, function (c) {
		return {'<':'&lt;','>':'&gt;','"':'&quot;','&':'&amp;',' ':'&nbsp;'}[c];
	}));
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
	var width = window.innerWidth,
		height = window.innerHeight,
		blockWidth = 50,
		blockHeight = 50,
		w = width/blockWidth+1,
		h = height/blockHeight+1,
		randint = function (a, b) {
			return Math.floor(Math.random()*(b-a))+a;
		},
		rand = function (x1, y1, x2, y2, x3, y3) {
			// return 'rgb('
			// 	+ randint(x1, y1) + ', '
			// 	+ randint(x2, y2) + ', '
			// 	+ randint(x3, y3) + ')'
			// return 'rgb(220, 230, 231)';
			return "#c4c4c4";
		}
	for(var i = 0; i < w; i++)
		for(var j = 0; j < h; j++){
			var div = $('<div/>');
			div.addClass('block');
			div.css('width', blockWidth+'px');
			div.css('height', blockHeight+'px');
			div.css('top', j*blockHeight+'px');
			div.css('left', i*blockWidth+'px');
			// div.css('background-color', rand(223, 213, 226, 243, 226, 241));
			div.css('background', "linear-gradient(to left top,"+rand(223, 255, 226, 255, 226, 255)+" , white)");
			div.css('opacity', 1-(1.0*i/w+1.0*j/h)/2);
			$('body').append(div);
		}
})
