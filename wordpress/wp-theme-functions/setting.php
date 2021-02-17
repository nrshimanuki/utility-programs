
<?php
// !! テーマの functions.php に追記 !!
/* Expansion +++++++++++++++++++++++++++++++++++++++ */
// require TEMPLATEPATH . '/theme-functions/setting.php';
/* +++++++++++++++++++++++++++++++++++++++++++++++++ */


/* =====================================
	パスの定義
===================================== */

define('THEME_FUNCTIONS', TEMPLATEPATH . '/theme-functions');


/* =====================================
	機能の使用設定
===================================== */

// 投稿タグの使用
define('USE_POST_TAGS', false);

// コメントの使用
define('USE_COMMENT', false);

// アイキャッチの使用 (_s デフォルトで有効)
// define('USE_THUMBNAIL', false);

// カスタム投稿の使用
define('USE_CUSTOM_POST', true);

// カスタムフィールドの使用
define('USE_CUSTOM_FIELD', false);


/* =====================================
	拡張関数
===================================== */

// 管理画面の設定
require THEME_FUNCTIONS . '/admin.php';

// 基本設定
require THEME_FUNCTIONS . '/config.php';

// 拡張関数
require THEME_FUNCTIONS . '/expansion.php';

// カスタム投稿
if(USE_CUSTOM_POST){
	require THEME_FUNCTIONS . '/custom-post.php';
}
