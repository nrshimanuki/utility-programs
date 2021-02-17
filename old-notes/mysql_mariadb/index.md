MySQL, MariaDB
==============================

## TOPICS

* SQLの単語は大文字で書くのが通例



環境構築
==============================

## インストール


## 起動設定


## 初期設定


## ファイアウォール


## データベース接続

```
$ mysql [-h host] [-u user_name] [-p] [db_name]
```

## ログアウト

```
quit
exit
```

## パスワード変更


## 日本語対応



基本操作
==============================

## データベースの情報表示

```
\s
```

## オブジェクト表示

```
SHOW DATABASES;
SHOW TABLES;
SHOW COLUMNS FROM tbl_name;
DESCRIBE tbl_name;
DESC tbl_name;
```

## データベース切り替え

```
USE db_name;
```


データベースオブジェクト
==============================

## データベースオブジェクト定義

```
CREATE DATABASE db_name;
```

## データベースオブジェクト削除

```
DROP DATABASE db_name;
```

## データベースオブジェクト変更

```
ALTER DATABASE db_name
```


テーブルオブジェクト
==============================

## テーブル定義 / テーブル作成

```
CREATE TABLE db_name (
  col_name data_type,
  col_name data_type
);
```

```
CREATE TABLE section (
  id INT NOT NULL PRIMARY KEY,
  name VARCHAR(256) NOT NULL,
  upd_dt DATETIME NOT NULL
);
```

```
CREATE TABLE section (
  id CHAR(6) NOT NULL,
  name VARCHAR(256) NOT NULL,
  section_id INT(11) NOT NULL,
  commute FLOAT,
  upd_dt DATETIME NOT NULL,
  PRIMARY KEY(id)
);
```

## 列の追加

```
ALTER TABLE tbl_name ADD COLUMN col_name data_type;
```

## 列の変更

```
ALTER TABLE tbl_name CHANGE old_col_name new_col_name data_type;
```

## 列の定義変更

```
ALTER TABLE tbl_name modify col_name data_type;
```

## 列の削除

```
ALTER TABLE tbl_name DROP col_name;
```

## テーブル削除

```
DROP TABLE tbl_name;
```



データ操作
==============================

## データ追加

```
INSERT INTO tbl_name(col_name, col_name...) VALUES(value, value...);
INSERT INTO section(id, name, upd_dt) VALUES(10, '営業', NOW());
```

## データ更新

UPDATEはPrimaryKEYで指定するのがDB界の常識

```
UPDATE tbl_name SET col_name = value WHERE condition;
UPDATE employee SET name='鈴木一郎' WHERE id=102;
UPDATE rentals SET return_date = NULL WHERE return_date < '2017-01-01';
```

## レコード削除

```
DELETE FROM tbl_name WHERE condition;
DELETE FROM employee WHERE id=102;
```

## table_nameのデータを全て削除

```
DELETE FROM tbl_name;
```



ユーザー管理
==============================

## ユーザー登録

```
CREATE USER 'user_name'@'host_name' IDENTIFIED BY 'password';
CREATE USER test IDENTIFIED BY 'test';
```

## ユーザー確認

```
SELECT user, host FROM mysql.user;
```

## パスワード設定

```
SET PASSWORD=PASSWORD('password');
SET PASSWORD FOR user_name=PASSWORD('password');
```

## ユーザー名変更

```
RENAME USER old_user TO new_user;
```

## ユーザー削除

```
DROP USER user_name;
```

## 権限の確認

```
SHOW GRANTS FOR user_name;
// GRANT USAGE ON *.* TO user;
// CREATE USER文でユーザーを作成した直後はこの状態（何も権限無し）
```


## 権限の設定

```
GRANTS <権限> ON <レベル> TO user_name;
GRANTS ALL ON db_name.tbl_name TO user_name;
GRANTS ALL ON test.* TO 'test'@'%';
```

## 権限の設定(他のユーザー)

```
GRANTS <権限> ON <レベル> TO user_name WITH GRANT OPTION;
```

## 権限の削除

```
REVOKE <権限> ON <レベル> FROM user_name;
REVOKE DROP ON test.* FROM test;
```



データベース保守
==============================

## テーブルのエクスポート

* root権限
* タブ区切りで出力される

```
@ /var/lib/mysql/db_name/file_name

SELECT * FROM tbl_name INTO OUTFILE 'file_name';
SELECT * FROM test INTO OUTFILE 'test.csv';
```

## テーブルのインポート

```
@ /var/lib/mysql/db_name/file_name

LOAD DATA INFILE file_name INTO TABLE tbl_name;
LOAD DATA INFILE 'test.csv' INTO TABLE test;
```

## データベースのダンプ

```
$ mysqldump -u root -p db_name > file_name
$ mysqldump -u root -p test > test.dmp
```

## 全てのデータベースをダンプ

```
$ mysqldump -u root -p --all-databases > file_name
$ mysqldump -u root -p --all-databases > alldb20170830.dmp
```

## データベースのリストア

```
$ mysql -u root -p db_name < file_name
$ mysql -u root -p test < test.dmp
```

## 全てのデータベースをリストア

```
$ mysql -u root -p < file_name
```



レプリケーション
==============================

## ホスト名設定

```
nmcli g hostname "dbnmaster"
```

## TCP/3306によるアクセスを許可

```
firewall-cmd --add-service=mysql --permanent
```

## 設定ファイル

```
cd /etc/my.cfn.d
sudo vi replication.cnf

[mariadb]
log-bin
log-basename=master1
server_id=1

[mariadb]
server_id=2
```

## ユーザー作成

```
CREATE USER replication_user;
GRANT REPLICATION SLAVE ON *.* TO replication_user IDENTIFIED BY 'rep_pass';
```

## データベースを一時的にロック

```
FLUSH TABLES WITH READ LOCK;
SHOW MASTER STATUS;
mysqldump --all-databases -u root -p > alldb.dmp
UNLOCK TABLES;

mysql -u root -p < alldb.dmp
```



データベースの更新
==============================



整合性制約
==============================

## CREATE時に制約を設定

```
CREATE TABLE tbl_name(
  pk_col INT PRIMARY KEY,
  uni_col INT UNIQUE,
  nnull_col INT NOT NULL
);
```

## 別行に指定

```
CREATE TABLE tbl_name(
  pk_col1 INT,
  pk_col2 INT,
  fk_col INT,
  PRIMARY KEY(pk_col1, pk_col2),
  FOREIGN KEY(fk_col) REFERENCES p_tbl(p_pk)
);
```

## 後から制約を設定

```
ALTER TABLE tbl_name MODIFY nnull_col INT NOT NULL;
ALTER TABLE tbl_name ADD UNIQUE KEY(uni_col);
ALTER TABLE tbl_name ADD PRIMARY KEY(pk_col1, pk_col2);
ALTER TABLE tbl_name ADD FOREIGN KEY(fk_col) REFERENCES p_tbl(p_pk);
```
