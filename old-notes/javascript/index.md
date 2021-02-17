JavaScript
==============================

## JavaScript 概要

* Webブラウザやサーバで動くプログラム言語
* 主に動的な振る舞い
* プログラムはHTML文書と同様にサーバに置かれるが、文書の閲覧と同時にブラウザにダウンロードされ、ブラウザ内で実行される。(クライアントのCPUを使用する)
* インタプリタ言語


## JavaScript 基本的な書き方

### 記述位置
* HTML文書内、scriptタグの中

### 出力

```
document.write('sample');
alert('sample');
console.log('sample');
```

### 変数
* var 変数名 = 初期値;
* 英字、数字、「 $ 」「 _ 」が使用可能で大文字小文字は区別される

### 定数
* const 定数名 = 初期値;
* 慣習的に大文字で定義

### メソッド
* オブジェクト内で定義済みの関数
* object.メソッド名();



## JavaScriptのオブジェクト

### historyオブジェクト
* ブラウザの戻る、進むボタン

### windowオブジェクト
* ウィンドウ

### locationオブジェクト
* URL入力フィールド

### documentオブジェクト
* ドキュメント表示領域<br>
document.write(...);

### consoleオブジェクト
* コンソール画面

windowオブジェクトのみ省略可能<br>
(ex) window.alert(...);



## 金額計算 (Lesson)

```javascript
<script>
  var input = parseInt(prompt('金額を入力してください'));
  const TAX_RATE = 0.08;
  // var input = 800;
  var tax = input * TAX_RATE;
  document.write('入力金額：' + input + '<br>');
  document.write('消費税額：' + tax + '<br>');
  document.write('税込金額：' + (input + tax));
</script>
```

* JavaScriptに限らず、promptの入力は文字列になる



## 配列

* ひとつの入れ物の中に複数のデータを並べて保存する仕組み

### 宣言
* var 配列名 = [データ0, データ1, ...];
* var 配列名 = []; // 空の配列<br>
  配列名.push(データ); // 配列の末尾に追加

### 配列の個数を取得
* length = item.length

```javascript
<script>
  var item = [800, 600, 250];
  var sum = item[0] + item[1] + item[2];
  document.write('アイテム1: ' + item[0] + '<br>');
  document.write('アイテム2: ' + item[1] + '<br>');
  document.write('アイテム3: ' + item[2] + '<br>');
  document.write('合計金額 = ' + sum);
</script>
```



## 連想配列

* キーを指定して値を設定・取得する

### 宣言
* var 配列名 = {キー0: データ0, キー1: データ1, キー2: データ2, ...};

```javascript
<script>
  var item = {
    "定食": 800,
    "ラーメン": 600,
    "シェイク": 250
  };
  var input = prompt("注文を入力してください");
  document.write(input + ":" + item[input]);
</script>
```



## 配列の操作

### 配列から取得

```javascript
var person1 = {
  name: 'person1',
  age : '30'
}

function getAge(person) {
  return person.age;
}

var pAge = getAge(person1);
console.log(pAge);
```

### .pusu() ... 配列の最後に追加

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.push(10);
console.log(arr); // 1,2,3,4,5,10（最後に追加）
console.log(x);   // 6（値の個数を返す）
```

### .pop() ... 配列の最後を取り出す

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.pop();
console.log(arr); // 1,2,3,4（最後を取り出し）
console.log(x);   // 5（取り出された値を返す）
```

### .unshift() ... 配列の先頭に追加

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.unshift(10);
console.log(arr); // 10,1,2,3,4,5（先頭に追加）
console.log(x);   // 6（値の個数を返す）
```

### .shift() ... 配列の先頭を取り出す

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.shift();
console.log(arr); // 2,3,4,5（先頭を取り出し）
console.log(x);   // 1（取り出された値を返す）
```

### .splice() ... 配列の中間を操作する

#### 取り出し

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.splice(1, 3);
console.log(arr); // 1,5（中間を取り出し）
console.log(x);   // 2,3,4（取り出された値を返す）
```

#### 取り出した部分に追加

```javascript
arr = [1, 2, 3, 4, 5];
var x = arr.splice(1, 3, 20, 30, 40);
console.log(arr); // 1,20,30,40,5（中間を取り出し）
console.log(x);   // 2,3,4（取り出された値を返す）
```



## 繰り返し

### forEach

```javascript
arr = [1, 2, 3, 4, 5];
arr.forEach(function(num) {
  console.log(num);
});
```

#### ラムダ式の書き方

```javascript
arr = [1, 2, 3, 4, 5];
arr.forEach(num => console.log(num * 2));
```

#### ラムダ式で複数処理

```javascript
arr = [1, 2, 3, 4, 5];
arr.forEach(num => {
  console.log(num * 10);
  console.log(num * 100);
});
```

** 複数処理のときは波括弧で囲う<br>
** forEachは値を使って何かをする（配列を返すわけではない）



## 新しい配列を返す

### .map() ... もとの配列を使い、別の配列を作る

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.map(function(num) {
  return num * 3;
});
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 3,6,9,12,15
```

#### ラムダ式の書き方

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.map(num => num * 3);
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 3,6,9,12,15
```

** ラムダ式のときは、return不要

#### 配列を返すか、返さないか

```javascript
var arr = [1, 2, 3, 4, 5];
var arr2 = arr.map(num => num * 3);

var arr3 = [];
var arr4 = arr.forEach(num => arr3.push(num * 4));

console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 3,6,9,12,15
console.log('arr3: ' + arr3); // 4,8,12,16,20
console.log('arr4: ' + arr4); // undefined
```

** .mapは配列を返すが、forEachは返さない

### .filter() ... もとの配列を使って条件に合うものを選別し、別の配列を作る

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.filter(function(num) {
  return num % 2 == 1;
});
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 1,3,5
```

#### ラムダ式の書き方

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.filter(num =>
  num % 2 == 1
);
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 1,3,5
```

** ラムダ式のときは、return不要

### .find() ... もとの配列を使って条件に合うものを見つけ、一つ目の値を返す

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.find(function(num) {
  return num % 2 == 0;
});
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 2
```

#### ラムダ式の書き方

```javascript
arr = [1, 2, 3, 4, 5];
arr2 = arr.find(num =>
  num % 2 == 0
);
console.log('arr: ' + arr);   // 1,2,3,4,5
console.log('arr2: ' + arr2); // 2
```

** ラムダ式のときは、return不要



## 文字列を区切る

### split()

```javascript
var str = "1 + 2 + 3";
var arr = [];
str.split(" ").forEach(function(s, i){
  arr.push(['index' + i, s]);
  console.log(arr);
});
```


## Sample

### 与えられた配列の順番を逆にする

#### unshift()

```javascript
var array = [5, 4, 3, 2, 1];
function reverse(array) {
  let result = [];
  array.forEach(item=> result.unshift(item))
  return result;
}
console.log(reverse(array));
```

### 条件に一致する値の配列を返す

#### filter()

```javascript
var array = [5, 4, 3, 2, 1];
function condition(array) {
  return array.filter(item => item >= 3);
}
console.log(condition(array));
```

### 同じ長さの配列の値を、それぞれ足した配列を返す

#### map

```javascript
var array1 = [5, 4, 3, 2, 1];
var array2 = [10, 9, 8, 7, 6];
function addArray(array1, array2) {
  let array3 = [];
  array1.forEach(function(item, i){
    array3.push([item, array2[i]]);
  });
  console.log(array3);

  let array4 = [];
  for (i = 0; i < array3.length; i++) {
    array4.push(array3[i][0] + array3[i][1]);
  }
  return array4;
}
console.log(addArray(array1, array2));
```
↓ シンプルに

```javascript
var array1 = [5, 4, 3, 2, 1];
var array2 = [10, 9, 8, 7, 6];
function addArray(array1, array2) {
  let array3 = [];
  array1.forEach(function(item, i){
    array3.push([item, array2[i]]);
  });
  console.log(array3);

  let array4 = array3.map(item =>
    item[0] + item[1]
  );
  return array4;
}
console.log(addArray(array1, array2));
```
↓  もっとシンプルに

```javascript
var array1 = [5, 4, 3, 2, 1];
var array2 = [10, 9, 8, 7, 6];
function addArray(array1, array2) {
  return array1.map(function(item, i){
    return item + array2[i];
  });
}
console.log(addArray(array1, array2));
```



## 連想配列の操作

### indexOf(), sort()

```javascript
var itemList = [
  {item: 'aab', price: 100},
  {item: 'bbc', price: 50},
  {item: 'ccd', price: 300},
  {item: 'dde', price: 4000},
  {item: 'eea', price: 500}
]

// 最初のitemの値段にアクセスする
console.log(itemList[0].price);

// priceの配列を作成する
let prices = itemList.map(item => item.price);
console.log(prices);

// 300円以上のitemだけの配列を作成する
let hightPrice = itemList.filter(item => item.price >= 300);
console.log(hightPrice);

// 「d」が含まれるitemだけの配列を作成する
let itemD = itemList.filter(item => item.item.indexOf("d")　>= 0);
console.log(itemD);

// 値段の低い順に並び替えた配列を作成する
itemList.sort(function(a, b){
  if (a.price < b.price) return -1;
  if (a.price > b.price) return 1;
  return 0;
});
console.log(itemList);
```



## 条件分岐

```javascript
<script>
  // 偶奇の判断
  var input = prompt('整数をひとつ入力してください');
  var remain = parseInt(input) % 2;
  if (remain == 0) {
    document.write(input + 'は偶数です');
  } else {
    document.write(input + 'は奇数です');
  }
</script>
```

```javascript
<script>
  var item = {'定食':800, 'ラーメン':600, 'シェイク':250};
  var input = prompt('注文を入力してください');
  if (input == null) {
    document.write('キャンセルされました。');
  } else if (input == '') {
    document.write('注文を入力してください。');
  } else if (input != '定食' && input != 'ラーメン' && input != 'シェイク') {
    document.write('注文を間違えています: ' + input);
  } else {
    document.write(input + ':' + item[input]);
  }
</script>
```

```javascript
<script>
  // うるう年判定
  var yyyy = prompt("西暦年を入力してください")
  if ((yyyy % 4 == 0) && (yyyy % 100 != 0)) {
    document.write(yyyy + "年はうるう年です")
  } else if (yyyy % 400 == 0) {
    document.write(yyyy + "年はうるう年です")
  } else {
    document.write(yyyy + "年は平年です")
  }
</script>
```

* {}の中が1文の場合は、{}を省略できる<br>
  if (order == null) document.write('...');



## switch

```javascript
<script>
  var item = {'定食':800, 'ラーメン':600, 'シェイク':250};
  var input = prompt('注文を入力してください')
  switch (input) {
    case null:
      document.write('キャンセルされました。');
      break;
    case '':
      document.write('注文を入力してください。');
      break;
    case '定食':
    case 'ラーメン':
    case 'シェイク':
      document.write(input + ':' + item[input]);
      break;
    default:
      document.write('注文を間違えています: ' + input);
  }
</script>
```



## 繰り返し



## 画面遷移

### location

```javascript
document.location = 'https://www.google.co.jp/';
```

### action, submit()

```javascript
form.action = 'https://www.google.co.jp/';
form.submit();
```



DOM操作課題
==============================

## 演習　連想配列の配列操作

```
<div class="container">
  <ul class="users">
    <li class="user">
      <a href="#!/user/tanaka">田中</a>:
      <span id="tanaka-score" class="score">98</span>
    </li>
    <li class="user" id="fujita">
      <a href="#!/user/fujita" >藤田</a>:
      <span class="score">63</span>
    </li>
    <li class="user yamaoka">
      <a href="#!/user/yamaoka">山岡</a>:
      <span class="score">86</span>
    </li>
    <li class="user" data-user-id="5">
      <a href="#!/user/okada"  >岡田</a>:
      <span class="score">74</span>
    </li>
    <li class="user" data-user-id="7">
      <a href="#!/user/endo">遠藤</a>:
      <span class="score">46</span>
    </li>
  </ul>
  <form>
    <label>氏名:<input id="input-name" type="text"></label>
    <label>得点:<input id="input-score" type="text"></label>
    <button type="button" id="add">追加</button>
  </form>
  <button id="sort" type="button">並べ替え！</button>
</div>
```

### 田中の得点を取得する

```
document.getElementById('tanaka-score').innerHTML;
```

### 藤田の得点を取得する

```
Array.from(document.getElementById('fujita').children)
  .find(e => e.classList.contains('score')).innerHTML;

/*
let fujitaScore;
let fujita = Array.from(document.getElementById('fujita').children);
// fujitaLiChildren[0].classList.contains('score') // false
// fujitaLiChildren[1].classList.contains('score') // true
fujita.forEach(e => {
  if (e.classList.contains('score')) fujitaScore = e.innerHTML;
});
fujita.filter(e =>e.classList.contains('score'));
console.log('藤田: ' + fujitaScore);
*/
```

### 山岡の得点を取得する
```
Array.from(document.getElementsByClassName('yamaoka')[0].children)
  .find(e => e.classList.contains('score')).innerHTML;

/*
let yamaokaScore;
let yamaokaClass = Array.from(document.getElementsByClassName('yamaoka'));
let yamaokaLiChildren = Array.from(yamaokaClass.find(e => e.classList.contains('yamaoka')).children);
yamaokaLiChildren.forEach(e => {
  if (e.classList.contains('score')) yamaokaScore = e.innerHTML;
});
console.log('山岡: ' + yamaokaScore);
*/
```

### 岡田の得点を取得する

```
Array.from(Array.from(document.getElementsByClassName('user'))
  .find(e => e.getAttribute('data-user-id') == 5).children)
  .find(e => e.classList.contains('score')).innerHTML;

/*
var okadaScore;
var users = Array.from(document.getElementsByClassName('user'));
for (var i = 0; i < users.length; i++) {
  if (users[i].getAttribute('data-user-id') == 5) {
    okadaScore = users[i].children[1].innerHTML;
  }
}
*/
```

### 遠藤の得点を100に変更する

```
Array.from(Array.from(document.getElementsByClassName('user'))
  .find(e => e.getAttribute('data-user-id') == 7).children)
  .find(e => e.classList.contains('score')).innerHTML = 100;
```

### 氏名の入力欄に 吉岡を設定する

```
document.getElementById('input-name').value='吉岡';
```

### 得点が70点未満userにred-scoreクラスを付与する

```
Array.from(document.getElementsByClassName('score'))
  .forEach(e => {
    if (e.innerHTML < 70) {
      e.parentNode.classList.add('red-score');
    }
  });
```

### 追加ボタンが押されたら、一覧の最後に追加するようにする

```
addBtn = document.getElementById('add');
addBtn.addEventListener('click', function() {
  let elemUsers = document.getElementsByClassName('users')[0];
  let inputNameValue = document.getElementById('input-name').value;
  let inputScoreValue = document.getElementById('input-score').value;

  let li = document.createElement('li');
  li.classList.add('user');

  let a = document.createElement('a');
  a.innerHTML = inputNameValue;

  let span = document.createElement('span');
  span.innerHTML = inputScoreValue;
  span.classList.add('score');

  li.appendChild(a);
  li.appendChild(document.createTextNode(': '));
  li.appendChild(span);

  elemUsers.appendChild(li);
});

/*
btn = document.getElementById('add');
btn.addEventListener('click', function() {
  let clone = document.getElementsByClassName('yamaoka')[0].cloneNode(true);
  let inputName = document.getElementById('input-name').value;
  let inputScore = document.getElementById('input-score').value;
  let users = document.getElementsByClassName('users')[0];

  clone.classList.remove('yamaoka');
  clone.children[0].innerHTML = inputName;
  clone.children[0].removeAttribute('href');
  clone.children[1].innerHTML = inputScore;

  users.appendChild(clone);
});
*/
```

### [{name:'田中',score:98},{name:'藤田',score:63}...]のような配列データを取得する

```
var usersArray = new Array();
Array.from(document.getElementsByClassName('user'))
  .map(e => usersArray.push({name: e.children[0].innerHTML, score: e.children[1].innerHTML}));

/*
var usersArray = new Array();
Array.from(document.getElementsByClassName('user'))
  .forEach(e => usersArray.push({name: e.children[0].innerHTML, score: e.children[1].innerHTML}));
*/
```

### 並べ替えボタンがおされたら、得点の降順で並べ替える

```
var elemSortLi = [];
var elemUsers = document.getElementsByClassName('users')[0];
var users = Array.from(document.getElementsByClassName('user'));
var sortBtn = document.getElementById('sort');
sortBtn.addEventListener('click', function() {
  users.sort(function(a, b){
    if (a.children[1].innerHTML < b.children[1].innerHTML) return 1;
    if (a.children[1].innerHTML > b.children[1].innerHTML) return -1;
    return 0;
  });
  users.forEach(e => elemSortLi.push(e));
  for (let i = 0; i < elemSortLi.length; i++) {
    elemUsers.appendChild(elemSortLi[i]);
  }
});
```



連想配列の配列操作
==============================

## 演習　連想配列の配列操作

```
var members= [
  {name: '鈴木', score: 54},
  {name: '田中', score: 75},
  {name: '佐藤', score: 38},
  {name: '川口', score: 82},
  {name: '伊藤', score: 45}
]
```

上記の配列(members)を利用して、以下問題の結果が得られるコードを書く。

### 「鈴木」さんのscoreをコンソールに表示させる

```
console.log(members[0].name + ': ' + members[0].score);
```

### nameの配列を作成する。（完成例　['鈴木','田中','佐藤','川口','伊藤']）

```
console.log('--- # 2 ---');
let name = members.map(member => member.name);
console.log(name);

or

let name = members.map(function(member) {
  return member.name;
});
console.log(name);
```

### scoreが50点以上の人だけを絞り込み、新しい配列を作成する。

```
let scores = members.filter(member => member.score >= 50);
console.log(score);

or

let scores = members.filter(function(member) {
  return member.score >= 50;
});
console.log(score);
```

### nameに「藤」がつく人だけを絞り込み、新しい配列を作成する。

```
let name2 = members.filter(member => member.name.indexOf("藤")　>= 0);
console.log(name2);

or

let name2 = members.filter(function(member) {
  return member.name.indexOf("藤")　>= 0;
});
console.log(name2);
```

### scoreの高い順に並び替えた新しい配列を作成する。

```
let highScore = members.sort(function(a, b){
    if (a.score < b.score) return 1;
    if (a.score > b.score) return -1;
    return 0;
});
console.log(members);
```
