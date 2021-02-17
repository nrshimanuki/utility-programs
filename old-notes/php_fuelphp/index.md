FuelPHP
==============================

## Install

### 公式サイト

#### zipファイル

* <a href="https://fuelphp.com" target="_blank">https://fuelphp.com</a>

### Composer

* Composerでパッケージ管理をしている

```
php composer.phar self-update
php composer.phar update
```

### oilコマンド

* Unix, OSX ではcurlコマンドとoilでインストールが可能
* 以下のコマンドで、/usr/bin/以下にシェルスクリプトが作成され、oilコマンドが使用可能になる

```
curl get.fuelphp.com/oil | sh
cd /usr/local/apache
oil create myblog
```

### 表示確認

```
http://localhost/myblog/public/index.php/welcome/index
```

* 上記では、welcomコントローラのindexアクションが実行される



## ディレクトリ構造

** 【】は定数

### public ... 【DOCROOT】

* ドキュメントルートに配置

### fuel

* app/ ... 【APPPATH】
  - classes
    - controller
    - model
  - config
    - development
      - db.php ... 【データベースの設定】
  - views
* core/ ... 【COREPATH】
  - 本体、設定ファイル
* packages/ ... 【PKGPATH】
  - パッケージとして提供されているプログラム
* vendor/ ... 【VENDORPATH】
  - composerによってインストールされたパッケージ
*

<br>


# Controller
## Controllerの基本

* /app/classes/controller/ に作成
* Webブラウザからのリクエストを最初に受け取るファイル
  - 通常のコントローラ
    - Controllerクラスを拡張して作成
  - テンプレートコントローラ
    - Controller_Templateを拡張して作成
  - Restコントローラ
    - XML,JSON形式のデータを送信するためのController_Restを拡張して作成
  - Hybridコントローラ
    - テンプレートとRestの両方の機能を持つ

* クラスとして実装し、リクエストに応じてアクションを呼ぶ

### URL

* URLをもとに呼び出すコントローラを決める
  - /segment1[コントローラ]/segment2[アクション]/segment3【パラメータ1】/segment4【パラメータ2】/...

```php
public function action_segment2($param1 = null, $param2 = null) { ... }
```

** パラメータが指定されていない場合のエラーを回避するために、初期値をnullにしておく

### before()

* コントローラがURLで指定されたメソッドを実行する前に呼ばれる
* 各メソッドの共通処理を記述できる
* before()で認証を行うことで、各メソッド内で認証チェックをする必要がなくなる
* URLで指定されたメソッドが存在しなくても実行されてしまう
* 実行後は自動的にURLで指定されたメソッドが実行される

```php
public function before() {
  if (!Auth::check()) {
    Response::redirect('welcome');
  }
}
```

### after($response)

* URLで指定されたメソッドが実行された後に実行される
* URLで指定されたメソッドが存在しなかった場合は実行されない
* 必ず引数をひとつ取る（実行したメソッドから返された戻り値）
* 受け取ったオブジェクトを必ずreturnする必要がある
  - 戻り値に対して、ブラウザに送られる前に加工することができる

### router($method, $params)

* router(【実行されたメソッド名】,【以降のパラメータを配列に格納したもの】)
* URLで指定されたメソッド名に関係なく実行される
* 実行後は明示的にメソッドを呼び出さないと、URLで指定されたメソッドが実行されない

### $request

* コントローラとメソッドの呼び出しに利用されたRequestオブジェクトの情報を保持
* 上書き禁止

### $response_status

* ステータスコードを保持
* デフォルトは200



## forge()

forge(【ファイル名】,【配列 or オブジェクト変数】)

* Viewクラスの静的メソッド

```php
@ welcome.php

public function action_index() {
  $data = new stdClass();
  $data->name = 'オブジェクト変数';
  return Response::forge(View::forge('welcome/index', $data));
}
```

```php
@ index.php

<?= $name; // 'オブジェクト変数' ?>
```

### 変数の渡し方

#### 配列

```php
// 渡した変数はextract()される
public function action_index() {
  $data = array();
  $data['title'] = 'TITLE';
  return Response::forge(View::forge('welcome/index', $data));
}
```

#### オブジェクト

```php
public function action_index() {
  $data = new stdClass();
  $data->name = 'オブジェクト変数';
  return Response::forge(View::forge('welcome/index', $data));
}
```

#### 先にViewクラスをインスタンス化して、そのオブジェクトのプロパティに代入

```php
public function action_index() {
  $view = View::forge('test');
  $view->set('title', 'TEST TITLE');
  $view->set('user', 'USER NAME');
  return $view;
}
```

```php
public function action_list() {
  $view = View::forge('members/list');
  $members = array();
  $members[] = array('id'=>1, 'name'=>'<h2>name1</h2>');
  $members[] = array('id'=>2, 'name'=>'<h2>name2</h2>');
  $members[] = array('id'=>3, 'name'=>'<h2>name3</h2>');
  $view->set('members', $members);
  return $view;
}

<?php foreach($members as $member): ?>
<div>
  <?= sprintf("%05d", $member['id']); ?> :
  <?= $member['name']; ?>
</div>
<?php endforeach; ?>
```

** Viewオブジェクトは出力をサニタイズする

### Response::forge()

* Viewオブジェクトの他に、ブラウザに返すべきステータスコードなどの情報を含むオブジェクト
* $bodyプロパティとして、Viewオブジェクトを保持



## Template Controller

* 基本的に、ヘッダ、フッタ、サイドバーなどを持つレイアウトで、ビューをラップ
* Controllerクラスのサブクラス
  - $templateプロパティが用意されている
* before()実行時にビューが読み込まれる
* before(),after()で共通のビューを読み込む
* APPPATH/views/template.php
  - $title,$contentプロパティが用意されている

```php
@ controller/example.php

class Controller_Example extends Controller_Template {
  public function before() {
    // before()でテンプレートビューが読み込まれる
    parent::before(); // この行がないと、テンプレートが動作しない
  }
  public function after($response) {
    $response = parent::after($response);
    return $response;
  }
  public function action_index() {
    $this->template->title = 'FuelPHP';
    $this->template->content = View::forge('example/index');
  }
}
```

```php
@ views/template.php

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title><?= $title; ?></title>
</head>
<body>
  <h1><?= $title; ?></h1>
  <div class="content">
    <?= $content; ?>
  </div>
</body>
</html>
```

```php
@ views/example/index.php

<h2>example.php</h2>
<ul>
  <li>template test.</li>
  <li>template test.</li>
  <li>template test.</li>
</ul>
```



## Rest Controller

* RESTfulなAPIを提供するのに適する
* Baseコントローラを継承したもの
* ControllerクラスのサブクラスのController_Restを継承して作成する
* リクエストパラメータをプレフィックスにしたメソッドを定義する
* before()やrouterメソッドを使うときは、parent::before() or routerを呼ぶ必要がある
* 各メソッド内では、$this->response()に配列を渡し、returnで返す
* HTTPメソッドに当てはまるプレフィクスのメソッドがない場合、"action_"プレフィクスのメソッドが代わりに呼び出される

```php
@ controller/restexample.php

class Controller_Restexample extends Controller_Rest {
  // 既存のリソースの情報を取得
  public function get_list() {
    $data = array(
      0 => array(
        'foo' => Input::get('foo'),
        'baz' => 'test'
      ),
      1 => array(
        'hoge' => Input::get('hoge'),
        'baz' => 'test2'
      )
    );
    return $this->response($data);
  }
  // 新しいリソースを作成
  public function post_list() {

  }
  // idに対応するリソースを作成・更新
  public function put_list() {

  }
  // 既存のリソースを削除
  public function delete_list() {

  }
  // idに対応するリソースの更新
  public function patch_list() {

  }
}
```

* /restexample/list.json ... JSONオブジェクトで返る
* /restexample/list.xml ... XML形式で返る
* リクエストされたURLにフォーマットを指定する拡張子が無い場合は、自動的に判断する
  - 判断できない時の為に、app/config/rest.php にデフォルトを指定しておく

### 特別なコントローラのメソッド

* フォーマットと出力ロジックを介して応答データを送信

```php
response($data = array(), $http_code = 200)
```



## Hybrid Controller

* テンプレートコントローラとRestコントローラを統合したもので、各メソッドを混在できる




## Modules

* 独立したMVC要素のグループ

### Modulesの設定

```php
@ app/config/config.php

'module_paths' => array(
  APPPATH.'modules'.DS,   // アプリケーションモジュールのパス
),
```

* 上記の配列の順番にディレクトリを探す
* 該当するモジュールが見つからない場合は、通常のコントローラを探す

```php
@ app/modules/member/classes/controller/hello.php

namespace Member;
class Controller_Hello extends \Controller {
  function action_index() {
    return \Response::forge('Hello');
  }
}
```



## HMVCリクエスト

* ある一組のMVC構造のコントローラを、別のコントローラから呼び出すことができる

<br>


# View
## Viewの基本

* /app/views/ に作成
* コントローラで読み込む、HTMLファイル
* 変数をコントローラから受け取ることができる

### DOCTYPE, META

```php
<?= HTML::doctype('html5'); ?>
<?= HTML::meta('charset', 'utf-8'); ?>
```

### リンク、外部ファイルの読み込み

#### Assetクラス

Asset::img(【ファイル名】,【属性の配列】)

```php
// /assets/img/sample.jpg
<?= Asset::img('sample.jpg', array('width'=>'100', 'alt'=>'サンプル')); ?>

// /assets/css/style.css
<?= Asset::css('style.css'); ?>

// /assets/js/script.js
<?= Asset::js('script.js'); ?>
```

* URLにクエリパラメータを付加するため、キャッシュが表示されない仕組みになっている（configで変更可能）
* カレントディレクトリの解釈が違うため、相対パスの指定は良くない

#### アンカータグ

HTML::anchor(【リンク先】,【表示文字列】,【属性の配列】,【true or false】)

* 第4引数をtrueにすると、httpではなくhttpsのURLが生成される

```php
<?= HTML::anchor('welcome', 'Back to Top'); ?>
```

### 複数のViewを組み合わせる

* 親となるビューファイルの中で変数を呼ぶようにしておき、別のビューをその変数に渡す

```php
@ view/layout.php

<?= HTML::doctype('html5'); ?>
<html lang="ja">
<head>
  <?= HTML::meta('charset', 'utf-8'); ?>
  <title><?= $title; ?></title>
</head>
<body>
  <h1><?= $title; ?></h1>
  <?= $header; ?>
  <?= $content; ?>
  <?= $footer; ?>
</body>
</html>
```

```php
@ controller/nest.php

class Controller_Nest extends Controller {
  function action_index() {
    $data = array();
    $data['header'] = View::forge('header');
    $data['content'] = View::forge('content');
    $data['footer'] = View::forge('footer');
    return View::forge('layout', $data);
  }
}
```

#### 複数のビューに変数を渡す

##### set_global()

* 外側のビューに変数を設定することで、内側の変数も同時に設定できる

```php
@ controller/nest.php

class Controller_Nest extends Controller {
  function action_index() {
    $view = View::forge('layout');
    $view->set('header', View::forge('header'));
    $view->set('content', View::forge('content'));
    $view->set('footer', View::forge('footer'));
    $view->set_global('title', 'Title');
    $view->set_global('username', 'User Name');
    return $view;
  }
}
```

```php
@ view/layout.php

<?= HTML::doctype('html5'); ?>
<html lang="ja">
<head>
  <?= HTML::meta('charset', 'utf-8'); ?>
  <title><?= $title; ?></title>
</head>
<body>
  <h1><?= $title; ?></h1>
  <?= $header; ?>
  <?= $content; ?>
  <?= $footer; ?>
</body>
</html>
```

```php
@ view/content.php

<?= $title ?>
<div class="welcom">
  Hi, <?= $username; ?>
</div>
```

#### ビューからビューを呼び出す

```php
@ controller/nest.php

class Controller_Nest extends Controller {
  function action_index() {
    $view = View::forge('layout');
    $view->set('header', View::forge('header'));
    $view->set('content', View::forge('content'));
    $view->set('footer', View::forge('footer'));
    $view->set_global('title', 'Title');
    $view->set_global('username', 'User Name');
    return $view;
  }
}
```

```php
@ view/layout.php

<?= HTML::doctype('html5'); ?>
<html lang="ja">
<head>
  <?= HTML::meta('charset', 'utf-8'); ?>
  <title><?= $title; ?></title>
</head>
<body>
  <h1><?= $title; ?></h1>
  <?= View::forge('header'); ?>
  <?= View::forge('content'); ?>
  <?= View::forge('footer'); ?>
</body>
</html>
```

```php
@ view/content.php

<?= $title ?>
<div class="welcom">
  Hi, <?= $username; ?>
</div>
```

<br>


# Model
## Modelの基本

* /app/classes/model/ に作成
* データの読み書きをする役割
* コントローラから呼び出される

### 継承元

* Model
* Model_Crud
* \Orm\Model

### ControllerからModelの呼び出し

```php
@ controller/user.php

class Controller_User extends Controller {
  function action_index() {
    $user = new Model_User();
    $user->get_all();
  }
}
```

### DBクラス

* Modelからデータベースにアクセスするには、DBクラスを使う

```php
@ model/user.php

class Model_User extends Model {
  public function get_all() {
    $sql = 'SELECT * FROM `users`';
    $query = DB::query($sql);
    $result = $query->execute();
    $result_array = $result->as_array();
    return $result_array;
  }
}

// 1行で書くと
$result_array = DB::query('SELECT * FROM `users`')->execute()->as_array();
```

### Model_Crud

* 基本的なCRUDを実装できるクラス
* 継承することで、以下のメソッドが利用できる
  - forge() ... インスタンス作成
  - find_all() ... 全データ取得
  - find_by_pk() ... 主キーでデータ取得
  - find() ... 指定した条件のデータ取得
  - save() ... データ保存
  - delete() ... データ削除

#### テーブルと主キーを指定する

```php
@ controller/user.php

class Controller_User extends Controller {
  function action_index() {
    $users = Model_User::find_all();
  }
}
```

```php
@ model/user.php

class Model_User extends Model_Crud {
  protected static $_table_name = 'users';
  protected static $_primary_key = 'id'; // デフォルトで'id'になっている
}
```

### データ取得

find_by_pk($pk)

* 主キーでレコードが見つかれば、Model_Userオブジェクトとして返される
* 主キーでレコードが見つからなければ、falseが返される
* クエリ結果のデータは、データベースのカラム名をプロパティとして参照できる

```php
class Controller_User extends Controller {
  function action_index() {
    $user = Model_User::find_by_pk(1);
    echo $user->name;
  }
}
```













<br>


# 簡易的なブログを作成

## Model

* Model_Crudを継承
* 下記の記述（テーブル名、主キーの設定）で、最低限のCRUDが実装される

```php
@ model/post.php

class Model_Post extends Model_Crud {
  protected static $_table_name = 'posts';
  protected static $_primary_key = 'id';
}
```



## Controller

### set()

現在のモデルインスタンスに値の配列をセット

### save()

レコードを挿入または更新

### find_all()

オプションのlimitとoffsetを使い、テーブルから全てのレコードを検索

### Response::redirect()

新しいURLにリダイレクトする方法を提供

```php
@ controller/post.php

class Controller_Post extends Controller {
  public function action_index() {
    $data = array();
    $data['rows'] = Model_Post::find_all();
    return View::forge('post/list', $data);
  }
  public function action_form() {
    return View::forge('post/form');
  }
  public function action_save() {
    $form = array();
    $form['title'] = Input::post('title');
    $form['summary'] = Input::post('summary');
    $form['body'] = Input::post('body');
    $post = Model_Post::forge();
    $post->set($form);
    $post->save();
    Response::redirect('post');
  }
}
```



## View

```php
@ views/list.php

<?php foreach ($rows as $row): ?>
  <div><?= $row['title']; ?></div>
  <div><?= $row['summary']; ?></div>
  <div><?= $row['body']; ?></div><br>
<?php endforeach; ?>
```

```php
@ views/form.php

<form action="/post/save" method="post">
  <label>
    Title: <input type="text" name="title" value="">
  </label>
  <label>
    Summary: <input type="text" name="summary" value="">
  </label>
  <label>
    Body: <textarea name="body"></textarea>
  </label>
  <input type="submit" name="submit" value="post">
</form>
```



# MEMO

## model

```
<?php

class Model_Accounts extends Model {

    public static function get($company_id, $account_id) {

        $sql = 'select account_id, email, company_id, user_name, user_name_kana, user_nickname, '
              .'user_image, staff_type, user_authority_id, last_login from account '
              .'where company_id = \''.$company_id.'\'';

        if (strlen($company_id) == 0) {
            return null;
        }

        if (strlen($account_id) > 0) {
            $sql = $sql . ' and account_id = :account_id';
            $query = DB::query($sql);
            $query->param('account_id', $account_id);
        } else {
            $query = DB::query($sql);
        }

        return $query->execute()->as_array();
    }

    public static function add($account_data) {

        Log::debug('ADD');

        Log::debug('POST company:'.$account_data['company_id']);
        Log::debug('POST email:'.$account_data['email']);
        Log::debug('POST company_id:'.$account_data['company_id']);
        Log::debug('POST user_name:'.$account_data['user_name']);
        Log::debug('POST user_name_kana:'.$account_data['user_name_kana']);
        Log::debug('POST user_nickname:'.$account_data['user_nickname']);
        Log::debug('POST user_image:'.$account_data['user_image']);
        Log::debug('POST staff_type:'.$account_data['staff_type']);
        Log::debug('POST user_authority_id:'.$account_data['user_authority_id']);
        Log::debug('POST password:'.$account_data['password']);

//        $account_no = Model_ComNumbering::create_user_code();
//        Log::debug('ADD $account_no:'.$account_no);

//        $company_no = substr($account_data['company_id'], 9, 3);
//        $account_str = sprintf('%04d', $account_no);


        $user_name = $account_data['user_name'];
        $email = $account_data['email'];
        $conpamy_id = $account_data['company_id'];
        $user_name_kana = $account_data['user_name_kana'];
        $user_nickname = $account_data['user_nickname'];
        $user_image = $account_data['user_image'];
        $staff_type = $account_data['staff_type'];
        $user_authority_id = $account_data['user_authority_id'];
        $password = $account_data['password'];

//        $original_pass = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        $original_pass = $password;
        Log::debug('PASS:'.$original_pass);

        $result = Auth::create_user(
            (string) $user_name,
            (string) $original_pass,
            (string) $email,
            (string) $user_authority_id,
            (string) $conpamy_id,
            (string) $user_name_kana,
            (string) $user_nickname,
            (string) $user_image,
            (string) $staff_type
        );
        return $result;
    }

    public static function update($account_data) {

        Log::debug("アカウント更新");

        $account_id = $account_data['account_id'];  // キー
//        $email = $account_data['email'];            変更不可
        $company_id = $account_data['company_id'];  // キー
        $user_name = $account_data['user_name'];
        $user_name_kana = $account_data['user_name_kana'];
        $user_nickname = $account_data['user_nickname'];
        $user_image = $account_data['user_image'];
        $staff_type = $account_data['staff_type'];
        $user_authority_id = $account_data['user_authority_id'];

        $sql = 'update account set user_name = :user_name, user_name_kana = :user_name_kana, '
              .'user_nickname = :user_nickname, user_image = :user_image, staff_type = :staff_type, '
              .'user_authority_id = :user_authority_id where account_id = :account_id';

        $query = DB::query($sql);
        $params = array(
            'user_name' => $user_name,
            'user_name_kana' => $user_name_kana,
            'user_nickname' => $user_nickname,
            'user_image' => $user_image,
            'staff_type' => $staff_type,
            'user_authority_id' => $user_authority_id,
            'account_id' => $account_id
        );
        $query->parameters($params);
        $result = $query->execute();

        return $result;
    }

    public static function delete($account_id) {

        $sql = 'delete from account where account_id = :account_id ;';
        Log::debug($sql);

        $query = DB::query($sql);
        $query->param('account_id', $account_id);
        return $query->execute();
    }

    public static function passwordchange($account_data) {
        Log::debug("パスワード変更");

        $email = $account_data['email'];
        $oldpassword = $account_data['oldpassword'];
        $newpassword = $account_data['newpassword'];  // キー

        Log::debug('email:'.$email);
        Log::debug('oldpassword:'.$oldpassword);
        Log::debug('newpassword:'.$newpassword);

        $succeed = false;
        if ((!empty($oldpassword)) && (!empty($newpassword))) {
            try {
                Auth::change_password($oldpassword, $newpassword, $email);
                $succeed = true;
                Log::debug("更新に成功");
            } catch (Exception $e) {
                Log::debug("更新に失敗".$e->getMessage());
            }
        } else {
            Log::debug("パスワードが空");
        }

        return $succeed;
    }

    public static function duplicate_search_email($email) {
        $sql = 'select account_id from account where email = :email';
        $query = DB::query($sql);
        $query->parameters(array('email' => $email));
        $email_list =  $query->execute()->as_array();
        if (count($email_list) > 0) {
            return true;
        }else {
            return false;
        }
    }

    public static function find_list($order_by, $ofset, $limit) {

        $sql = 'select account_id, email, company_id, user_name, user_name_kana, user_nickname, '
              .'user_image, staff_type, user_authority_id, last_login from account ';

        $sql = 'select account_id, email, username, email, user_authority_id from account';
        $parameters = array();

        $parameters = $parameters + array('limit' => (int) $limit);
        $parameters = $parameters + array('ofset' => (int) $ofset);
        $query_count = DB::query($sql);
        $query_count->parameters($parameters);
        $count = count($query_count->execute()->as_array());

        $sql = $sql . ' order by ' . $order_by. ' limit :limit offset :ofset;';
        $query = DB::query($sql);
        $query->parameters($parameters);
        $record_list = $query->execute()->as_array();

        $rtn_result = array();
        $rtn_result['Result'] = 'OK';
        $rtn_result['Records'] = $record_list;
        $rtn_result['TotalRecordCount'] = $count;

        return $rtn_result;
    }
}



# api/controller
<?php

class Controller_api_accounts extends Controller_Rest {

    private $headers = array(
        'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
        'Pragma' => 'no-cache',
    );

    public function before() {
        parent::before();
        $lang = Agent::languages();
        Config::set('language', 'ja');
        \Lang::load('wording');
    }

    public function get_index() {

        $body = '';
        $company_id = $this->param('company_id');
        $account_id = $this->param('account_id');

        Log::debug('$company_id:'.$company_id);
        Log::debug('$account_id:'.$account_id);

        if ($company_id == null || !preg_match('/^[0-9a-zA-Z]+$/', $company_id)) {
            $body = self::create_response_body(API_ERROR, __('msg_warning_parameter_error'));
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        }

        if ($account_id !== null && !preg_match('/^[0-9]+$/', $account_id)) {
            $body = self::create_response_body(API_ERROR, __('msg_warning_parameter_error'));
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        }

        $accountdata = Model_Accounts::get($company_id, $account_id);
        if (count($accountdata) === 0) {
            $body = self::create_response_body(API_ERROR, __('msg_no_data'));
            $response = new Response($body, HTTP_CODE_404, $this->headers);
        } else {
//            if (count($account_id) === 0) {
            if ($account_id === null) {
                $body = json_encode($accountdata, JSON_NUMERIC_CHECK);
            } else {
                $body = json_encode($accountdata[0], JSON_NUMERIC_CHECK);
            }
            $response = new Response($body, HTTP_CODE_200, $this->headers);
        }

        return $response;
    }

    public function post_index() {
        $json_string = file_get_contents('php://input');

        Log::debug('jsonstring: ' . $json_string);
        $body = '';

        Log::debug('POST1');
        $data = json_decode($json_string, true);

        $res = self::validate_data($data);
        if ($res) {
            Log::debug('validate NG');
            $body = $res;
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        }

        try {
            $data['user_name'] = htmlspecialchars($data['user_name']);
            $result = Model_Accounts::add($data);
        } catch (Exception $e) {
            $body = self::create_response_body(API_ERROR, __('msg_error_insert'));
            $response = new Response($body, HTTP_CODE_500, $this->headers);
            Log::debug($e->getMessage());
            return $response;
        }

        if (count($result) > 0) {
            $body = self::create_response_body(API_SUCCESS, __('msg_success'), $result['password']);
            $response = new Response($body, HTTP_CODE_201, $this->headers);
        } else {
            $body = self::create_response_body(API_ERROR, __('msg_info_no_data'));
            $response = new Response($body, HTTP_CODE_400, $this->headers);
        }

        return $response;
    }

    public function put_index() {
        $json_string = file_get_contents('php://input');

        Log::debug($json_string);

        $body = '';
        $data = json_decode($json_string, true);

        $update_flag = true;
        $res = self::validate_data($data, $update_flag);
        if ($res) {
            Log::debug("バリデートエラー");
            $body = $res;
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        }
        Log::debug("バリデートOK");

        try {
//            $data['username'] = htmlspecialchars($data['username']);
            $result = Model_Accounts::update($data);
        } catch (Exception $e) {
            $body = self::create_response_body(API_ERROR, __('msg_error_update'));
            $response = new Response($body, HTTP_CODE_500, $this->headers);
            return $response;
        }

        if ($result) {
            $body = self::create_response_body(API_SUCCESS, __('msg_success'));
            $response = new Response($body, HTTP_CODE_204, $this->headers);
        } else {
            $body = self::create_response_body(API_ERROR, __('msg_no_data'));
            $response = new Response($body, HTTP_CODE_404, $this->headers);
        }

        return $response;
    }

    public function delete_index() {
        $body = '';
        $company_id = $this->param('company_id');
        $account_id = $this->param('account_id');

        Log::debug('$account_id'.$account_id);

        if ($account_id === null || $account_id === '') {
            $body = self::create_response_body(API_ERROR, __('msg_warning_parameter_error'));
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        } else if (!preg_match('/^[0-9]+$/', $account_id)) {
            $body = self::create_response_body(API_ERROR, __('msg_warning_parameter_error'));
            $response = new Response($body, HTTP_CODE_400, $this->headers);
            return $response;
        }

        try {
            $result = Model_Accounts::delete($account_id);
        } catch (Exception $e) {
            $body = self::create_response_body(API_ERROR, __('msg_error_delete'));
            $response = new Response($body, HTTP_CODE_500, $this->headers);
        }

        if ($result) {
            $body = self::create_response_body(API_SUCCESS, __('msg_success'));
            $response = new Response($body, HTTP_CODE_204, $this->headers);
        } else {
            $body = self::create_response_body(API_ERROR, __('msg_no_data'));
            $response = new Response($body, HTTP_CODE_404, $this->headers);
        }

        return $response;
    }

    public function validate_data($arr, $update_flag = false) {

        $code = API_SUCCESS;
        $message = '';
        $res = array();

        if ($arr['user_name'] === null || $arr['user_name'] === '') {
            $code = API_ERROR;
            $msg_arr[] = __('msg_warning_account_name');
        } else {
            if (mb_strlen($arr['user_name']) > 32) {
                $code = API_ERROR;
                $msg_arr[] = __('msg_warning_over_account_name');
            }
        }

        if ($arr['user_name_kana'] === null || $arr['user_name_kana'] === '') {
            $code = API_ERROR;
            $msg_arr[] = __('msg_warning_account_name_kana');
        } else {
            if (mb_strlen($arr['user_name_kana']) > 32) {
                $code = API_ERROR;
                $msg_arr[] = __('msg_warning_over_account_name_kana');
            }
        }

        if ($arr['user_authority_id'] === null || $arr['user_authority_id'] === '' || $arr['user_authority_id'] === '00') {
            $code = API_ERROR;
            $msg_arr[] = __('msg_warning_account_auth');
        } else if (!in_array($arr['user_authority_id'], array(USER_AUTHORITY_CREATOR,
                    USER_AUTHORITY_ADMIN, USER_AUTHORITY_LEADER, USER_AUTHORITY_USER))) {
            $code = API_ERROR;
            $msg_arr[] = __('lbl_accident');
        }

        if ($arr['staff_type'] === null || $arr['staff_type'] === '' || $arr['staff_type'] === '00') {
            $code = API_ERROR;
            $msg_arr[] = __('msg_warning_staff_type');
        } else if (!in_array($arr['staff_type'], array(USER_STAFF_TYPE_REGULAR,
                    USER_STAFF_TYPE_CONTRACTOR, USER_STAFF_TYPE_PART_TIME,
                    USER_STAFF_TYPE_DAY_LABOR))) {
            $code = API_ERROR;
            $msg_arr[] = __('msg_warning_staff_type_accident');
        }

        if ($update_flag === false) {
            if ($arr['email'] === null || $arr['email'] === '') {
                $code = API_ERROR;
                $msg_arr[] = __('msg_warning_account_email');
            } else if (filter_var(trim($arr['email']), FILTER_VALIDATE_EMAIL) === false) {
                $code = API_ERROR;
                $msg_arr[] = __('msg_warning_email_format');
            } else {
                $duplicate_flag = Model_Accounts::duplicate_search_email($arr['email']);
                if ($duplicate_flag) {
                    $code = API_ERROR;
                    $msg_arr[] = __('msg_warning_email_unique');
                }
            }
        }

        if (!$update_flag) {
            if ($arr['password'] === null || $arr['password'] === '') {
                $code = API_ERROR;
                $msg_arr[] = __('msg_warning_password');
            } else {
                if (mb_strlen($arr['password']) < 4) {
                    $code = API_ERROR;
                    $msg_arr[] = __('msg_warning_below_password');
                }
            }
        }

        if ($code === API_ERROR) {
            $message = implode("\n", $msg_arr);
            $res = self::create_response_body($code, nl2br($message));
        }
        return $res;
    }

    public function create_response_body($code = '', $message = '', $password = '') {
        if ($password !== '') {
            $res = array(
                'Response' => array(
                    'code' => $code,
                    'Message' => $message,
                    'Password' => $password
                )
            );
        } else {
            $res = array(
                'Response' => array(
                    'code' => $code,
                    'Message' => $message
                )
            );
        }
        return json_encode($res, JSON_NUMERIC_CHECK);
    }
}



# controller
<?php

/**
 * The accountlist Controller.
 * @package  app
 * @extends  Controller_Base
 */
class Controller_Accountlist  extends Controller_Base {

    public function before() {
        $this->template = 'template';
        parent::before();
        $this->template->title = __('account_list');
        $this->template->content = View::forge('accountlist/accountlist');
    }

    public function get_index() {

    }
}

```
