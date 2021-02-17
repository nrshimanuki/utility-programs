# WP note (old)

## Sample

### Main loop
```
if(have_posts()):
	while(have_posts()): the_post();

	endwhile;
else:

endif;
```

### Sub loop
```
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ; // pager 使うときのみ
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish'
	'posts_per_page' => 10,
	'paged' => $paged // pager 使うときのみ
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ):
?>

<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>

<?php endwhile; wp_reset_postdata(); ?>

<?php endif; ?>
```




## プラグイン

### バージョンチェックの仕組み

#### @ wp-includes/update.php

	* http://api.wordpress.org/plugins/update-check/1.1/
	* wp_remote_post() // POSTメソッドを送信す
	* set_site_transient( 'update_plugins', $new_option );
	* get_site_transient( 'update_plugins' );


### バージョン比較 (PHP)

* version_compare()


### プラグインディレクトリを確認し、プラグインデータを含むすべてのプラグインファイルを取得

* get_plugins()


### WordPress.orgでホストされている最新バージョンに対してプラグインのバージョンを確認

* wp_update_plugins()


### データ情報を取得

* get_file_data()
* get_plugin_data()


### プラグインが有効化されたときに実行される関数を登録

* register_activation_hook()


### プラグインリストテーブル内の各プラグインの行メタの配列をフィルター

* plugin_row_meta()


### Update させない

```
add_filter('site_option__site_transient_update_plugins', 'function_name');
function function_name($data) {
	$plugin_name = 'plugin-name/plugin-name.php';
	if (isset($data->response[$plugin_name])) {
		unset($data->response[$plugin_name]);
	}
	return $data;
}
```

```
add_filter('site_transient_update_plugins', 'function_name');
function function_name($value) {
	$ignore_plugins = array(
		'plugin-name/plugin-name.php'
	);
	foreach ($ignore_plugins as $ignore_plugin) {
		if (isset($value->response[$ignore_plugin])) {
			unset($value->response[$ignore_plugin]);
		}
	}
	return $value;
}
```




## functions.php

* 機能を追加できる
* functions.phpに書くこととプラグインを使うことは同じこと
* プラグインに書くときはファイルの先頭に情報を書く
* エラーがあると画面が真っ白になるので、バックアップをとっておく
* 管理画面からテーマは編集しないこと
* 最後の ?> は不要

### 書いておきたいテンプレート
```
add_theme_support()
post_thumbnails
resister_nav_menu
function_exsts
resister_sidebar
add_theme_support( 'title-tag' )
```



## カスタム投稿タイプを定義
```
add_action( 'init', 'register_cpt_team' );

function register_cpt_team() {
	$labels = array(
		'name' => _x( 'メンバー', 'team' ),
		'singular_name' => _x( 'メンバー', 'team' ),
		'add_new' => _x( '新規追加', 'team' ),
		'add_new_item' => _x( '新しいメンバープロフィールを追加', 'team' ),
		'edit_item' => _x( 'メンバープロフィールを編集', 'team' ),
		'new_item' => _x( '新しいメンバー', 'team' ),
		'view_item' => _x( 'メンバープロフィールを見る', 'team' ),
		'search_items' => _x( 'メンバー検索', 'team' ),
		'not_found' => _x( 'プロフィールが見つかりません', 'team' ),
		'not_found_in_trash' => _x( 'ゴミ箱にプロフィールはありません', 'team' ),
		'parent_item_colon' => _x( '親メンバー:', 'team' ),
		'menu_name' => _x( 'メンバー', 'team' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'description' => '経歴紹介とか',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'team', $args );
}
```



## サムネイル画像を利用
```
add_theme_support( 'post-thumbnails', array( 'team' ) );
set_post_thumbnail_size( 150, 150, true );

// アイコンを追加
function add_menu_icons_styles(){
	 echo '<style>
			#adminmenu #menu-posts-team div.wp-menu-image:before {
				 content: "\f307";
			}
	 </style>';
}
add_action( 'admin_head', 'add_menu_icons_styles' );
```



## アイキャッチ

初期設定で有効化されていない。
```
add_theme_support('post-thumbnails');
```

### 画像

* アップロードするとWPが複数の画像を作る
* 管理画面 メディア から指定できる

**サイズの違う画像を増やす場合**
```
add_image_size('category-thumb', 450, 9999);
add_image_size('category-big', 900, 9999);
```

出力するところをテーマに記述する。
```
if (has_post_thumbnail()) :
	the_post_thumbnail('category-big');
else:
	<img src="..." alt="">
endif;
```



## ウィジェット
```
function test_widgets_init() {
	register_sidebar( array(
		'name' => '○○',
		'id' => 'sidebar-1,
	));
}
add_action( 'widgets_init', 'test_widgets_init' );
```
```
<?php dynamic_sidebar( 'sidebar-1' ); ?>
```



## CSSとJSを読み込む
```
wp_enqueue_style();
wp_enqueue_script();

add_action('フックの場所', '引っ掛ける機能');
```

### wp_enqueue_scripts()
フロントエンドのみに処理を適用するため、管理画面などには影響を与えない。

### wp_enqueue_script()
```
wp_enqueue_script(
	'handle',
	plugins_url( 'assets/js/script.js', __FILE__ ),
	[ 'wp-i18n' ]
);
```



## 管理画面

### サイドバーにメニューを作成
```
add_menu_page()
add_submenu_page()
```



## カスタムメニュー
```
register_nav_menus ( array(
	'primay_menu' => 'メインメニュー',
));

<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
```



## カスタムフィールド

メタデータのこと。
名前と値の組み合わせ。

```
the_meta(); // 全部
echo esc_html(get_post_meta($post->ID, 'name', true )); // ひとつずつ
```

### smart custom fields
```
$product_id = SCF::get('product-id');
echo esc_html($product_id);

$repeat_group = SCF::get('repeat-group');
foreach ($repeat_group as $fields) {
	echo $fields['productname'];
```

```
<?php echo get_post_meta($post->ID,'メンバー：職業',true); ?>
```


## サムネイル画像の設定
```
add_theme_support( 'post-thumbnails', array( 'team' ) );
set_post_thumbnail_size( 150, 150, true );
```



## カスタム投稿の年月別アーカイブ
```
function archive_link_for_taxonomy($url){
	global $taxonomy_getarchives_data;
	if (isset($taxonomy_getarchives_data['post_type'])){
		$url .= strpos($url, '?') === false ? '?' : '&';
		$url .= 'post_type=' . $taxonomy_getarchives_data['post_type'];
	}
	return $url;
}
add_filter('year_link', 'archive_link_for_taxonomy');
add_filter('month_link', 'archive_link_for_taxonomy');
add_filter('day_link', 'archive_link_for_taxonomy');


<?php
	wp_get_archives(array(
		'post_type' => 'hoge',
		'type' => 'monthly'
	));
?>
```



## 配列とオブジェクトの取得方法

***配列***
```
array(6) {
	["hoge"]=>
	string(4) "fuga"
	["hogehoge"]=>
	string(8) "fugafuga"
}

echo $hoge['foo'];
```

***オブジェクト***
```
object(WP_Post)#56 (24) {
	["ID"]=>
	int(8)
	["post_author"]=>
	string(1) "1"
	["post_date"]=>
	string(19) "2015-05-23 17:56:28"
}

echo $post->ID;
```





## カテゴリ
```
$category = get_the_category();
$cat_slug = $category[0] -> category_nicename;
if($cat_slug == 'news'):
	$cat_label = 'NEWS';
elseif($cat_slug == 'jobs'):
	$cat_label = 'JOBS';
else:
	$cat_label = $cat_slug;
endif;
```

```
<?php
	$paged = get_query_var('paged');
	$cat_id = get_query_var('cat');

	if($cat_id != 1):
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 15,
			'post_status' => 'publish',
			'category__in' => array($cat, 2),
			'paged' => $paged
		);
	else:
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 15,
			'post_status' => 'publish',
			'paged' => $paged
		);
	endif;
	query_posts($args);
	if(have_posts()):
?>
<dl class="list">
<?php
	while(have_posts()): the_post();
		$cats = get_the_category();
		foreach($cats as $cat):
			if($cat->category_parent > 0):
				$term = $cat;
				break;
			endif;
		endforeach;

		if($term->name == '全店'):
			$term->name = '全　店';
		endif;
?>
	<dt class="date">
		<?php the_time('Y.m.d'); ?>
		<span class="shop<?php if($term->slug == 'all') echo ' all'; ?>">
			<?php echo $term->name; ?>
		</span>
	</dt>
	<dd>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</dd>
	<?php endwhile; ?>
</dl>
<?php endif; ?>
```


```
<?php
	$cats = get_categories();
	foreach($cats as $cat):
		if($cat->name != 'お知らせ' && $cat->name != '全店'):
?>
<li>
	<a href="<?php bloginfo('url'); ?>/info/<?php echo $cat->slug; ?>/">
		<?php echo $cat->name; ?>
	</a>
</li>
<?php
		endif;
	endforeach;
?>
```


## 管理画面の投稿一覧ページにカスタムタクソノミーの絞り込み条件を追加

```
function add_post_taxonomy_restrict_filter() {
		global $post_type;
		if('【post-name】' == $post_type):
?>
		<select name="【tax-name】">
				<option value="">カテゴリー指定なし</option>
				<?php
						$terms = get_terms('【tax-name】');
						foreach($terms as $term):
				?>
				<option value="<?php echo $term->slug; ?>"<?php if($_GET['【tax-name】'] == $term->slug) echo ' selected'; ?>><?php echo $term->name; ?></option>
				<?php endforeach; ?>
		</select>
<?php
		endif;
}
add_action('restrict_manage_posts', 'add_post_taxonomy_restrict_filter');


function add_post_taxonomy_restrict_filter() {
		global $post_type;
		if('post' == $post_type):
?>
		<select name="tag">
				<option value="">タグ指定なし</option>
				<?php
						$terms = get_terms('post_tag');
						foreach($terms as $term):
				?>
				<option value="<?php echo $term->slug; ?>"<?php if($_GET['tag'] == $term->slug) echo ' selected'; ?>><?php echo $term->name; ?></option>
				<?php endforeach; ?>
		</select>
<?php
		endif;
}
add_action('restrict_manage_posts', 'add_post_taxonomy_restrict_filter');
```


## アクションフック

```
add_action('アクションフック名', '実行する関数名');

// 投稿の保存時に実行されるアクションフック
function set_meta($post_id){
		global $post;
		$str = get_the_title($post_id);
		update_post_meta($post_id, 'hoge', $str);
}
add_action('save_post', 'set_meta');
```


## プレビューができない

ドキュメントルート下の「index.php」で「wp-blog-header.php」をrequireしている場合に発生。
( プレビュー時のURL: ```http://sample.com/?p=123&preview=true``` )

「wp-blog-header.php」をrequireする前に下記を記述。

```
if (isset($_GET['preview'])):
	header("Location: /wp". $_SERVER["REQUEST_URI"]);
	exit;
endif;
```
