jQuery
==============================

## 概要

JavaScriptを便利に扱うためのライブラリ


## 公式サイト

* <a href="https://jquery.com/" target="_blank">https://jquery.com/</a>


## 必要となる知識

* HTML
* CSS


## ツール

* ブラウザ
* テキストエディタ


## HTMLひな形

```
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>jQueryの練習</title>
  <link rel="stylesheet" href="">
</head>
<body>

  <h1>jQuery</h1>
  <p>jQueryの練習</p>

  <ul id="main">
    <li>0</li>
    <li class="item">1</li>
    <li class="item">2</li>
    <li>3
      <ul id="sub">
        <li>3-0</li>
        <li>3-1</li>
        <li class="item">3-2</li>
        <li class="item">3-3</li>
        <li>3-4</li>
      </ul>
    </li>
  </ul>

  <p><a href="http://google.com">Google</a></p>

</body>
</html>
```

<br>


# jQuery使い方

## ダウンロード

* <a href="https://jquery.com/download/" target="_blank">https://jquery.com/download/</a>


## jQuery本体をHTMLで読み込む

bodyの閉じタグ直前で読む

```
<script src="js/jquery-3.2.1.min.js"></script>
```


## 書き方

必ず本体を読み込んだ後に記述する

### jQueryを書く場所

```
<script src="js/jquery-3.2.1.min.js"></script>
<script>
  $(document).ready(function() {
    // ここに処理を書く
  });
</script>
```

### 上記の省略形

```
<script src="js/jquery-3.2.1.min.js"></script>
<script>
  $(function() {
    // ここに処理を書く
  });
</script>
```

● document(<html> ~ </html>)を読み込んだら次の処理を実行しなさい、という意味



## 用語

```
$('p').css('color', 'red').hide('slow');
```

### セレクタ: 初折対象となるDOM要素を指定するもの

```
$('p')
```

### メソッド: 処理のこと

```
css('color', 'red')
hide('slow')
```

### メソッドチェーン: 処理を『.』でつなげて書く記法

```
.css('color', 'red').hide('slow')
```


## セレクタの指定方法

### p h1 ul など: 要素

```
$('p').css('color', 'red')
```

### # : id

```
$('#main').css('color', 'red');
```

### . : class

```
$('.item').css('color', 'red');
```

### △ : それ以下の要素

```
$('#main .item').css('color', 'red');
```

### > : 直下の子要素

```
$('#main > .item').css('color', 'red');
```

### , : 複数の要素

```
$('p, .item').css('color', 'red');
```

### + : 隣接する要素

```
$('.item + .item').css('color', 'red');
```


## フィルタ

### :eq() : 一致する要素

```
$('#sub > li:eq(2)').css('color', 'red');
```

### :gt() : ()より大きい要素

```
$('#sub > li:gt(1)').css('color', 'red');
```

### :lt() : ()より小さい要素

```
$('#sub > li:lt(1)').css('color', 'red');
```

### :odd : 奇数要素

```
$('#sub > li:odd').css('color', 'red');
```

### :even : 偶数要素

```
$('#sub > li:even').css('color', 'red');
```

### :contains() : ()を含む要素

```
$('#sub > li:contains("4")').css('color', 'red');
```

### :first : 最初の要素

```
$('#sub > li:first').css('color', 'red');
```

### :last  : 最後の要素

```
$('#sub > li:last').css('color', 'red');
```


## メソッドでDOM要素の指定

### parent() : 親要素

```
$('#sub').parent().css('color', 'red');
```

### children() : 子要素

```
$('#sub').children().css('color', 'red');
```

### next() : 次の要素

```
$('#sub > li:eq(2)').next().css('color', 'red');
```

### prev() : 前の要素

```
$('#sub > li:eq(2)').prev().css('color', 'red');
```

### siblings() : 兄弟(同列)要素

```
$('#sub > li:eq(2)').siblings().css('color', 'red');
```


## 属性セレクタ

### = : 等しい

```
$('a[href="http://google.com"]').css('background', 'red');
```

### != : 等しくない

```
$('a[href!="http://google.com"]').css('background', 'red');
```

### *= : 含まれる

```
$('a[href*="jquery"]').css('background', 'red');
```

### ^= : 〜で始まる

```
$('a[href^="http"]').css('background', 'red');
```

### $= : 〜で終わる

```
$('a[href$="jp"]').css('background', 'red');
```


## メソッド

### 値の設定

```
$('p').css('color', 'red');
```

### 値の取得

```
console.log($('p').css('color'));
```

### addClass

```
$('.item').addClass('test');
```

### removeClass

```
$('#test').removeClass('test');
```

### HTMLの属性を扱う

```
console.log($('a').attr('href'));
$('a').attr('href', 'http://google.co.jp');
```

### data属性

```
<a href="http://jquery.com" data-sitename="jQuery">jQuery</a>
console.log($('a').data('sitename'));
```

## タグの中身を操作

### text

```
$('p').text('just changed');
console.log($('p').text());
```

### html

```
$('p').html('<a href="">click me!</a>');
console.log($('#test').html());
```

### val

```
$('input').val('Hello, again');
console.log($('input').val());
```

### remove 要素自体を無くす

```
$('h1').remove();
```

### empty 中身を空にする

```
$('h1').empty();
```


## 要素を追加

### before

```
var li1 = $('<li>').text('jst added1');
$('#main > li:eq(1)').before(li1);
```

### insertBefore

```
var li2 = $('<li>').text('jst added2');
li2.insertBefore($('#sub > li:eq(3)'));
```

### after

```
var li3 = $('<li>').text('jst added3');
$('#main > li:eq(1)').after(li3);
```

### insertAfter

```
var li4 = $('<li>').text('jst added4');
li4.insertAfter($('#sub > li:eq(3)'));
```

### prepend

```
var li = $('<li>').text('jst added');
$('ul').prepend(li);
```

### prependTo

```
var li = $('<li>').text('jst added');
li.prependTo($('ul'));
```

### append

```
var li = $('<li>').text('jst added');
$('ul').append(li);
```

### appendTo

```
var li = $('<li>').text('jst added');
li.appendTo($('ul'));
```


## エフェクト

### hide

```
$('.box01').hide('fast');
$('.box02').hide('slow');
$('.box03').hide(3000);
```

### show

```
$('.box01').show(2500);
```

### fadeOut

```
$('.box01').fadeOut(2500);
```

### fadeIn

```
$('.box01').fadeIn(2500);
```

### toggle

```
$('.box04').toggle(5000);
```

### コールバック

```
$('.box05').fadeOut(10000, function() {
  alert('gone!');
});
```


## イベント

### click

```
$('.box').click(function() {
  alert("Hi!");
});
```

### mouseover, mouseout, mousemove

```
$('.box')
  .mouseover(function() {
    $(this).css('opacity', '0.3');
  })
  .mouseout(function() {
    $(this).css('opacity', '1');
  })
  .mousemove(function(e) {
    $(this).text(e.pageX);
  });
```

### focus, blur

```
$('#name')
  .focus(function() {
    $(this).css('background', 'red');
  })
  .blur(function() {
    $(this).css('background', 'white');
  });
```

### change

```
$('#members').change(function() {
  alert('changed');
});
```


## onメソッド

### 動的に作られた要素に対してイベントを割り当てる

動的に作られる要素にイベントを予め設定しておいても、
ドキュメントが読み込まれたときには存在しないので動作しない。
そのような要素に対してイベントを設定するには「on」を使う。

```
$('.button').click(function() {
  var p = $('<p>').text('added').addClass('added');
  $(this).before(p);
});

// 親要素を指定する
$('body').on('click', '.added', function() {
  $(this).remove();
});
```

<br>


# Note

## DOM要素のラッパーセットのフィルタリング .filter()

```
(function($){
  alert($('p').filter('.middle').length);
})(jQuery);
```


## 現在選択されているラッパーセットで子要素を検索する .find()

```
(function($){
  alert($('p').find('.middle').length);
})(jQuery);
```


## 要素セットを破壊的な変更の前に戻す .end()

```
(function($){
  alert($('p').filter('.middle').end().length);
})(jQuery);
```


## 現在の選択セットに前の選択セットを追加 .andSelf()

```
(function($){
  $('div').find('p').andSelf().css('color','red');
})(jQuery);
```


## 現在のコンテキストに基づいてDOMをトラバースし、新しい要素セットを取得する

```
(function($){
  $('li:eq(0)').next();
  $('li:eq(1)').parent().children(':last');
})(jQuery);
```

* .next()
* .prev()
* .parent()
* .children()
* .nextAll()
* .prevAll()


## DOM要素の作成、操作、挿入

```
(function($){
  $('<p><a>jQuery</a></p>').find('a').attr('href','http://www.jquery.com').end().appendTo('body');
})(jQuery);
```

* .append()
* .prepend()
* .prependTo()
* .after()
* .before()
* .insertAfter()
* .insertBefore()
* .wrap()
* .wrapAll()
* .wrapInner()


## DOM要素の削除 .remove()

```
(function($){
  $('a').remove();
  $('a').remove('.remove');
})(jQuery);
```


## DOM要素の置き換え

```
(function($){
  $('li.remove').replaceWith('<li>removed</li>');
  $('<li>removed</li>').replaceAll('li.remove');
})(jQuery);
```

* .replaceWith()
* .replaceAll()


## DOM要素の複製 .clone()

```
(function($){
  $('ul').clone().appendTo('body');
})(jQuery);
```


## DOM要素の属性の取得、設定、削除

```
(function($){
  alert(
    $('a').attr('href','http://www.jquery.com').attr('href')
  );
  alert(
    $('a').attr({'href':'http://www.jquery.com','title':'jquery.com'}).attr('href')
  );
})(jQuery);
```

* .addClass()
* .hasClass()
* .removeClass()
* .toggleClass()


## HTMLコンテンツの取得と設定

```
(function($){
  $('p').html('<strong>hello world</strong>');
  alert($('p').html());
})(jQuery);
```


## テキストコンテンツの取得と設定

```
(function($){
  $('p').text('hello world');
  alert($('p').text());
})(jQuery);
```


## 要素の選択

```
(function($){
  var anchors = $('a');
  anchors.children();
  $('.box > p');
  $('li.selected').nextAll('li');
})(jQuery);
```

* >
* +
* ~
* nextAll
* siblings
* next
* :first
* :last
* :even
* :odd
* :eq(n)
* :lt(n)
* :gt(n)


## アニメーション中の要素を選択

```
(function($){
  //アニメーション開始している要素
  $('div:animate');
  //アニメーション開始されていない要素でアニメーション開始
  $('div:not(div:animate)').animate({height:100});
  //アニメーション開始されているかチェック
  var myElem = $('#elem');
  if( myElem.is(':animated')){
    //何らかの処理
  }
})(jQuery);
```


## コンテンツに基づいて要素を選択する

```
(function($){
  $('span:contains("Bob")');

  $('div:has(p a)');
})(jQuery);
```


## マッチしないものに基づいて要素を選択する

```
(function($){
  $('div p:not(.inner');
  $('span:not(div p span)');
  $('#nav a').not('a.active');
  var $anchors = $('a');
  $anchors.click(function() {
    $anchors.not(this).addClass('not-clicked');
  });
})(jQuery);
```


## 属性に基づいて要素を選択する

```
(function($){
  $('a[href="http://google.com"]');
})(jQuery);
```


## 表示切り替え

```
<script>
(function($){
  $('#animate').click(function() {
    $('.box').show();
  });
})(jQuery);
</script>

<script>
(function($){
  $('#animate').click(function() {
    $('.box').toggle();
  });
})(jQuery);
</script>
```


## スライド

```
(function($){
  $('#animate').click(function() {
    $('.box').slideToggle('slow');
  });
})(jQuery);
```


## フェードイン、フェードアウト

```
<script>
(function($){
  $('#animate').click(function() {
    var $box = $('.box');
    if ($box.is(':visible')) {
      $box.fadeOut('slow');
    } else {
      $box.fadeIn('slow');
    }
  });
})(jQuery);
</script>

<script>
(function($){
  $('#animate').click(function() {
    $('.box').fadeTo('slow', 'toggle');
  });
})(jQuery);
</script>

<script>
(function($){
  $('#animate').click(function() {
    $('.box').animate({opacity:'toggle'}, 'slow');
  });
})(jQuery);
</script>
```


## スライドとフェード

```
(function($){
  $('#animate').click(function() {
    $('.box').animate({
      opacity: 'toggle',
      height: 'toggle'
    }, 'slow');
  });
})(jQuery);
```

* slideUp()
* slideDown()
* slideToggle()
* fadeIn()
* fadeOut()
* fadeTo()

<br>


# Modules

## 投稿ページタイトルを指定した場所で改行したい

```
(function ($) {
  $(function () {
    var ptn = / /g,
    replace = '<br>',
    title = $(".entry-title").text().replace(ptn, replace);
    $(".entry-title").html(title);
  });
})(jQuery);
```



Ajax
==============================

## 概要

* サーバと通信してページを書き換える仕組み
* ページ内から通信を行って、その結果を使ってページの一部を書き換える

** セキュリティに注意



## 準備

### サーバ

* IPアドレス

### サーバに置いたファイルを表示

#### PHPの場合

```
// phpのコマンド
php -S 192.168.xx.xx:8000

// ブラウザでアクセス
http://192.168.xx.xx:8000
```



## loadメソッド

* 非同期
* サーバの情報を読み込むメソッド

### サーバに置いてあるファイルから、別のファイルにアクセスする

``` javascript
<body>
  <button>more</button>
  <div id="result"></div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script>
    $(function() {
      $('button').click(function(){
        $('#result').load('more.html');
      });
    });
  </script>
</body>
```



## 非同期通信

* 処理が終わる前に次の処理に移るので、結果が返ってきてから処理したい場合は注意が必要

``` javascript
<body>
  <button>more</button>
  <div id="result"></div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script>
    $(function() {
      $('button').click(function(){
        $('#result').load('more.html', function() {
          $('#message').css('color', 'red');
        });
      });
    });
  </script>
</body>
```



## $.getで渡して、JSONで返す

``` javascript
@index.html

<div>
  <input type="text" id="name" name="name">
  <input type="button" id="greet" value="Greet">
</div>
<div id="result"></div>

<script src="js/jquery-3.2.1.min.js"></script>
<script>
  $(function() {
    $('#greet').click(function(){
      $.get('greet.php', {
        name: $('#name').val()
      }, function(data) {
        $('#result').html(data.message + '(' + data.length + ')');
      });
    });
  });
</script>
```

``` javascript
@greet.php

<?php
// echo htmlspecialchars("Hello, " . $_GET['name'], ENT_QUOTES, "utf-8");

$data = array(
  "message" => htmlspecialchars("Hello, " . $_GET['name'], ENT_QUOTES, "utf-8"),
  "length" => strlen($_GET['name'])
);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
```


## $.ajax (v1.4までの書き方)

``` javascript
$.ajax({
  url: url,
  type: 'POST',
  async: true,
  data: {
    example: 'sample'
  },
  success: function (data) {
    // 成功時の処理
  },
  error: function () {
    // 失敗時の処理
  }
});

```


## $.ajax (v1.5からの書き方)

``` javascript
$.ajax({
  type: 'POST',
  url: 'example.php',
  data: {
    example: 'sample'
  }
}).done(function () {
  // 成功時の処理
}).fail(function () {
  // 失敗時の処理
});

```
