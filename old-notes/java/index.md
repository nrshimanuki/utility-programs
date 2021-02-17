Java Basic
==============================

* Basic
* オブジェクト指向とは
* クラス
* 例外処理
* Java標準クラス（API）
* Web Application
* Tips


型とメソッド
==============================

## 型

* メモリ、参照型の仕組み

## メソッド

* returnのとき、その型を指定
* voidは戻り値無し



プログラミングとは
==============================

## プログラミング言語

* コンピュータに指示を与えるための言語

## 高級言語

* 人間に理解できる
* ソースファイル ○○○.java

## コンパイル

* 翻訳

## マシン語

* コンピュータにわかる言葉
* javaバイトコード ○○○.class

## JVM

* 仮想環境のようなもの



簡単なプログラム
==============================

## プログラムの構造

```
public class Main {
  // クラスブロック
  public static void main(String[] args) {
    // メソッドブロック ここに処理を記述

    // 改行有無の違い ln -> line（1行の意味）
    System.out.println("Hello World!!");
    System.out.print("Hello World!!");
  }
}
```



変数とデータ型
==============================

## リテラル

* ソース内に現れる定数のこと

## 変数

* 数や文字列を記録しておく箱

## データ型

* int型: 整数を記憶する変数
* double型: 実数を記憶する変数
* String型: 文字列を記憶する変数
* char型: 一文字を記憶する変数
* boolean型: true/false（真偽）を格納する変数



初期化
==============================

```
int a;
a = 10;
↓
int a = 10;
```



ユーザ入力
==============================

```
int n = new java.util.Scanner(System.in).nextInt();
String s = new java.util.Scanner(System.in).nextLine();

or

import java.io.*;
BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
String str = br.readLine();
```

## キーボードからの入力

```
@ Sample.java

import java.io.*;

class Sample {
  public static void main(String args[]) throws IOException {
    System.out.println("文字を入力してください");

    //
    BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

    // ユーザーからの入力を待つ状態で止まる
    // 入力した文字列が str に入る
    String str = br.readLine();

    System.out.println(str + "が入力されました。");
  }
}
```



式と演算子
==============================

## オペランド

* 変数や式に現れる数字

## 演算子

* =, +, - など

## 評価

* javaが式に従って計算処理をすること

## 評価結果への置換原則

* 演算子はオペランドの情報をつかって計算を行い、それらオペランドを巻き込んで結果に化ける
* 演算子は左右のオペランドを巻き込む = 結果に化ける
* 優先順位： 左から順だけど、javaの規則に依る

## 優先順位

式に演算子が複数あるときは、Javaで定められた優先順位が高い演算子から順に評価される

```
+ 中
- 中
* 高
/ 高
% 高

+ (連接) 中

=  最低
+= 最低
-= 最低
*= 最低
/= 最低
%= 最低
+= 最低

a = a + 2;
a += 2;
☆ 代入は必ず最後に実行される

++ 最高
-- 最高
☆ インクリメントは最初に実行される
```



変数・バイト幅・型
==============================

## 変数

* 並んだメモリ上に確保された領域
* 型によって使う領域の幅（バイト幅）が違う
* Javaでは型にあった数値しか代入できない

## バイト幅

* int < double なので、intの値をdoubleには入れることができる
* 大きい方を小さい方には入れられない
* 小さい型 -> 大きい型への代入のときだけ「暗黙の型変換」が行われる

## 演算時の自動型変換

* 演算時は「大きい」型に統一
* 5/2 int/int なので、2 となる
* 5.0/2 double/int はdoubleが大きいので 5.0/2.0 と double/double になって 2.5 となる

## キャスト

* (double)3 => 3.0
* (int)5.0 => 5
* (int)3.14 => 3 小数点以下の切り捨て(収まらない情報はキャストで失われる かつ エラーにならない)

** キャストはむやみに使わない方が良い



文字列の連接
==============================

* "ベスト" + 3 strinng + int
* "ベスト" + "3" strinng + strinng
* "ベスト3" となる
* 文字列と他の何かの連接は「全部文字列」に型変換



構造化定理
==============================

あらゆる処理の正体は

* 順次
* 分岐
* 繰り返し

の組み合わせ

```
if (weather == true) {
  System.out.println("洗濯、散歩");
} else {
  System.out.println("部屋");
}
```


繰り返し
==============================

```
while (doorClose == true) {
  System.out.println("ノックします");
  System.out.println("1分待ちます");
  doorClose = false;
}
```


関係演算子・論理演算子
==============================

* 比較: ==, >= など
* 条件をくっつける: && ||

```
((a < -1) || (a > 1)) && ((b < -2) || (b > 2))
```


文字列の比較
==============================

```
s1.equals(s2)
```


回数の決まった繰り返し
==============================

```
for (int i = 0; i < n; i++) {
  System.out.println("aaa");
}
```


配列
==============================

同じ型の変数の並び

## 宣言

```
int[] score;
score = new int[5];

// 代入しながら宣言
int[] score = new int[5];

int[] score = new int[5];
double[] array = new double[10];
boolean[] results = new boolean[3];
String[] names = new String[4];
```


配列は勝手に初期化
==============================

## 配列の各要素は勝手に初期化される

* int, double : などの数値型 : 0
* boolean : false
* String : null

## 初期化の省略記法

```
int[] score = {20, 30, 40, 50, 60};
```



配列の要素を扱う
==============================

```
System.out.println(score[1]);
score[1] = 10;
System.out.println(score[1]);
```

## 配列の長さ

``` score.length; ```



配列のメリット
==============================

forループと相性抜群

```
System.out.println(score[0]);
System.out.println(score[1]);
System.out.println(score[2]);
System.out.println(score[3]);
System.out.println(score[4]);

↓

for (int i = 0; i < score.length; i++) {
  System.out.println(score[i]);
}
```

```
public class Main {
  public static void main(String[] args){
    int[] num = new int[100];
    for (int i = 0; i < num.length; i++) {
      num[i] = i;
      System.out.println(num[i]);
    }
  }
}
```

```
public class Main {
  public static void main(String[] args){
    int[] num = new int[100];
    for (int i = 0; i < num.length; i++) {
      num[i] = i;
    }
    for (int n : num) {
      System.out.println(n);
    }
  }
}
```

```
☆☆☆
public class Main {
  public static void main(String[] args){
    int[] num = {10, 20, 30, 40, 50};
    for (int n : num) {
      System.out.println(n);
    }
  }
}
```


メソッド
==============================

mainメソッドは必ず最初に実行される

## 戻り値

* 値を戻してもらう
* 引数として配列変数も使える

## 値渡し

* 値のコピーを渡す
* 配列で渡すと話が変わる

## 参照渡し

* 場所（住所）を渡す
* アドレス（参照型変数）を渡す



オブジェクト指向とは
==============================

明確な思想を持とうという考え方


## 手続き型プログラミング

コンピュータがどのように動くべきかを考えて、プログラムの先頭から順番に命令として記述する


## オブジェクト指向

* 現実世界の「ミニチュア」をコンピュータの中に再現
* 設計だけでは意味がなくて、実体を生み出す
* ソースコードが台本のようになる
* 「実体（インスタンス）」が仮想世界で動き回るのを再現

■ 例えると

* mainメソッド（神）
* クラス 設計図 （金型）
* インスタンス 実体 （たい焼き）

■ メリット

直観で把握しやすい。現実世界の模倣だから。



## 車の例

### 一番の大枠（設計図） → クラス

* 状態・性質 → フィールド （クラスの中で宣言されている変数）
* 機能 → メソッド

### 実態 -> インスタンス （クラスとは全く別物）

* フィールドやメソッドを呼び出す



コンストラクタ
==============================

* インスタンス化と同時に実行されるメソッド（のようなもの）
* クラス名と同じ。戻り値は「指定しない」（メソッドならvoidをつける）

```
public class Car {
  public Car(int n, double g, double d, String str) {
    this.num = n;
    this.gas = g;
    this.distance = d;
    this.maker= str;
    System.out.println("車作りました");
    System.out.println("ナンバー：" + this.num);
    System.out.println("ガソリン：" + this.gas + "L");
    System.out.println("走行距離：" + this.distance + "km");
    System.out.println("メーカー：" + this.maker);
  }
}
```

* 用意しなくても勝手にクラス名と同じコンストラクタが実行されていた。 → 「暗黙のコンストラクタ」
* 書いたらそっちが優先されて実行される



## コンストラクタのオーバーロード

* 初期値指定と初期値無しを共存できる
* javaのクラスには必ずコンストラクタが必要



手続き型とオブジェクト指向
==============================

* プログラミングは手続き型とオブジェクト指向に分けられる
* 手続き型は記述されている通りに上から順番に実行されるプログラミング
* それに対してオブジェクト指向プログラミングは、実体があるかのように扱おうとする手法
* オブジェクトとは「物」のことで、それを作り出すために必要な「状態・性質」「機能」を「設計」して組み立てていく
* 手続き型では冗長で複雑になりがちなコードを、オブジェクト指向プログラミングではひとつひとつの処理が細分化されて管理される
* それらが部品として用意されているので、交換やメンテナンス追加などあらゆることが全体をばらさなくても変更することができる
* また、ひとかたまりの処理が小分けになるので再利用もしやすい



カプセル化
==============================

## オブジェクト指向の大前提

* 現実世界にありえないことは起きてはいけない
* 自由な書き換えができるのは「危ない」

## メンバ

* フィールド
* メソッド

## private

* 外から書き換えも読むこともできない
* アクセス修飾子

## セッター

* 受け取った引数を自身のフィールドに代入する
* 引数として値を受け取ってメソッド経由でプライベートメンバを書き換える

```
  private double gas;
  public void setGas(double g) {
    // privateの値を中で書き換える セッター
    if((g > 0) && (g < 1000)) {
      this.gas = g;
      System.out.println("ガソリン量を" + g + "Lにしました");
    }
  }
```

## ゲッター

* 戻り値としてフィールドの値を返すメソッド
* メソッド経由でプライベートメンバを教えてもらう

```
  public double getGas() {
    return this.gas;
  }
```

## カプセル化

* メンバへの適切なアクセス制御を行うこと

## カプセル化の定石（こうしておけばとりあえずOK）

* フィールドはprivate、メソッドはpublic

## メリット

* Read Only, Write Only フィールドを実現できる
* フィールド名など、クラスの内部設計を自由に変更できる
* フィールドへのアクセスを検査できる

## オーバーロード

* 同じ名前のメソッドを複数定義する
* メソッドはシグネチャ（引数の種類と並び）さえ違えばたくさん作れる
* javaは判断してくれる

```
void setCar(int n)
void setCar(double g)
void setCar(int n, double g)
```

* インスタンスを引数にして、それに対して何か操作もできる



クラスの継承
==============================

* 共通フィールド、共通メソッドを毎回書くのは非効率
* 性質を受け継いでいる（継承）

```
public class SportCar extends Car {
  void drift() { }
}
```

```
親クラス（スーパークラス）
  ↑ 矢印は子から親に
子クラス（サブクラス）
```


## コンストラクタの順番

* 親クラスのコンストラクタから順番に呼ばれる
* サブクラスのコンストラクタの先頭では、（何もしなければ）スーパークラスの引数無しコンストラクタが呼ばれる

### super()

* オーバーロードしたコンストラクタを指定したいとき使う
* 最初に引数を与えて呼び出してあげる

```
public SportCar() {
  super(1234, 2.0);
  System.out.println("created suports car");
}
```

### メソッドの「オーバーライド」

* スーパークラスのメソッドをサブクラスで上書きすること
* 改めて定義すればOK

### オーバーライドの禁止

* オーバーライドされたくないメソッドは禁止できる
* 「final」



## 継承の正しさ ☆☆☆

### Is-aの原則

* 継承はIs-aの関係がある場合に限る
  - sportcar is a car.
  - house is not an item.

** Is-aが成立していないのにフィールドが共通だからと安易に継承してはいけない



## 汎化と特化

### 汎化

親クラスに行くほど抽象的になる

### 特化

子クラスに行くほど具体的になる

* インスタンス化できるかできないかが境目
* 車はインスタンス化できるけど、乗り物はできない



## 高度な継承

「あいまい」なクラスを扱う

### 今までの立場

* 作る必要があるプログラムは決まっている
* それのためだけに、必要なクラスを作ってプログラムを完成させる
* 開発すべきクラスと「似ている」既存クラスがあれば、継承で子クラスとして簡単に実現可能<br>
↓<br>
作ってくれた誰かがいる

### 開発者の気持ち

* 「誰かがこのクラスを継承して開発をしてほしい」 - 継承の材料を作ってくれた



開発者としての立場
==============================

1. 既存クラスを継承して作っていた = 誰かが継承の材料を作ってくれた
2. 親となるクラスを作っておく

* 「詳細未定」メソッドが残っているクラスは、newされてはならない

### クラスの使い方

* new、extends、どちらかしかなく、開発者はいつでもどちらでも選べてしまう

### 抽象メソッド

* 「詳細未定」のメソッド
* これは詳細未定だよ。オーバーライド頼むよと、開発者に知らせる
* 決まってないから{}で開かないでセミコロンで終わる<br>
public abstract void attack(Enemy e);

### 抽象クラス

* インスタンス化できないクラス
* 抽象メソッドが入っていたら必ず抽象クラス
* public abstract class Character {...}

* オーバーライド忘れの心配
* 何もしないメソッドと勘違いされる心配
* インスタンス化(new)されちゃう心配が抽象クラスによってすべて解決できる

** 抽象クラスを継承するとき、必ずすべての抽象メソッドをオーバーライドしなければならないわけではない。
** 抽象クラスから抽象クラスへの継承もOK



インターフェース
==============================

* 用意するから、あとはオーバーライドしてね
* これとこれとこれ、作ってね

## 継承

* 親 → 子 （特化）
* 子 → 親 （汎化）

## 汎化をめちゃくちゃ繰り返したらどうなる？

* 抽象メソッドが増え始める
* 抽象メソッドやフィールドが減り始める
* 少数の抽象メソッドだけが残る ← ここをモデル化

```
親
|-------------
| 抽象メソッド 少 => 「インターフェース」
|-------------
|
|-------------
| 抽象メソッド
| フィールド
|-------------
|
|-------------
|
| 普通のメソッド
| フィールド
|
|-------------
子
```

## インターフェース （抽象クラスみたいなもの）

* 全メソッドが抽象メソッド
* 抽象メソッドのみを持つからインスタンス化できない
* フィールドを持たない
** 定数フィールドはOK(書き換えられないフィールド final 省略可)

```
// 抽象クラスに抽象メソッドがちょっとだけある状態
public abstract class Character {
  public abstract void drive();
  public abstract void stop();
}
```

これを省略して書くと、

```
public interface Character {
  void drive();
  void stop();
}
```

* 一番抽象なものを特別な書き方にしましょうというもの
* これを継承して普通（抽象でもOK）のクラスにする → インターフェースを実装(implements)する
** extendsではない

```
public class Hero implements Character {
  public void run() {
    System.out.println("逃げ出した");
  }
}
```

## sample

```
// クリーニング店があったとして、この店にはこの機能があるはず → メニュー表になるようなもの
public interface CleaningService {
  Shirt washShirt(Shirt s);
  Towl washTowl(Towl t);
  Coat washCoat(Coat c);
}

// 実装
public class SendaiCleaningService implements CleaningService {
  private String ownerName;
  private String address;
  private String phone;
  // オーバーライド
  public Shirt washShirt(Shirt s) {...};
  public Towl washTowl(Towl t) {...};
  public Coat washCoat(Coat c) {...};
}
```

## 利点

* 同じインターフェースを実装した複数の子クラスは、「共通のメソッド群を強制的に保有する」

## なぜインターフェース？

* Javaは多重継承禁止だから使う必要がある
* インターフェースなら多重継承ができる



多重継承
==============================

親クラスをたくさん継承すること
** javaで禁止されている

## クラスの場合

```
|
| Wizardクラス
|   attack()
|   '杖でなぐる'
|
| Heroクラス
|   attack()
|   '剣で切る'
|
| WizardHeroクラスで同じ名前のattack()があるとどっちを採用していいかわからなくなる
| 「メソッドの衝突」
| 矛盾した複数の実装が衝突 現実世界ではありえない
|
```

↓ しかし

* インターフェースは多重継承OK
* メソッドの衝突を回避

## インターフェースの場合

```
|
| interfaceA   interfaceB
|   attack()     attack()  ← どちらも必ず抽象メソッドなので衝突が起こらない（中身何も書いていないから衝突しない。なので、多重継承していいでしょ）
|
```

```
public class WizardHero implements (innterface A), (innterface B), ... {
  // 複数のインターフェースを実装
}

public interface MageHero implements Mage, Hero {
  ...
}

public interface MageHero extends Hero {
  ...
}
```



## 呼び方の違い ☆☆☆

```
          継承
クラス ------> クラス 「extends」

          継承
インターフェース ------> インターフェース 「extends」

          実装
インターフェース ------> クラス 「implements」
```

* 普通のクラス - 具象クラス
* 同種は継承、異種は実装
* クラス --> インターフェース はあり得ない



多態性（ポリモーフィズム）
==============================

## カプセル化

private, public

## 継承

extends, implements

## ポリモーフィズム

* あえてざっくり捉える（同一視）
* 統一的にいろんなものを扱える
* Car, AirPlane, Bike 全部違うけどざっくり見ると乗り物じゃない？

## メソッドの呼び出し方

* 呼び出しの可否： 箱の形で決まる
* 呼び出すメソッド（内容）： インスタンス（中身）の型で決まる

## 継承していない型には代入できない

* 子クラスのインスタンスを親クラスの箱に代入に限る
* javaは継承関係の有無で代入できるか判断している

## ダウンキャスト

* javaはざっくりと捉えたらそのまましか判断しない
* 失敗する可能性のある代入はしてくれない<br>
↓ 無理やり教える<br>
あいまいな型に入っている中身を厳密な型に代入するときのキャスト

** 危険！失敗することもある

## ClassCastException

* 代入が「嘘の構図」になったという例外

```
if (i instanceof Guitar) {
  Guitar g = (Guitar)i;
  ghayabiki();
}
```

## 多様性のキモの部分

* 適当な指示にそれぞれが適切な振る舞いをする



Objectクラス
==============================

## すべてのクラスで利用できるメソッド

* toString()

## すべてのクラスの祖先 java.lang.Object

## 暗黙の継承

* あらゆるクラスは、"特に指定しなければ"java.lang.Objectを継承する
* あらゆるクラスはjava.lang.Objectの子クラスである
** 正しくはpublic class Empty extends Object { }

## デフォルト文字列表現

* Empty@3567a5cc (固有番号)
* Dateクラス.toString -> きれいな文字列になっている<br> -> オーバーライドされているから

## System.out.println(d); の正体

* ()の中のtoStringを表示せよ、というもの
* どんなインスタンス投げても大丈夫



equals()メソッド
==============================

Objectクラスでは、equals()メソッドも定義されている

## 比較の方法

* == 「等値」
* equals 「等価」

## 等値

* アドレス（場所）ごと同じ
* "同じ"の基準 → 場合によって違う → equalsのオーバーライドで決めろ
* 何をもって「意味的に同じ」とみなすのか？ 一律には決められない<br>
→ 適切な形でequals()をオーバーライドする必要がある
* toString()とequals()のオーバーライド<br>
新しくクラスを開発したときは、toString()とequals()のオーバーライドが必要かどうか考える



こんなことをする理由
==============================

## ポリモーフィズム

* あらゆるクラス -> Objectクラスの子クラス
* void ... (Object o)<br>あらゆる引数を受け取れる

(ex)<br>
System.out.println(Object o) // なんでもいいから受け取れ<br>
↓<br>
O.toString() // 必ずtoStringが定義されている<br>
↓<br>
画面表示せよ

## 比較くらいできた方がいい


## 結論

Javaでは"親無しクラス"は定義できない



クラス
==============================

概要
==============================

* 分業のしやすさ
* メソッドの分割にも限界がある
* クラス名とソースファイル名は必ず同じにする
* メソッドの呼び出しにはクラスを明示しないとダメ

```
@ Calc.java

package calcapp.main;
public class Calc {
  public static void main(String[] args) {
    int a = 10, b = 12;
    int total = calcapp.logics.CalcLogic.add(a, b);
    int product = calcapp.logics.CalcLogic.prod(a, b);
    System.out.println(total);
    System.out.println(product);
  }
}
```

```
@ CalcLogic.java

package calcapp.logics;
public class CalcLogic {
  public static int add(int a, int b) {
    return a + b;
  }
  public static int prod(int a, int b) {
    return a * b;
  }
}
```



パッケージ
==============================

* クラスの集まり
* クラスはメソッドの集まり
* デフォルトパッケージ（パッケージ無しに属している）

## FQCN

パッケージ名.クラス名.メソッド名(); と書いてあげないとわからない<br>
↓<br>
FQCNを省略する

``` import パッケージ名.クラス名; ```


## API (application programming intarface)

### java.lang

特に重要なクラス群(書かなくても最初からインポートされている。暗黙のimport)

### java.util

便利にするクラス群

### java.math

数学に関するクラス群

### java.net

ネットワーク通信を行うクラス群

### java.io

ファイルの読み書きなどデータの処理をするクラス群

### 何も書かなくても以下は読み込まれている


```
import java.lang.*;
```

### System.out.println(); など


* 大文字から書かれているのはクラス名
* パッケージ名が省略されている
* 本当は、java.lang.System.out.println();

```
java.lang.Object.toString()
<------->　<----> <------->
package   class   method
<------------->
FQCN

```



例外処理
==============================

## ３つの不具合

* 文法エラー syntax error<br>
  書き間違いなど<br>
  -> 修正する

* 実行時エラー runtime error<br>
  ファイル検索してるけど無いぞなど<br>
  -> ユーザーのミスなどは予防しきれない...

* 論理エラー logic errors<br>
  そもそも考え方間違ってるぞなど<br>
  -> コードを書き直す

* 実行時エラーは対処が難しい<br>
あらかじめセーフティネットを用意しなければならない

```
try {
  通常実行される文
} catch(IOException e) {
  例外発生時の文
}
```



例外クラス
==============================

## Error系例外

* catchする必要がない

## Exception系例外（想定しておくべき状況）

* catchすべき
* try-catchが書かれていないとコンパイルエラーになる
* チェック例外と呼ばれる

## RuntimeException系例外

* きりないからcatchしなくてもよい 任意



例外の調べ方
==============================

APIリファレンス参照



例外インスタンス
==============================

## (IOException e)

* e ... どういう例外が発生したか情報が全部入る
* eから詳細を取り出して、適切なエラー処理を行える

## 例外インスタンスの利用

* String getMessage() ... エラーメッセージを取得
* void printStackTrace() ... スタックトレース(エラーの詳細)を表示

```
try {
  // 通常の処理
} catch(IOException e) {
  System.out.println(e.getMessage());
  e.printStackTrace();
}
```

```
try {
  本来の処理
} catch (例外クラス 変数名) {
  例外処理
}
```



例外の伝播
==============================

* main でも処理されなかったら「異常終了」する
* Exception系 何も書かなかったら伝播は起こらない
* 伝播させたい場合は、スロー宣言(throw declaration)を行う
** スロー宣言は例外を「投げる」だけなので、強制終了などをさせることはできない

```
public static void subsub() throws IOException {
  FileWriter fw = new FileWriter("data.txt");
}
// 本来はtry-catchしないとダメだけど、この例外はお任せしてぶん投げちゃう
// 呼び出し元が処理するので大丈夫ですよ
```



例外を発生させる
==============================

## throw 例外インスタンス

** スロー宣言throwsとは全く別物

変な値が入力されたとき「はい、例外ですよ」

```
throw new IllegalArgumentException("aaaaa");
```



Java標準クラス（API）
==============================


## Java標準クラス 日付

* long型 と Date型インスタンス
* エポックからの経過ミリ秒で日時情報で表すことができる

### メリット

シンプルでわかりやすい

### デメリット

* 人間は数字を見ただけではなんだかわからない
* long値は日時以外にも使うので、日時かどうかわからない

### 相互変換

* 人間が読みやすい<br>
  String型で 「2017年10月18日 11時50分50秒」
* 人間が入力しやすい<br>
  int型 6つ 年月日時分秒
  - コンピュータがわかりやすい long型
  - Date型で相互変換
  - 人間が入力しやすい int型
  - 人間がわかりやすい String型



Web Application
==============================

動的Webプロジェクトの作り方
==============================

* eclipseの右上(パースペクティブ)で「Java EE」を選択
* 「Project Exploer」右クリック
* 「New」「Dynamic Web Project」
* 「Project name」
* 「Target runtime」->「Apache」「Apache Tomcat vx.x」を選択



ファイル作成
==============================

## HTMLファイル

* プロジェクトを右クリック
* New > HTML File > finish
* Web Content ディレクトリにファイルが作成される
* ファイルを右クリック > 実行 > Run On Server > finish

## JSPファイル

* プロジェクトを右クリック
* New > JSP File > finish
* Web Content ディレクトリにファイルが作成される
* ファイルを右クリック > 実行 > Run On Server > finish

** 起動したサーバはこまめに止めておく



JSPファイルの仕組み
==============================

## JSPとは

### Java Server Pages

* 画面表示とJavaの処理(HTMLとJavaが一緒になった技術)
* 画面(HTML)とサーバ(Java)の橋渡し役

### メリットでありデメリット

HTML内にJavaを書くことができる

```java
<%@ page language="java" contentType="text/html; charset=UTF-8"%>
<!DOCTYPE html>
<html>
<head>
  <title>JSP</title>
</head>
<body>
  <%-- コメント --%>
  <% for(int i = 0; i < 5; i++) {  %>
  <p>test JSP</p>
  <% } %>
</body>
</html>
```

** JSPファイルは、画面表示に関する最低限の記載にした方が管理しやすい

### 流れ

* リクエスト
* Javaファイルに変換
* コンパイル
* Javaの処理
* HTML作成
* レスポンス



JSPとJavaの処理を組み合わせる
==============================

```
<%@ page language="java" contentType="text/html; charset=UTF-8"%>
<%@ page import="java.util.ArrayList"%>
<!DOCTYPE html>
<html>
<head>
  <title>JSP</title>
</head>
<body>
  <% ArrayList<String> list = new ArrayList<String>(); %>
  <% list.add("Hello "); %>
  <% list.add("JSP "); %>
  <% list.add("!!"); %>
  <% for(int i = 0; i < list.size(); i++) {  %>
    <%= list.get(i) %>
  <% } %>
</body>
</html>
```



Tips
==============================

## 色々な出力

```
public class Main {
  public static void main(String[] args) {

    // # エスケープシーケンス
    System.out.println("ABC\nDEF\nGHI");
    // # タブ
    System.out.println("1\t2\t3");
    // # 8進数
    System.out.println(06);
    System.out.println(024);
    System.out.println(015);
    // # 16進数
    System.out.println(0x6);
    System.out.println(0x14);
    System.out.println(0xd);

    // # 変数の初期化
    int a = 3;
    int b = 5;
    int c = a * b;
    System.out.println(c);

    // # キャスト
    System.out.println("3.14をint型にキャスト: " + (int)3.14);

  }
}
```


## ユーザー入力

```
public class Main {
  public static void main(String[] args) throws IOException {

    // Scanner
    System.out.println("Enter number");
    int n = new java.util.Scanner(System.in).nextInt();
    System.out.println("You entered " + n);

    System.out.println("Enter string");
    String str = new java.util.Scanner(System.in).nextLine();
    System.out.println("You entered " + str);

    System.out.println("円周率の値はいくつ？");
    double d = new java.util.Scanner(System.in).nextDouble();
    System.out.println("円周率の値は" + d + "です");

    // BufferedReader
    System.out.println("Enter something");
    BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
    String strbr = br.readLine();
    System.out.println(strbr);

  }
}
```


## 加減乗除

```
public class Main {
  public static void main(String[] args) {

    System.out.println("2つの整数を入力してください");
    int num1 = new java.util.Scanner(System.in).nextInt();
    int num2 = new java.util.Scanner(System.in).nextInt();
    int result;

    result = num1 + num2;
    System.out.println("和: " + result);
    result = num1 - num2;
    System.out.println("差: " + result);
    result = num1 * num2;
    System.out.println("積: " + result);
    result = num1 / num2;
    System.out.println("商: " + result);
    result = num1 % num2;
    System.out.println("剰余: " + result);

    System.out.println("名字を入力してください");
    String name1 = new java.util.Scanner(System.in).nextLine();
    System.out.println("名前を入力してください");
    String name2 = new java.util.Scanner(System.in).nextLine();
    String fullname = name1 + name2;
    System.out.println(fullname);

  }
}
```
