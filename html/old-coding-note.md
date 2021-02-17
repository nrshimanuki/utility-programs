# Note


## MarkUp

### メールアドレス
* spam防止のためエンティティ化する

### ロールオーバー
```
<input type="image" name="submit" src=".." value="確認" alt="確認" onMouseOver="this.src='..'" onMouseOut="this.src='..'">
```

### 画像
画像でも段落の要素があるなら、 div じゃなく p で囲う。

### datatime
```
<a href="#">
	<article>
		<p class="date"><time datatime="20xx-xx-xx">20xx.xx.xx</time></p>
		<p class="text">てきすと。てきすと。てきすと。</p>
	</article>
</a>
```

### 画像がコンテンツ幅より大きいとき
```
.pageTitle {
	width: 100%;
	height: 460px;
	margin: 0 auto;
	padding: 0 0 50px;
	position: relative;
	overflow: hidden;
}
.pageTitle h2 {
	position: absolute;
	left: 50%;
	margin-left: -750px;
	width: 1500px;
	height: 460px;
}
```

### 背景画像を中央配置
```
.box {
	position: relative;
}
.box:after {
	display: block;
	position: absolute;
	left: 50%;
	bottom: -20px;
	margin-left: -10px;
	width: 20px;
	height: 20px;
	background: url(img01.png) no-repeat;
	content: "";
}
```

### Button
* コード上で改行あると、ブラウザでスペース空く
```
<button type="submit"><img src=""></button>
```

* イメージ画像をつけるとき、
```
buttom {
	margin: 0;
	padding: 0;
	background: none;
	border: none;
}
```

### マウスオーバー（重ねる）
```
<li class="home"><a href="#"><img src="通常時の画像"></a></li>
<li class="about"><a href="#"><img src="通常時の画像"></a></li>

li a {
	display: block;
}
li a:hover img {
	visibility: hidden;
}
li.home a {
	background: 〜
}
li.about a {
	background: 〜
}
```
※ 通常画像を透過で指定すると下の画像透けるので注意

### ウインドウの幅を縮めたとき、右側が切れる
bodyにmin-widthを指定する

