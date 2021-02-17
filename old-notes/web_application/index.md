Web application 環境構築手順
==============================

## 仮想環境 (VirtualBox or VMwarePlayer)

### CentOS

* ユーザ作成
  - root : root
  - user_name : password

### ネットワーク設定

```
nmtui
Edit a connection
Automatically connect: ON
systemctl restart NetworkManager.service
systemctl restart network.service
```

### yum

#### プロキシ経由でアクセスの場合、プロキシ情報を追加

```
/etc/yum.conf
  proxy=http://172.25.xxx.xx:80/
```

#### アップデート

```
yum -y update
```

### SELinux停止

```
su
set enforce 0
vi /etc/sysconfig/selinux
  SELINUX=enforcing -> SELINUX=disabled に変更
```

### 必要パッケージインストール

```
sudo yum install httpd mod_php
sudo yum install unzip
sudo yum install mariadb mariadb-server
sudo yum install php-mbstring
sudo yum install php-mysql
```

### httpによるアクセスを許可

```
sudo firewall-cmd --add-service=http --permanent
sudo firewall-cmd --add-service=http
```

### サービスの自動起動設定

```
sudo systemctl enable httpd
sudo systemctl enable mariadb
```

### mariadbの初期化

```
sudo mysql_secure_installation
```

rootのパスワードを設定し、それ以外はデフォルト



## データベース

### データベースにログイン

```
mysql -u root -p
```

### 日本語設定

```
SHOW VARIABLES LIKE 'char%';
```

```
vi /etc/my.cnf
  ( [mysqld_safe]の上に追加 )
  character-set-server=utf8
  skip-character-set-client-handshake
```

```
vi /etc/my.cnf.d/client.cnf
  ( 最後の行に追加 )
  default-character-set=utf8
```

```
systemctl restart mariadb.service
```

### ユーザ管理

#### ユーザ登録

```
CREATE USER 'xxxx'@'localhost' IDENTIFIED BY 'xxxx';
```

#### 権限設定

```
GRANT ALL ON xxxx.* TO 'xxxx'@'localhost';
```

#### 登録ユーザの確認

```
SELECT User, Host FROM mysql.user;
```

#### パスワード設定

```
SET PASSWORD FOR xxxx=PASSWORD('xxxx');
```

### データベース作成

```
CREATE DATABASE db_name DEFAULT CHARACTER SET utf8;
SHOW DATABASES;
USE db_name;
```

### テーブル作成

```
CREATE TABLE tbl_name(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(256) NOT NULL
  created DATETIME NOT NULL,
  modified TIMESTAMP NOT NULL
);
```

### データ登録

```
INSERT INTO (,,,) VALUES(,,,);
```

### データ取り出し

```
SELECT column_name FROM table_name;
```

### データ編集

```
UPDATE table_name SET column_name="..." WHERE id = 1;
```

### (データ削除)



## PHPアプリケーション

### HTML作成

* 画面を作る

### サーバ側設定

#### サイトルートの権限

* 所有者:グループ 変更
* 書き込み権限を付ける

```
cd /var/www/html
chown -R xxxx:xxxx html
```

### 表示確認

* サーバにファイルをアップロードして、表示できるか確認

### データベース接続

```
$db = mysqli_connect('localhost', 'xxxx', 'xxxx', 'xxxx') or die (mysqli_connect_error());
mysqli_set_charset($db, 'utf8');
```

### データベース接続エラー

#### SELinuxを疑う

```
sudo getsebool httpd_can_network_connect
  OFFなら無効
sudo setsebool -P httpd_can_network_connect 1
  ONになる
```

#### 他の確認事項

* ターミナルからコマンドで mysqli_connect と同じことをしてみる

```
mysql -h 192.168.xxx.xxx -u xxxx -p xxxx

↓ error
Access denied for user 'xxxx'@'192.168.xxx.xxx' (using password: YES)
  そのホストのパスワードだとダメだよ。
```

#### 権限を見てみる

```
SHOW GRANTS FOR xxxx;
SHOW GRANTS FOR 'xxxx'@'localhost';

↓
GRANT USAGE ON *.* TO 'xxxx'@'localhost' IDENTIFIED BY PASSWORD 'xxxxxx'
  @localhost に xxxxxx がパスワードとして設定されていることがわかる

↓
mysql -h localhost -u xxxx -p xxxx
  にすれば接続できるってことじゃない？
```

### 仮想環境のブラウザ以外だと表示されない

#### 確認事項

* 指定したIPで、インターネットを見に行ってしまっていないか。
* ブラウザからプロキシの設定を確認<br>
  - 接続 > LANの設定 > プロキシサーバ 詳細設定 > 例外

```
192.168.37.*;
*.example.com;
192.168.248.*
 など追加
```

#### VMware

* Player > 管理 > 仮想マシン設定 > ネットワークアダプタ
* コントロール パネル\ネットワークとインターネット\ネットワーク接続

### 投稿を記録

```
$sql = sprintf(
  'INSERT INTO tbl_name SET name = "%s", category = "%s";',
  mysqli_real_escape_string($db, $Name),
  mysqli_real_escape_string($db, $lcategory)
);
mysqli_query($db, $sql) or die(mysqli_error($db));
```
