Strutsの概要
==============================

## Struts1

* JavaWebアプリ構築の一時代を築いたフレームワーク
* MVCモデル
* デファクトスタンダード
* 2013年にサポート終了している
* JSP, Servletをより使いやすくしている
* 設定ファイル重視
* 明確な役割分担


## Struts1の仕組み

### 流れ
1. ActionFormクラスの作成
2. Actionクラスの作成
3. JSPの作成
4. web.xmlの作成
5. struts-config.xmlの作成


## Struts2

* Struts1からガラっと変わった
* セキュリティ弱いけど、多く使われている
* 設定より規約
* 設定ファイル不要
* Plain Old Java Object(POJO)
  普通のJavaプログラムを書いて動作させられる


## Struts2の仕組み

### 流れ
1. Actionクラスの作成
2. JSPの作成
3. web.xmlの作成
4. struts.xmlの作成


## DIとAOP

### オブジェクト指向プログラミングの課題

* プログラムが複雑になってしまうなどの、開発時の課題
* システムの拡張・連携・障害対応などの、保守・運用時の課題

### DIとAOPとは

* オブジェクト指向では手の届かなかった部分を補うもの

### DI(依存性の注入)

* インスタンスを自動的に作ってくれるもの

### AOP(アスペクト指向プログラミング)

* 共通処理を一括して請け負ってくれる存在



Struts2
==============================

## 事前準備

### Struts2のライブラリ ダウンロード

* <a href="http://struts.apache.org/download.cgi" target="_blank">http://struts.apache.org/download.cgi</a>
* DownloadからFull Distributionを選択
* 「lib」ディレクトリに入っている
* ライブラリはjarファイルとして提供されている<br>
  Javaプログラム(classファイル)や設定ファイルなどがひとまとめになっているもので、拡張子をzipにすると中身が見れる

#### 推奨環境

* Eclipse 4.4 以上
* Apache Tomcat 7 以上

### Java
### Eclipse
### Tomcat

* [Development Environment](https://nrshimanuki.github.io/tech/java/development_environment)

### Eclipseにライブラリをコピー
### ビルドパスを設定する

* 「Project Exploer」右クリック
* 「New」「Dynamic Web Project」
* 「Project name」
* 「Target runtime」
  「Apache」「Apache Tomcat vx.x」を選択
* 「WebContent」「WEB-INF」「lib」フォルダにjarファイルをコピー
  - asm-3.3
  - asm-commons-3.3
  - asm-tree-3.3
  - commons-fileupload-1.3.1
  - commons-io-2.2
  - commons-lang3-3.2
  - freemarker-2.3.22
  - javassist-3.11..GA
  - ognl-3.0.6
  - struts2-convention-plugin-2.3.24.1
  - struts2-core-2.3.24.1
  - xwork-core-2.3.24.1
* プロジェクト右クリック「property」
* 「Java Build Path」「libraries」「Add JARs」
* 「WebContent」「WEB-INF」「lib」jarファイルを選択


## 動作確認

* Actionクラス「struts2.sample」というパッケージを作成してIndexAction.javaを配置
* WebContentの直下にindex.jspを配置
* WebContent - WEB-INFの中にweb.xmlを配置
* srcの中にstruts.xmlを配置
* Eclipseの「サーバー」ビューに表示されているサーバ名を選択して、右クリックの「開始」で起動
* ブラウザで「http://localhost:8080/project_name/index.action」にアクセス
