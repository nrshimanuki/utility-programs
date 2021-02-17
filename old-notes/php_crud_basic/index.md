CRUD system basic
==============================

## 作成の流れ

* データベース作成
* テーブル作成
* データベース接続
* よく使う機能を別ファイルにまとめる
* 共通で読み込む設定
* データの登録
* データの表示
* データの編集
* データの削除



## データベース作成

```
CREATE DATABASE db_name DEFAULT CHARACTER SET utf8;
USE db_name;
```



## テーブル作成

```
CREATE TABLE tbl_name(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  created DATETIME NOT NULL,
  modified TIMESTAMP NOT NULL
);
```



## データベース接続

### mysqliを使う場合

```php
@ database_connect.php

$database = mysqli_connect('host_name', 'user_name', 'password', 'db_name') or die (mysqli_connect_error());
mysqli_set_charset($database, 'utf8');
```



## よく使う機能を別ファイルにまとめる

### サニタイズ

```php
@ functions.php

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
```



## 共通で読み込む設定

```php
session_start();
require_once ('databese_connect.php');
require_once ('functions.php');
```



## データの登録

### 登録画面

```php
@ input.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>INPUT</title>
</head>
<body>
  <h1>INPUT</h1>
  <form action="input_do.php" method="post">
    <label>Name: <input type="text" name="name"></label>
    <label>Mail: <input type="email" name="email"></label>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
```

### 登録実行

```php
@ input_do.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('INSERT INTO tbl_name SET name = "%s", email = "%s", created = "%s"',
  mysqli_real_escape_string($database, $_POST['name']),
  mysqli_real_escape_string($database, $_POST['email']),
  date('Y-m-d H:i:s')
);
mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>DO INPUT</title>
</head>
<body>
  <h1>DO INPUT</h1>
  <p>Finished!!</p>
  <a href="index.php">Top</a>
</body>
</html>
```



## データの表示

### 一覧画面

```php
@ index.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('SELECT * FROM tbl_name');
$recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>INDEX</title>
</head>
<body>
  <h1>INDEX</h1>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Mail</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($record = mysqli_fetch_assoc($recordSet)): ?>
      <tr>
        <td><?= h($record['name']); ?></td>
        <td><?= h($record['email']); ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
```



## データの編集

```php
@ index.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('SELECT * FROM tbl_name');
$recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>INDEX</title>
</head>
<body>
  <h1>INDEX</h1>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Mail</th>
        <th>Edit, Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($record = mysqli_fetch_assoc($recordSet)): ?>
      <tr>
        <td><?= h($record['name']); ?></td>
        <td><?= h($record['email']); ?></td>
        <td>
          <button type="button">
            <a href="update.php?id=<?= h($record['id']); ?>">Edit</a>
          </button>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
```

```php
@ update.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('SELECT * FROM tbl_name WHERE id = %d',
  mysqli_real_escape_string($database, $_REQUEST['id'])
);
$recordSet = mysqli_query($database, $sql);
$record = mysqli_fetch_assoc($recordSet);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>UPDATE</title>
</head>
<body>
  <h1>UPDATE</h1>
  <form action="update_do.php" method="post">
    <label>Name: <input type="text" name="name" value="<?= h($record['name']); ?>"></label>
    <label>Mail: <input type="email" name="email" value="<?= h($record['email']); ?>"></label>
    <input type="submit" value="Edit">
    <input type="hidden" name="id" value="<?= h($record['id']); ?>">
  </form>
</body>
</html>
```

```php
@ update_do.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('UPDATE tbl_name SET name = "%s", email = "%s" WHERE id = %d',
  mysqli_real_escape_string($database, $_POST['name']),
  mysqli_real_escape_string($database, $_POST['email']),
  mysqli_real_escape_string($database, $_POST['id'])
);
mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>DO UPDATE</title>
</head>
<body>
  <h1>DO UPDATE</h1>
  <p>Finished!!</p>
  <a href="index.php">Top</a>
</body>
</html>
```



## データの削除

```php
@ index.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('SELECT * FROM tbl_name');
$recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>INDEX</title>
</head>
<body>
  <h1>INDEX</h1>
  <button type="button"><a href="input.php">Input</a></button>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Mail</th>
        <th>Edit, Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($record = mysqli_fetch_assoc($recordSet)): ?>
      <tr>
        <td><?= h($record['name']); ?></td>
        <td><?= h($record['email']); ?></td>
        <td>
          <button type="button">
            <a href="update.php?id=<?= h($record['id']); ?>">Edit</a>
          </button>
          <button type="button">
            <a class="deleteBtn" href="delete.php?id=<?= h($record['id']); ?>" data-id="<?= h($record['id']); ?>">Delete</a>
          </button>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<script>
deleteBtn = document.getElementsByClassName('deleteBtn');
for (var $i = 0; $i < deleteBtn.length; $i++) {
  deleteBtn[$i].onclick = function(e) {
    e.preventDefault();
    var yn = confirm('削除してよろしいですか？');
    if (yn == true) {
      window.location.href = 'delete.php?id=' + this.getAttribute('data-id');
    }
  }
}
</script>
</body>
</html>
```

```php
@ delete.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$sql = sprintf('DELETE FROM tbl_name WHERE id = %d',
  mysqli_real_escape_string($database, $_REQUEST['id'])
);
$recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>DELETE</title>
</head>
<body>
  <h1>DELETE</h1>
  <p>Finished!!</p>
  <a href="index.php">Top</a>
</body>
</html>
```
