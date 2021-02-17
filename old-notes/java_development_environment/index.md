Java環境構築
==============================

* JDK, JRE
* Eclipse
* Database
* Tomcat


用語
==============================

## JDK

Java Development Kit

## JRE

Java Runtime Enviroment (実行環境)

## Java言語の開発環境

* SE: Standard Edition(標準)
* ME: 組込み系に特化
* EE: サーバーサイドに特化



JDK download
==============================

* <a href="http://www.oracle.com/technetwork/java/javase/downloads/index.html" target="_blank">http://www.oracle.com/technetwork/java/javase/downloads/index.html</a>
* JDK DOWNLOAD からダウンロード
* ライセンスの同意： Accept License Agreement
* 使っている環境に合うものを選択
* インストーラに従って進める
* (Windowsは環境変数の設定)

## Mac

* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/jdk_for_mac.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/jdk_for_mac.pdf</a>

## Windows

* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/jdk_for_win.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/jdk_for_win.pdf</a>



Java download
==============================

* <a href="https://java.com/ja/download/help/mac_install.xml" target="_blank">https://java.com/ja/download/help/mac_install.xml</a>

## Windows

* C:\Program Files\Java



動作確認
==============================

## バージョン確認

```
java -version
javac -version
```

## プログラムを実行

* テキストエディタにコードを入力
* ファイル名は、「クラス名.java」

```
@ Sample.java

class Sample {
  public static void main(String args[]) {
    System.out.println("Hello!!");
  }
}
```

```
// ターミナルからコンパイル
javac Sample.java

// インタプリタを起動して、プログラムを実行
java Sample
```



開発・実行環境について
==============================

* コンパイル済みのアプリケーション（クラスファイル）を実行するだけならJVM（Java仮想マシン）がインストールされていればよい
* 実際にインストールするパッケージとしては、JVMにクラスライブラリを加えたJREをダウンロードすることになる
* JDKはこのJREにコンパイラなどを加えたパッケージになり、JDKをインストールすると同時にJREもインストールされる



Eclipse
==============================

## Download

* <a href="https://www.eclipse.org/downloads/" target="_blank">https://www.eclipse.org/downloads/</a>
* <a href="https://www.eclipse.org/downloads/eclipse-packages/" target="_blank">https://www.eclipse.org/downloads/eclipse-packages/</a>
* 解凍フォルダごとデスクトップへ移動
* workspaceの場所を決める

### Mac
* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2934/eclipse%E5%B0%8E%E5%85%A5%E6%89%8B%E9%A0%86%E6%9B%B8%EF%BC%88Mac%EF%BC%89.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2934/eclipse%E5%B0%8E%E5%85%A5%E6%89%8B%E9%A0%86%E6%9B%B8%EF%BC%88Mac%EF%BC%89.pdf</a>

### Windows
* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/eclipse_for_win.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2700/eclipse_for_win.pdf</a>

### 日本語化プラグイン
* <a href="http://mergedoc.osdn.jp/" target="_blank">http://mergedoc.osdn.jp/</a>
* <a href="https://devnote.jp/pleiades/" target="_blank">https://devnote.jp/pleiades/</a>


## インストール

* C:\pleiades\eclipse\eclipse.exe
* ショートカット作成
* ワークスペース選択して起動


## 動作確認

* java project
* project name 入れて完了
* 右クリック > 新規 > クラス
* クラス名 を入れて完了




MySQL
==============================

## Download

### Mac

* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A0MySQL%E6%A7%8B%E7%AF%89%E6%89%8B%E9%A0%86%E6%9B%B8_Mac.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A0MySQL%E6%A7%8B%E7%AF%89%E6%89%8B%E9%A0%86%E6%9B%B8_Mac.pdf</a>

### Windows

* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A0MySQL%E6%A7%8B%E7%AF%89%E6%89%8B%E9%A0%86%E6%9B%B8_Win.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A0MySQL%E6%A7%8B%E7%AF%89%E6%89%8B%E9%A0%86%E6%9B%B8_Win.pdf</a>

```
ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
brew update
brew install mysql
mysql.server start
mysql_secure_installation
mysql -u root -p

// 停止するとき
mysql.server stop
```


## eclipseからMySQLに接続

* <a href="https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A1eclipse%E3%81%8B%E3%82%89%E3%81%AE%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9%E6%8E%A5%E7%B6%9A%E6%89%8B%E9%A0%86%E6%9B%B8.pdf" target="_blank">https://s3-ap-northeast-1.amazonaws.com/i.schoo/images/class/content/2943/%E2%91%A1eclipse%E3%81%8B%E3%82%89%E3%81%AE%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9%E6%8E%A5%E7%B6%9A%E6%89%8B%E9%A0%86%E6%9B%B8.pdf</a>

* <a href="https://dev.mysql.com/downloads/" target="_blank">https://dev.mysql.com/downloads/</a>



MariaDB
==============================

## Download

* <a href="https://mariadb.org/" target="_blank">https://mariadb.org/</a>
* <a href="https://downloads.mariadb.org/" target="_blank">https://downloads.mariadb.org/</a>
* mariadb-10.1.16-winx64.msi



## インストール

### インストーラを起動

順番に進んで、C:\Program Files\MariaDB 10.2　ができていればOK。



## MySQL Workbenchのダウンロード

### リンク

* <a href="https://dev.mysql.com/downloads/workbench" target="_blank">https://dev.mysql.com/downloads/workbench</a>
No thnaks からダウンロード

* mysql-installer-web-community-x.x.x.x.msi を実行


## MariaDB Connectorの入手

* <a href="https://downloads.mariadb.org/connector-java/" target="_blank">https://downloads.mariadb.org/connector-java/</a>
* MariaDB Connector/J .jar files


## 動作確認



Tomcat
==============================

## Download

* <a href="http://tomcat.apache.org/" target="_blank">http://tomcat.apache.org/</a>
* <a href="https://tomcat.apache.org/download-80.cgi" target="_blank">https://tomcat.apache.org/download-80.cgi</a>

### Mac
* tar.gz
* アプリケーション直下など

### Windows
* Windows Service Installer
* Cドライブ直下など



## Tomcat用の環境変数を設定

* システム > システムの詳細設定 > 環境変数
* JAVA_HOME を追加
* 変数値をJavaのインストールフォルダにする > C:\Program Files\Java\jdk1.8.0_131



## Tomcatの起動確認と停止

### 起動

#### Mac

##### ターミナルで実行
* tomcatのディレクトリ/bin/startup.sh
* tomcatのディレクトリ/bin/shutdown.sh

##### ブラウザでアクセス
* http://localhost:8080/

#### Windows
* C:\apache-tomcat-9.0.2-windows-x64\apache-tomcat-9.0.2\bin\startup.bat
* コマンドプロンプトが待機状態になれば正しく環境変数が設定されている。
* 設定が不足していると、コマンドプロンプトはすぐに閉じる。

* http://localhost:8080/ にアクセスしてページが表示されれば起動成功。
* http://localhost:8080/examples/
* http://localhost:8080/examples/servlets/
* http://localhost:8080/examples/jsp/

### 停止

* C:\apache-tomcat-9.0.2-windows-x64\apache-tomcat-9.0.2\bin\shutdown.bat
* コマンドプロンプトが閉じれば正しく停止している。



## Javaランタイムの設定

* ウィンドウ > 設定 > Java > インストール済みのJRE > 追加
* 標準VMを選択 > ディレクトリー > インストールしたJDKフォルダを指定 > 完了
* 追加した項目のチェックボックスをつけてOK



## Eclipseプロジェクト作成

### Serverプロジェクトの作成

* Eclipseからコンテナを参照する準備が必要。
* 新規 > その他 > サーバ > サーバ
* Tomcatサーバを選択



## 動的Webプロジェクトの作り方

* 「Project Exploer」右クリック
* 「New」「Dynamic Web Project」
* 「Project name」
* 「Target runtime」
  「Apache」「Apache Tomcat vx.x」を選択
