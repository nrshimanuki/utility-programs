PHP Basic
==============================

## クラス定義

### コンストラクタ

#### デフォルト

```php
class TestClass {
  function __construct() {
    print ('デフォルトのコンストラクタ');
  }
}
$obj = new TestClass(); // 'デフォルトのコンストラクタ'
```

#### クラス名と同じ名前の関数はコンストラクタ

```php
class TestClass {
  function TestClass() {
    print ('コンストラクタ');
  }
}
$obj = new TestClass(); // 'コンストラクタ'
```

### 関数の使い方

```php
class TestClass {
  function sayHi() {
    print('Hi!');
  }
}
$obj = new TestClass();
$obj->sayHi();  // 'Hi!'
```

### インスタンス変数

```php
class TestClass {
  var $val1 = 'インスタンス変数1';
  public $val2 = 'インスタンス変数2';
  private $val3 = '参照できない';
}

$obj = new TestClass();
print ($obj->val1); // 'インスタンス変数1'
print ($obj->val2); // 'インスタンス変数2'
print ($obj->val3); // エラー
```



## 継承

### 継承先で継承元の関数のオーバーライドが無い場合

```php
class TestClass {
  function sayHi() {
    print('Hi!');
  }
}
class TestExtends extends TestClass {
  // 無し
}
$obj = new TestExtends();
$obj->sayHi();  // 'Hi!'
```

### 継承先で継承元の関数のオーバーライドをした場合

```php
class TestClass {
  function sayHi() {
    print('Hi!');
  }
}
class TestExtends extends TestClass {
  // 継承元の関数をオーバーライド
  function sayHi() {
    print('Hi, Extends!');
  }
}
$obj = new TestExtends();
$obj->sayHi();  // 'Hi, Extends!'
```



## 抽象クラス

* 継承先で必ず実装してほしいものがある場合に用意しておくクラス
* 下記の場合、AbstractTestは、abstractメソッドが無いとエラーになる

```php
abstract class AbstractClass {
  abstract function sayHi();
}
class AbstractTest extends AbstractClass {

}
$obj = new AbstractTest();  // エラー
```

下記のように修正する

```php
abstract class AbstractClass {
  abstract function sayHi();
}
class AbstractTest extends AbstractClass {
  function sayHi() {
    print('Hi, Abstract!');
  }
}
$obj = new AbstractTest();
$obj->sayHi();  // 'Hi, Abstract!'
```



## 関数にオブジェクトを渡す

### 参照渡し

* 元の値が書き換わる
* PHPでは「&」を付けると参照渡しになるが、オブジェクトのときは付けなくても参照渡しになる

```php
class Test {
  public $val = 1;
}
function objTest($obj) {
  $obj->val = 99;
}
$obj = new Test();
objTest($obj);
var_dump($obj->val);
```



## 繰り返し

### HTMLの要素を繰り返し表示する

```php
<table>
  <tbody>
    <?php
      for ($i = 0; $i < 5; $i++):
    ?>
    <tr>
      <td><?= $i + 1; ?> - <?= 1; ?></td>
      <td><?= $i + 1; ?> - <?= 2; ?></td>
      <td><?= $i + 1; ?> - <?= 3; ?></td>
    </tr>
    <?php
      endfor;
    ?>
  </tbody>
</table>
```

### 関数でHTMLを生成する

```php
function createHTML() {
  print('<thead>');
  print('<tr>');
  print('<th>A</th>');
  print('<th>B</th>');
  print('<th>C</th>');
  print('</tr>');
  print('</thead>' . "\n");
}

// HTML
<table>
  // 関数呼び出し
  <?php createHTML(); ?>
  <tbody>
    <?php
      for ($i = 0; $i < 5; $i++):
    ?>
    <tr>
      <td><?= $i + 1; ?> - <?= 1; ?></td>
      <td><?= $i + 1; ?> - <?= 2; ?></td>
      <td><?= $i + 1; ?> - <?= 3; ?></td>
    </tr>
    <?php
      endfor;
    ?>
  </tbody>
</table>
```



## 0, false, nullの違い

* 「==」で比較すると、0,false,nullは同じ扱いになる
* 「===」で厳密に比較すると、0,false,nullは別扱いになる

### strpos()

* 指定した文字列がどこにあるかを返す
* 他の言語のindexOfと同じ

```php
$str1 = 'ABCDEFG';
$str2 = 'ABCDEFG';
$str3 = 'ABCDEFG';

$str1 = strpos($str1, 'A');
var_dump($str1); // 0

$str2 = strpos($str2, 'C');
var_dump($str2); // 2

$str3 = strpos($str3, 'ZZZ');
var_dump($str3); // false
```

** 上記のような場合、0とfalseの判定では注意が必要



## 文字列の操作

### 結合

```php
$str = 'ABCD' . 'EFG';
var_dump($str); // 'ABCDEFG'
```

### 長さを取得

```php
$str = 'ABCD' . 'EFG';
$len = strlen($str);
var_dump($len); // 7
```

### 一部を取得する

```php
$str = 'ABCD' . 'EFG';
$str = substr($str, 1, 4);
var_dump($str); // BCDE
```

### 日本語の文字列の場合

* 一文字が「3」で扱われる

```php
$str = 'あいうえお';
$len = strlen($str);
var_dump($len); // 15

$str = substr($str, 0, 3);
var_dump($str); // 'あ'
```

* 上記のように使いにくくなってしまうので、マルチバイトを扱う関数が用意されている
* 関数に「mb_」を付ける
* 引数に文字コードを渡す(エディタの文字コード)

```php
$str = 'あいうえお';
$len = mb_strlen($str, 'UTF-8');
var_dump($len); // 5

$str = mb_substr($str, 0, 3, 'UTF-8');
var_dump($str); // 'あいう'
```

* 環境によってphp.iniの設定で、default_charsetを変更することもできる



## 画面遷移

### require

* 遷移先で別ファイルを読み込むだけの処理を記述する

```php
// 以下が実行されると、そのファイルの内容が読み込まれる
require 'new-page.php';
```



## 入力値の送受信

### フォームを作成

```php
@ index.php

// GET
<form action="input.php" method="get">
  Name: <input type="text" name="name">
  Mail: <input type="text" name="mail">
  <input type="submit" value="submit">
</form>

// POST
<form action="input.php" method="post">
  Name: <input type="text" name="name">
  Mail: <input type="text" name="mail">
  <input type="submit" value="submit">
</form>
```

送信すると、URLに入力値が組み込まれる

```
http://localhost/input.php?name=name&mail=mail
```

#### var_dump()でパラメータの値を確認

```php
@ input.php

var_dump($_GET);
var_dump($_POST);

array(2) {
  ["name"]=>
  string(4) "name"
  ["mail"]=>
  string(4) "mail"
}
```

### 受け取った値をGETで表示

```php
@ input.php

// GET
<form action="" method="get">
  Name: <?= $_GET['name']; ?>
  Mail: <?= $_GET['mail']; ?>
  <input type="submit" value="submit">
</form>

// POST
<form action="" method="post">
  Name: <?= $_GET['name']; ?>
  Mail: <?= $_GET['mail']; ?>
  <input type="submit" value="submit">
</form>
```

### buttonで条件分岐

```php
@ index.php

<form action="input.php" method="get">
  Name: <input type="text" name="name"><br>
  Mail: <input type="text" name="mail"><br>
  <input type="hidden" name="hidden" value="testHidden">
  <input type="submit" name="button1" value="submit1">
  <input type="submit" name="button2" value="submit2">
</form>
```

```php
@ input.php

if (isset($_GET['button1'])) {
  echo 'submit1';
} elseif (isset($_GET['button2'])) {
  echo 'submit2';
}
```



## SESSION

* 一定期間、Webサーバでデータを保持する仕組み
* 使用するときは、session_start() を呼んでおく
* ブラウザを閉じると保持していたデータは消える

```php
@ index.php

session_start();
$_SESSION['test'] = 'session test';
```

```php
@ session.php

session_start();
<?= $_SESSION['test']; ?> // 'session test'
```

### SESSIONの使い方の流れ

```
[入力画面] ->  [確認画面] --------->  [完了画面]
<input>       $_GET  -> $_SESSION   $_SESSION
              $_POST -> $_SESSION   $_SESSION
```



## COOKIE

* ローカルでもサーバ側でも設定ができる
* ローカルPCでデータを保持しているファイル
* 任意のデータが書き込める(数値、文字列)
* セッションID == COOKIE
* セッションIDはブラウザを閉じると生成し直す
* サーバ側では、$_SESSION[session_id]['test'] の形で保持している
* Webサーバにアクセスすると特定のサイトで作られたCOOKIEが送信される
* Webサーバ側でHTMLを返す時にCOOKIEの設定依頼を出すことができる
* JavaScriptで作成できる
* ブラウザを閉じると消えるので、通常は期限を指定する

### JavaScriptで設定

```html
@ index.html

<input type="button" name="" value="Submit" onclick="test()">

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script>
  function test() {
    var date = new Date();
    date.setTime(date.getTime() + (60 * 1000));
    //        key  :  value
    $.cookie('test1', '111', {expires: date});
    $.cookie('test2', '222', {expires: date, secure: true});
    $.cookie('test3', '333');
  }
</script>
```

* expires: 有効期限を指定する
* secure: 「true」で、https通信のときだけCOOKIEを送信する

### 取り出し

```php
@ cookie.html

<?php
// PHPで取り出し
print $_COOKIE['test1'];
print $_COOKIE['test2'];
print $_COOKIE['test3'];
?>

<input type="button" name="" value="Get" onclick="test()">

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script>
  // JavaScriptで取り出し
  function test() {
    console.log($.cookie('test1'));
    console.log($.cookie('test2'));
    console.log($.cookie('test3'));
  }
</script>
```

### サーバ側から設定依頼

```php
@ setcookie.php

<?php
setcookie('test1', '999', time() + (60 * 60 * 24 * 30), '', '', true);
```

* 設定依頼を受け取ったブラウザ側でJavaScriptが作成する

