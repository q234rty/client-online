var client1 = deepstream('localhost:6020').login();
var record1 = client1.record.getRecord('MAIN');
var name = null;
var _init = 0;
var _msg = function () {
	var ta = $('#ta');
	var str = ta.val();
	ta.val('/msg '+$(this).html()+' '+str);
	ta.focus();
};
var setClasses = function (arg) {
	$(arg).attr('class', 'r'+($(arg).index()&1));
};
var setClass = function () {
	setClasses(this);
};
var addMassage = function (msg) {
	var ma = $('.main');
	var newp = $('<div/>').html(msg);
	ma.append(newp);
	setClasses(newp);
	var div = newp[0];
	$('.main').scrollTop($('.main')[0].scrollHeight);
};
var _addMassage = function (msg) {
	record1.set('msg', msg);
}
var findPlayer = function (name) {
	var arr = $('.list').children('p');
	for(var i = 0; i < arr.length; i++){
		if(arr.eq(i).html() == name)
			return arr.eq(i);
	}
	return null;
};
var hasPlayer = function (name) {
	return findPlayer(name) != null;
};
var addPlayer = function (name) {
	var newp = $('<p/>').html(name).click(_msg);
	newp.css('display', 'none');
	$('.list').append(newp);
	setClasses(newp);
	newp.show('slow');
	addMassage('* '+name+' joined the game.');
};
var removePlayer = function (name) {
	var k = findPlayer(name);
	addMassage('* '+name+' left the game.');
	k.hide('slow', function () {
		$(this).remove();
		$('.list').children('p').each(setClass);
	});
};
var _removePlayer = function (name) {
	var str = '';
	$('.list p').each(function () {
		var thisname = $(this).html();
		if(thisname == name) return;
		str += ' '+thisname;
	})
	record1.set('player', str.substr(1));
}
var msgToPlayer = function (player, msg) {
	_addMassage(name+" -&gt; "+player+": "+msg);
}
var send = function (msg) {
	if(typeof msg == 'object'){
		var ra = $("#ta");
		msg = ra.val();
		if(msg == null || msg == '' || msg == 'null')
			return;
		ra.val('');
	}
	if(msg == null || msg == '' || msg == 'null')
		return;
	if(msg[0] == '/'){
		if(/^\/msg\s?/.test(msg)){
			if(!/^\/msg \S{1,10} .+$/.test(msg)){
				addMassage('Input /help for help.');
				return;
			}
			var a = msg.match(/\S{1,10}/g);
			if(!hasPlayer(a[1])) addMassage('No such player!');
			else msgToPlayer(a[1], msg.substr(5+a[1].length));
		}
		else addMassage('Unknow command...');
	}
	else _addMassage('&lt;'+name+'&gt;'+msg);
};
record1.subscribe('msg', function(value) {
	if(/^\S{1,10} -&gt; \S{1,10}: /.test(value)){
		var ss = value.match(/\S{1,10}/g);
		if(name == ss[2].substr(0, ss[2].length-1) || name == ss[0])
			addMassage(value);
	}
	else addMassage(value);
});
record1.subscribe('player', function(value) {
	var players = $('.list p');
	var vis = new Array();
	var dity = value.match(/\S{1,10}/g);
	if(dity != null){
		for(var i = 0; i < dity.length; i++)
			vis[i] = false;
		players.each(function () {
			var tn = $(this).html();
			for(var i = 0; i < dity.length; i++)
				if(tn == dity[i]){
					vis[i] = true;
					return;
				}
			removePlayer(tn);
		});
		for(var i = dity.length-1; i >= 0; i--)
			if(!vis[i]) addPlayer(dity[i]);
	}
	if(name == '' || name == 'null')
		setTimeout('ooll()', 1000);
});
var ooll = function () {
	var n = 1;
	name = prompt('Input your name:');
	while(n == 1){
		if(name == '' || name == 'null')
			name = prompt('INPUT YOUR NAME!!!!');
		else if(!/^\S{1,10}$/.test(name))
			name = prompt('It\'s not a name of a player!');
		else if(hasPlayer(name))
			name = prompt('Already has that player!');
		else n = 0;
	}
	var str = name;
	$('.list p').each(function () {
		str += ' '+$(this).html();
	});
	record1.set('player', str);
};
var hide_ok = function () {
	$('.ok').hide('slow');
};
var show_ok = function () {
	$('.ok').show('slow', function () {
		setTimeout('hide_ok()', 2000);
	});
}
var html2Escape = function(sHtml) { 
	return sHtml.replace(/[<>&"]/g,
		function(c){
			return {'<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'}[c];
		});
}
var getCode = function () {
	var lang = $('#code-lang').val();
	if(lang == ''){
		var cc = html2Escape($('#code-input').val());
		return '<div align="center"><pre><code class="hljs">'+cc+'</code>'
		+'<a href="javascript:;" class="cpy" data-clipboard-text="'+cc+'">Copy</a></pre></div>';
	}
	var code = hljs.highlight(lang, $('#code-input').val()).value;
	if(code == '') return '';
	var cpycode = html2Escape($('#code-input').val());
	return '<div align="center"><pre><code class="hljs '+lang+'">'+code+'</code>'
		+'<a href="javascript:;" class="cpy" data-clipboard-text="'+cpycode+'">Copy</a></pre></div>';
};
$(document).ready(function () {
	$("#submit").click(send);
	$('#img').click(function () {
		if(!$('#work-code').is(':hidden'))
			$('#work-code').hide('slow');
		$('#work-img').toggle('slow');
	});
	$('#code').click(function () {
		if(!$('#work-img').is(':hidden'))
			$('#work-img').hide('slow');
		$('#work-code').toggle('slow');
	});
	$('#img-work-1').click(function () {
		$('#img-ans').val('<img src="'+$('#img-input-1').val()+'">');
	});
	$('#img-work-2').click(function () {
		if(!window.FileReader){alert('请不要使用过时的浏览器！');return;}
		$('#img-ans')[0].value = '';
		var file = $('#img-input-2')[0].files[0];
		if(!/image\/\w+/.test(file.type)){
			alert("请确保文件为图像类型");
			return false; 
		}
		r = new FileReader();
		r.onload = function(){
			$('#img-ans').val('<img src="'+r.result+'">');
			$('.waiting').hide('slow');
		};
		$('.waiting').show('slow', function () {
			r.readAsDataURL(file);
		});
	});
	$('#imgcopy').click(function () {
		var Url2 = document.getElementById("img-ans");
		var val = Url2.value;
		Url2.select();
		document.execCommand("Copy");
		show_ok();
		Url2.value = '';
	})
	$('#add_before').click(function () {
		$('.waiting').show('slow', function () {
			send('<br>'+$('#img-ans').val());
			$('.waiting').hide('slow');
		});
	});
	$('#code-submit').click(function () {
		var code = getCode();
		if(code == '') return alert('Enter code!');
		send(code);
	});
	$('#code-msg').click(function () {
		var player = $('#code-player').val();
		if(player == '') return alert('Enter the player name!');
		var code = getCode();
		if(code == '') return alert('Enter code!');
		msgToPlayer(player, getCode());
	})
	document.getElementById('ta').onkeydown = function () {
		if(event.which == 13){
			send($('#ta').val());
			$('#ta').val('');
		}
	};
	var n = new Clipboard('.cpy');
	n.on('success', function () {
		show_ok();
	});
});
