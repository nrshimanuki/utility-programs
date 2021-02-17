Login system
==============================

## データベース作成

```
CREATE DATABASE db_name DEFAULT CHARACTER SET utf8;
USE db_name;
```


## テーブル作成

```
CREATE TABLE tbl_login(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
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


## Join

```php
@ index.php

<?php
session_start();
require_once ('../database_connect.php');
require_once ('../functions.php');
if (!empty($_POST)) {
  if ($_POST['name'] == '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] == '') {
    $error['email'] = 'blank';
  }
  if (strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }
  if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  }
  if (empty($error)) {
    $sql = sprintf('SELECT COUNT(*) AS cnt FROM tbl_login WHERE email = "%s"',
      mysqli_real_escape_string($database, $_POST['email'])
    );
    $recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
    $record = mysqli_fetch_assoc($recordSet);
    if ($record['cnt'] > 0) {
      $error['email'] = 'duplicate';
    }
  }
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
    exit();
  }
}
if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['join'];
  $error['rewrite'] = true;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>JOIN</title>
</head>
<body>
  <h1>JOIN</h1>
  <form action="" method="post">
    <div>Name: <input type="text" name="name" value="<?php if(!empty($_POST['name'])) echo h($_POST['name']); ?>"></div>
    <?php if (!empty($error['name']) && $error['name'] == 'blank'): ?>
    <p>* Name can't be blank</p>
    <?php endif; ?>
    <div>Mail: <input type="email" name="email" value="<?php if(!empty($_POST['email'])) echo h($_POST['email']); ?>"></div>
    <?php if (!empty($error['email']) && $error['email'] == 'blank'): ?>
    <p>* Mail can't be blank</p>
    <?php endif; ?>
    <?php if (!empty($error['email']) and $error['email'] == 'duplicate') : ?>
    <p>* Duplicate</p>
    <?php endif; ?>
    <div>Password: <input type="password" name="password" value="<?php if(!empty($_POST['password'])) echo h($_POST['password']); ?>"></div>
    <?php if (!empty($error['password']) && $error['password'] == 'blank'): ?>
    <p>* Password can't be blank</p>
    <?php endif; ?>
    <?php if (!empty($error['password']) && $error['password'] == 'length'): ?>
    <p>* Too short</p>
    <?php endif; ?>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
```

```php
@ check.php

<?php
session_start();
require_once ('../database_connect.php');
require_once ('../functions.php');
if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}
if (!empty($_POST)) {
  $sql = sprintf('INSERT INTO tbl_login SET
    name = "%s",
    email = "%s",
    password = "%s",
    created = "%s"',
    mysqli_real_escape_string($database, $_SESSION['join']['name']),
    mysqli_real_escape_string($database, $_SESSION['join']['email']),
    mysqli_real_escape_string($database, sha1($_SESSION['join']['password'])),
    date('Y-m-d H:i:s')
  );
  mysqli_query($database, $sql) or die(mysqli_error($database));
  unset($_SESSION['join']);
  header('Location: thanks.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>CHECK</title>
</head>
<body>
  <h1>CHECK</h1>
  <form action="" method="post">
    <input type="hidden" name="action" value="submit">
    <div>Name: <?php echo h($_SESSION['join']['name']); ?></div>
    <div>Mail: <?php echo h($_SESSION['join']['email']); ?></div>
    <div>Password: ****</div>
    <button type="button"><a href="index.php?action=rewrite">Back</a></button>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
```

```php
@ thanks.php

<?php
session_start();
require_once ('../database_connect.php');
require_once ('../functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>THANKS</title>
</head>
<body>
  <h1>THANKS</h1>
  <button type="button"><a href="../">Login</a></button>
</body>
</html>
```


## index

```php
@ index.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
// ログイン中であれば（idがセッションにセットされていて、最後の処理から1時間いないならば）
// if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  // セッションに記憶されている最終処理時間を更新
  $_SESSION['time'] = time();
  // セッションに記憶しているidを利用して会員情報を得る
  $sql = sprintf(
    'SELECT * FROM tbl_login WHERE id = %d',
    mysqli_real_escape_string($database, $_SESSION['id'])
  );
  $recordSet = mysqli_query($database, $sql) or die(mysqli_error($database));
  $loginRecord = mysqli_fetch_assoc($recordSet);
} else {
  header('Location: login.php');
  exit();
}
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
  <button type="button"><a href="logout.php">Logout</a></button>
  <button type="button"><a href="input.php">Input</a></button>
  <h2>Hi, <?= h($loginRecord['name']); ?></h2>
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


## Login

```php
@ login.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
if (!empty($_COOKIE['email']) && $_COOKIE['email'] != '') {
  $_POST['email'] = $_COOKIE['email'];
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
}
if (!empty($_POST)) {
  if ($_POST['email'] != '' && $_POST['password'] != '') {
    $sql = sprintf('SELECT * FROM tbl_login WHERE email = "%s" AND password = "%s"',
      mysqli_real_escape_string($database, $_POST['email']),
      mysqli_real_escape_string($database, sha1($_POST['password']))
    );
    $recordSet = mysqli_query($database, $sql) or die (mysqli_error($database));
    if ($record = mysqli_fetch_assoc($recordSet)) {
      $_SESSION['id'] = $record['id'];
      // 現在時間を記憶して長時間ログインしてないか確認するために使う
      $_SESSION['time'] = time();
      // ログイン情報を記録する
      if ($_POST['save'] == 'on') {
        setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 14);
        setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 14);
      }
      header('Location: index.php');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>
</head>
<body>
  <h1>LOGIN</h1>
  <button type="button"><a href="join/">Sign up</a></button>
  <form action="" method="post">
    <div>Mail: <input type="email" name="email" value="<?php if(!empty($_POST['email'])) echo h($_POST['email']); ?>"></div>
    <?php if (!empty($error['login']) && $error['login'] == 'blank'): ?>
    <p>* Enter Mail and Password</p>
    <?php endif; ?>
    <?php if (!empty($error['login']) && $error['login'] == 'failed'): ?>
    <p>* Login failed</p>
    <?php endif; ?>
    <div>Password: <input type="password" name="password" value="<?php if(!empty($_POST['password'])) echo h($_POST['password']); ?>"></div>
    <div><label><input type="checkbox" name="save">Save cookie</label></div>
    <input type="submit" value="Login">
  </form>
</body>
</html>
```


## Logout

```php
@ logout.php

<?php
session_start();
require_once ('database_connect.php');
require_once ('functions.php');
$_SESSION = array();
if (ini_get('session.use_cookies')) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000,
    $params['path'], $params['domain'],
    $params['secure'], $params['httponly']
  );
}
session_destroy();
setcookie('email', '', time() - 3600);
setcookie('password', '', time() - 3600);
header('Location: login.php');
exit();
```
