CentOS
==============================

## ダウンロード

* <a href="https://www.centos.org/download/" target="_blank">https://www.centos.org/download/</a>
(isoファイル)

### DVD ISO
CentOSのGUIインストーラでインストールできる全パッケージが最初から含まれているディスクイメージ。

### Everything ISO
CentOSで利用できる全パッケージが最初から含まれているディスクイメージ。
GUIインストーラでインストールできるもの以外のパッケージもすべて入っている。

### Minimal ISO
必要最低限のパッケージだけが含まれているディスクイメージ。
CentOSをインストールし終わったあとに、"yum install ○○"等であとから自分で必要なパッケージを揃える。



## ログインと設定

### rootでログイン

#### 直接ログイン
インストール時に設定したパスワード

### SSH ログイン

#### ターミナルからログイン

```
ssh user@192.168.xx.xx
```

### ネットワーク設定

```
// centos7
su
ip a
nmtui
Edit a connection
Automatically connect: ON
systemctl restart NetworkManager.service
systemctl restart network.service
ping yahoo.co.jp

// centos6
ifconfig
vi /etc/sysconfig/network-scripts/ifcfg-eth0
  ONBOOT=no -> ONBOOT=yes に変更
service network restart
```



## キーボード変更

### ロケール状態の確認

```
localectl
```

### ロケールを日本語に設定

```
localectl set-locale LANG=○○○○
localectl set-locale LANG=ja_JP.utf8
```

### キーボードの設定

```
localectl set-keymap ○○○○
localectl set-keymap jp106
localectl set-keymap us
```



## 解像度変更



## yum

### プロキシ経由でアクセス

#### /etc/yum.conf にプロキシ情報を追加

```
proxy=http://172.25.xxx.xx:80/
```

### アップデート

```
yum -y update
```



## SELinux

* アクセス制御を行うことでセキュリティを強化する

### 停止

```
su
set enforce 0
vi /etc/sysconfig/selinux
  SELINUX=enforcing -> SELINUX=disabled に変更
```



## iptables

* ファイアウォール機能を提供している

```
service iptables stop
chkconfig iptables off
chkconfig
```



## リポジトリの追加

```
rpm -ivh http://ftp-srv2.kddilabs.jp/Linux/distributions/fedora/epel/6/x86_64/epel-release-6-8.noarch.rpm

rpm -ivh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
```



## Apache

```
yum install --enablerepo=remi httpd
```



## MySQL

```
yum install --enablerepo=remi mysql-server
```



## PHP

```
// php5.4
yum install --enablerepo=remi php54-php php54-php-devel php54-php-pear php54-phpmbstring php54-php-gb php54-php-mysql
```



## 起動

### Apache

```
service httpd start
chkconfig httpd on
```

### MySQL

```
service mysqld start
chkconfig mysqld on
```



## 動作確認

### Apache

* ブラウザでサーバーにアクセスして、テストページが出るか確認

### PHP

```
cd /var/www/html
```

```
@vi test.php

<?php phpinfo();
```

test.phpにアクセス



## コマンド

ctrl + b 後１文字移動(Altで単語単位)
ctrl + f 前１文字移動(Altで単語単位)
ctrl + a 行頭へ移動
ctrl + e 行末へ移動
ctrl + h backspace
ctrl + w 単語削除
ctrl + k 行末まで削除
ctrl + u 行頭まで削除
ctrl + y 最後に削除した内容を挿入

ctrl + p 履歴呼び出し
ctrl + n 履歴遡り
ctrl + r 履歴を検索


### ファイルを探す

find -name '○○.*'
-nameを使うときは「'」を必ずつける


### 画面ロック

ctrl + s ロック
ctrl + q 解除


### 強制終了

ctrl + c



Web Server
==============================

## Apache

### 入っているか確認

```
yum list | grep httpd
```

### インストール

```
yum install httpd
```

### Firewall

```
firewall-cmd --list-services [--permanent]
firewall-cmd --add-service http --permanent
firewall-cmd --reload
```

### ステータス確認

```
systemctl status httpd
```

### 起動

```
systemctl start httpd
```

### 再起動

```
systemctl restart httpd
```

### 停止

```
systemctl stop httpd
```

### 設定反映

```
systemctl reload httpd
```

### 自動起動の有効化

```
systemctl enable httpd
```

### 自動起動の無効化

```
systemctl disable httpd
```

### 自動起動の状態表示

```
systemctl is-enabled httpd
```

### アクティブか確認

```
systemctl is-active httpd
```

### 稼働中サービス一覧

```
systemctl --type service
```

### インストール済みサービス一覧

```
systemctl --list-unit-files --type service
```

### 起動失敗のユニット

```
systemctl --failed
```

### 起動しているユニット

```
systemctl
```

### 全ての状態表示

```
systemctl -all
```

### 設定ファイル

```
@ /etc/httpd/conf/httpd.conf

systemctl restart httpd
```

### デフォルトドキュメントルート

/var/www/html



## PHP

### default timezone

date.timezone = "Asia/Tokyo" になっていないとDatePeriodなどの関数が使えない




DNS Server
==============================

## DNSキャッシュサーバー Unbound

### インストール
yum install unbound

### Firewall

### 設定ファイル
/etc/unbound/unbound.conf

### 起動
systemctl start unbound


## DNSコンテンツサーバー Bind

### インストール
yum install bind

### Firewall

### 設定ファイル
/etc/named.conf

### 起動
systemctl start named



Mail Server
==============================

## Postfix

### 設定ファイル
/etc/postfix/main.cf


## 受信サーバー Dovecot

### インストール
yum install dovecot

### 設定ファイル
/etc/dovecot/dovecot.conf
/etc/dovecot/conf.d/



FTP Server
==============================

## FTPクライアント

### インストール
yum install ftp

### Firewall
firewall-cmd --add-service ftp --permanent
firewall-cmd --reload

### 起動
systemctl start ftp


## vsftp

### インストール
yum install vsftp

### 起動
systemctl start vsftp
