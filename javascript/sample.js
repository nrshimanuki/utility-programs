// Sample

var loginid = $('#loginid').val();
var loginkey = $('#loginkey').val();
var manageId = '';
var url = "http://xxx.xxx.xxx/api/login";
var method = "POST";
$.ajax({
	url: url,
	type: method,
	beforeSend: function(xhr, setting) {
		xhr.setRequestHeader('X-CSRF-Token', 'xxxxxxx');
	},
	data:{
		"loginid": loginid,
		"loginkey": loginkey,
		"name": "testname",
	},
	headers: {
		"version": "x.x.xw",
		"apiversion": "x.x.x",
		"token": "xxx-xxxx",
	}
}).then(
	function (data) {
		if (data.authkey === undefined) {
			showModalAlert('ログインエラー', 'ログインIDまたはログインキーが間違っています。');
		}
		else {
			// ブラウザ終了でcookie破棄のため有効期限を設定しない
			console.log(data.authkey);
			setCookie('authkey', data.authkey, '');
			setCookie('loginkeep', 'true', 30);
			location.href = "sample.html";
		}
	},
	function () {
		showModalAlert('通信エラー', '通信に失敗しました。');
	}
);

// ログイン状態保持のチェック判定
if (!getCookie('loginkeep') || getCookie('loginkeep') != '') {
	$('#check').attr('checked', 'checked');
}

// ログアウト
$(document).on('click', '#logout', function () {
	var usAuth = getCookie('authkey');
	var gotAuthkey = usAuth;
	var url = "http://xxx.xxx.xx.xx:3000/api/logout";
	var method = "GET";

	$.ajax({
		url: url,
		headers: {
			"version": "x.x.xw",
			"apiversion": "x.x.x",
			"token": "xxx-xxxx",
			"us-auth": gotAuthkey,
		}
	}).then(
		function () {
			removeCookie('authkey');
			location.href = 'login.html';
		},
		function () {
			showModalAlert('通信エラー', '正常にログアウト出来ませんでした。');
		}
	);
});





/**
 * cookie書き込み
 *
 * @param {String} key
 * @param {String} val
 * @param {int} expires integer | null
 */
function setCookie(key, val, expires) {
	var cookie_str = key + '=' + val + ';';

	if (expires != null) {
		var expires_day = new Date();
		expires_day.setTime(expires_day.getTime() + expires * 24 * 60 * 60 * 1000);
		cookie_str += 'expires=' + expires_day + ';';
	}

	document.cookie = cookie_str;
}

/**
 * cookie取得
 *
 * @param {String} key
 * @returns {String} cookei value
 */
function getCookie(key) {
	var cookies = document.cookie.split("; ");
	var cookie_assoc = [];

	$(cookies).each(function () {
		var cookie = this.split("=");
		var cookie_val = cookie.pop();
		var cookie_key = cookie.pop();
		cookie_assoc[cookie_key] = cookie_val;
	});

	return cookie_assoc[key];
}

/**
 * cookie削除
 *
 * @param {String} key
 */
function removeCookie(key) {
	setCookie(key, '', '');
}




// apiGetData
function apiGetData() {
	var usAuth = getCookie('authkey');
	var url = "http://xxx.xxx.xx.xx:3000/api/param";
	var method = "GET";
	var defer = $.Deferred();
	$.ajax({
		url: url,
		type: method,
		headers: {
			"version": "x.x.xw",
			"apiversion": "x.x.x",
			"token": "xxx-xxxx",
			"auth": usAuth,
		},
		success: defer.resolve,
		error: defer.reject
	});
	return defer.promise();
}

// grep
function grepData(shelfId, data) {
	var books = $.grep(data.shelves, function (data, index) {
		return data.id == shelfId;
	});
	return books;
}




// UnixTimeを日付に変換
function unixTimeChangeDate(intTime, noDateTime) {
	var d = new Date(intTime * 1000);
	var year = d.getFullYear();
	var month = d.getMonth() + 1;
	var day = d.getDate();
	var hour = ('0' + d.getHours()).slice(-2);
	var min = ('0' + d.getMinutes()).slice(-2);
	if (noDateTime) {
		return (year + '.' + month + '.' + day);
	}
	else {
		return (year + '.' + month + '.' + day + ' ' + hour + ':' + min);
	}
}




// jQueryでAppend
parseData = JSON.parse(data);
parseData.forEach(function(val){
	$('#product').append('<option value="' + val.standard_code + '">' + val.product_name + '</option>');
});




// 特定のデータ属性を取得
$(e.currentTarget).children().each(function(i, elem) {
	if ($(elem).attr('data-field') === 'sequence') {
		sequence = $(elem).attr('data-value');
	}
});




// form お決まり
/*
 * フォームクリア
 */
function clearForm() {
	$('#toolName').val('');
	$('#work_start_date').val('');
	$('#work_end_date').val('');
}

/*
* フォーム操作不可
*/
function disabledForm() {
	$('#btn_delete').hide();
	$('#btn_submit').hide();
	$('#btn_cancel').hide();
	$('#product_name').attr('disabled', 'disabled');
	$('#work_start_date').attr('readonly', true);
	$('#work_end_date').attr('readonly', true);
}

/*
* フォームをアクティブにする
*/
function activeForm() {
	$('#btn_delete').show();
	$('#btn_submit').show();
	$('#btn_cancel').show();
	$('#product_name').attr('disabled', false);
	$('#work_start_date').attr('readonly', false);
	$('#work_end_date').attr('readonly', false);
}




// 動的に作成された要素に対するイベント
$(document).on('click', '.drawer-menu-item', function () {
	field_code = $(this).attr('data-code');
	lookup_polygon(field_code);
	setFieldData(company_id, field_code);
	$('.drawer').drawer('close');
});




// string_to_buffer
function string_to_buffer(src) {
	return (new Uint16Array([].map.call(src, function(c) {
		return c.charCodeAt(0)
	}))).buffer;
}
var myfunc = function () {
	var auth = "";
	console.log("auth : " +  auth );
	// var param = "file=xxxx.pdf";
	var param = "file.mp4";
	var xhr = new XMLHttpRequest();
	xhr.open('GET', "/api/download?" + param);
	console.log("URL : " +  "/api/download?" + param );

	// xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
	xhr.setRequestHeader( 'us-auth', auth );
	xhr.responseType = 'arraybuffer';
	xhr.onload = function(e) {
		var filename = "filename";
		var arrayBuffer = this.response;
		var blob = new Blob([arrayBuffer], {type: "video/mp4"});
		console.log(blob);
		if (window.navigator.msSaveBlob) {
			// IEとEdge
			window.navigator.msSaveBlob(blob, filename);
		} else {
			// それ以外のブラウザ
			// Blobオブジェクトを指すURLオブジェクトを作る
			var objectURL = window.URL.createObjectURL(blob);
			// リンク（<a>要素）を生成し、JavaScriptからクリックする
			var link = document.createElement("a");
			document.body.appendChild(link);
			link.href = objectURL;
			link.download = filename;
			// link.click();
			console.log(link);
			document.body.removeChild(link);
		}
		console.log("----------------------------------");
	};
	xhr.send();
}
