Vue.js
==============================

## 概要

* 公式サイト https://jp.vuejs.org/
* 双方向 (two-way) データバインディング
  * データとUIを結びつける
  * データが更新されるとUIが更新され、UIが更新されるとデータが更新される
* 「v-」から始まる属性はディレクティブと呼ぶ


## v-model

* モデルが保持している値をUIに反映させる
* UIからモデルのデータへ反映させる

### UIに結びつくモデルを作成する

```javascript
var vm = new Vue({
  // どの領域のビューと結びつけるかを指定する
  el: '#app1',
  // このモデルにデータを保持させる
  data: {
    key1: 'val1',
    key2: 'val2',
    name: 'Test Name'
  }
});
```

### モデルが保持している値をUIに反映させる

```html
<div class="app" id="app1">
  <!-- モデルが保持している値をUIに反映させる -->
  <!-- {{ }} にはJavaScriptが書ける -->
  <p>key1の値は、{{ key1 }}</p>
  <p>key2の値は、{{ key2 }}</p>
  <p>Hello, "{{ name.toUpperCase() }}"</p>

  <!-- UIからモデルのデータへ反映させる -->
  <!-- inputに入力した値をv-modelと結びつける -->
  <div><input type="text" v-model="name"></div>
</div>
```


## v-for

* データをループさせる

### UIに結びつくモデルを作成する

```javascript
var vm = new Vue({
  el: '#app2',
  data: {
    todos: [
      'todo A',
      'todo B',
      'todo C'
    ]
  }
});
```

### データをループさせて、モデルが保持している値をUIに反映させる

```html
<div class="app" id="app2">
  <!-- モデルが保持している値をUIに反映させる -->
  <!-- データをループさせる -->
  <ul>
    <!-- <li>{{ todos[0] }}</li> -->
    <!-- <li>{{ todos[1] }}</li> -->
    <!-- <li>{{ todos[2] }}</li> -->
    <li v-for="todo in todos">{{ todo }}</li>
  </ul>
  <form>
    <input type="text">
    <input type="submit" value="Add todo">
  </form>
</div>
```


## v-on

* イベントを設定する
* v-on: は @ に省略可

### UIに結びつくモデルを作成する

```javascript
// UIに結びつくモデルを作成する
var vm = new Vue({
  // どの領域のビューと結びつけるかを指定する
  el: '#app2',
  // このモデルにデータを保持させる
  data: {
    inputItem: '',
    todos: [
      'todo C',
      'todo B',
      'todo A'
    ]
  },
  // methodsというキーで関数を設定
  methods: {
    addInputItem: function(e){
      // フォームの動作(ページ遷移)を無効化
      // e.preventDefault();
      //   -> viewの @submit.prevent で同じ意味

      // モデル内のデータにはthisでアクセス可
      this.todos.unshift(this.inputItem);
      this.inputItem = '';
    }
  }
});
```

```html
<div class="app" id="app2">
  <ul>
    <!-- モデルが保持しているデータをループしてUIに反映させる -->
    <li v-for="todo in todos">{{ todo }}</li>
  </ul>
  <!-- submitされたときにデータを更新させるイベントをつける -->
  <!--   以下は同じ意味 -->
  <!--   <form v-on:submit="addItem"> -->
  <!--   <form @submit="addInputItem"> -->
  <!-- .prevent フォームの動作(ページ遷移)を無効化 -->
  <form @submit.prevent="addInputItem">
    <!-- inputに入力した値をv-modelと結びつける -->
    <input type="text" v-model="inputItem">
    <input type="submit" value="Add Todo">
  </form>
</div>
```
