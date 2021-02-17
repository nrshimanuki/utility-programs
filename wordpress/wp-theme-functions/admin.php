<?php

/**
 * 【管理画面】更新の無効化
 */
// 管理者以外に対して実行
// if (!current_user_can('administrator')) {
// 	// すべての自動更新を無効化
// 	// add_filter('automatic_updater_disabled', '__return_true');

// 	// 本体バージョンの更新非通知
// 	add_filter('pre_site_transient_update_core', '__return_null');

// 	// プラグインの更新非通知
// 	add_filter('pre_site_transient_update_plugins', '__return_null');

// 	// テーマファイルの更新非通知
// 	add_filter( 'pre_site_transient_update_themes', '__return_null');
// }



/**
 * 【管理画面】管理ツールバーの不要な項目を削除
 */
function remove_bar_menus($wp_admin_bar) {
	$wp_admin_bar->remove_menu('wp-logo');
	// $wp_admin_bar->remove_menu('updates');

	if(!USE_COMMENT)
		$wp_admin_bar->remove_menu('comments');
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);



/**
 * 【管理画面】サイドメニュー非表示
 */
function remove_menus() {
	global $menu;
	global $submenu;

	// remove_submenu_page('index.php', 'update-core.php'); // 更新
	// remove_menu_page('index.php'); // ダッシュボード
	// remove_menu_page('edit.php'); // 投稿
	// remove_menu_page('upload.php'); // メディア
	// remove_menu_page('edit.php?post_type=page'); // 固定ページ
	// remove_menu_page('edit-tags.php?taxonomy=link_category'); // リンク
	if(!USE_COMMENT)
		remove_menu_page('edit-comments.php'); // コメント
	// remove_menu_page('themes.php'); // 外観
	// remove_menu_page('plugins.php'); // プラグイン
	// remove_menu_page('users.php'); // ユーザー
	// remove_menu_page('tools.php'); // ツール
	// remove_menu_page('options-general.php'); // 設定
	// remove_menu_page('wpcf7'); // ContactForm7

	// remove_submenu_page('edit.php', 'edit.php'); // 投稿 投稿一覧
	// remove_submenu_page('edit.php', 'post-new.php'); // 投稿 新規追加
	// remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // 投稿 カテゴリー
	if(!USE_POST_TAGS)
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // 投稿 タグ

	// remove_submenu_page('edit.php?post_type=page', 'edit.php?post_type=page'); // 固定ページ一覧
	// remove_submenu_page('edit.php?post_type=page', 'post-new.php?post_type=page'); // 固定ページ 新規追加

	// remove_submenu_page('themes.php', 'themes.php'); // テーマ
	remove_submenu_page('themes.php', 'customize.php?return='. urlencode($_SERVER["REQUEST_URI"])); // カスタマイズ
	remove_submenu_page('themes.php', 'widgets.php'); // ウィジェット
	remove_submenu_page('themes.php', 'nav-menus.php'); // メニュー
	remove_submenu_page('themes.php', 'customize.php?return='. urlencode($_SERVER["REQUEST_URI"]) . '&#038;autofocus%5Bcontrol%5D=header_image'); // ヘッダー
	remove_submenu_page('themes.php', 'customize.php?return='. urlencode($_SERVER["REQUEST_URI"]) . '&#038;autofocus%5Bcontrol%5D=background_image'); // 背景

	remove_submenu_page('plugins.php', 'plugins.php'); // インストール済みプラグイン
	remove_submenu_page('plugins.php', 'plugin-install.php'); // 新規追加
	remove_submenu_page('plugins.php', 'plugin-editor.php'); // プラグインエディター

	remove_submenu_page('users.php', 'users.php'); // ユーザー一覧
	remove_submenu_page('users.php', 'user-new.php'); // 新規追加
	// remove_submenu_page('users.php', 'profile.php'); // あなたのプロフィール

	remove_submenu_page('tools.php', 'tools.php'); // 利用可能なツール
	remove_submenu_page('tools.php', 'import.php'); // インポート
	remove_submenu_page('tools.php', 'export.php'); // エクスポート
	remove_submenu_page('tools.php', 'site-health.php'); // サイトヘルス
	remove_submenu_page('tools.php', 'export_personal_data'); // 個人データのエクスポート
	remove_submenu_page('tools.php', 'remove_personal_data'); // 個人データの削除

	// remove_submenu_page('options-general.php', 'options-general.php'); // 一般
	remove_submenu_page('options-general.php', 'options-writing.php'); // 投稿設定
	// remove_submenu_page('options-general.php', 'options-reading.php'); // 表示設定
	remove_submenu_page('options-general.php', 'options-discussion.php'); // ディスカッション
	// remove_submenu_page('options-general.php', 'options-media.php'); // メディア
	// remove_submenu_page('options-general.php', 'options-permalink.php'); // パーマリンク設定
	remove_submenu_page('options-general.php', 'privacy.php'); // プライバシー
}
add_action('admin_menu', 'remove_menus', 999);



/**
 * 【管理画面】テーマエディタ非表示
 */
define('DISALLOW_FILE_EDIT', true);



/**
 * 【管理画面】メディアに位置移動
 */
function customize_menus(){
  global $menu;
  // $menu[57] = $menu[4]; // セパレータ
  $menu[58] = $menu[10]; // メディア
  unset($menu[10]);
}
add_action('admin_menu', 'customize_menus');



/**
 * 【管理画面】ダッシュボードの不要な項目削除
 */
function remove_dashboard_widgets() {
  global $wp_meta_boxes;
  // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況(概要)
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイックドラフト(クイック投稿)
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
  unset($wp_meta_boxes['dashboard']['normal']['core']['jetpack_summary_widget']); // jetpack
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // フォーラム
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // アクティビティ
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
// remove_action('welcome_panel', 'wp_welcome_panel'); //ようこそ



/**
 * 【管理画面】メタボックス削除
 */
function remove_post_support() {
	// remove_post_type_support('post','title'); // タイトル
	// remove_post_type_support('post','editor'); // 本文

	if(!USE_POST_TAGS)
		unregister_taxonomy_for_object_type('post_tag', 'post'); // タグ
	if(!USE_THUMBNAIL)
		remove_post_type_support('post','thumbnail'); // アイキャッチ画像
	remove_post_type_support('post','author'); // 作成者
	remove_post_type_support('post','excerpt'); // 抜粋
	remove_post_type_support('post','trackbacks'); // トラックバック
	remove_post_type_support('post','custom-fields'); // カスタムフィールド
	remove_post_type_support('post','comments'); // コメント
	remove_post_type_support('post','revisions'); // リビジョン
	remove_post_type_support('post','page-attributes'); // 表示順
	remove_post_type_support('post','post-formats'); // 投稿フォーマット
	unregister_taxonomy_for_object_type('category', 'post'); // カテゴリ

	if(!USE_THUMBNAIL)
		remove_post_type_support('page','thumbnail'); // 固定ページアイキャッチ画像
	remove_post_type_support('page','author'); // 作成者
	remove_post_type_support('page','excerpt'); // 抜粋
	remove_post_type_support('page','trackbacks'); // トラックバック
	remove_post_type_support('page','custom-fields'); // カスタムフィールド
	remove_post_type_support('page','comments'); // コメント
	remove_post_type_support('page','revisions'); // リビジョン
	remove_post_type_support('page','page-attributes'); // 表示順
	remove_post_type_support('page','post-formats'); // 投稿フォーマット

}
add_action('init','remove_post_support');

// 古い？ /////////////////////////////////////////////////
// function remove_metabox() {
// 	remove_meta_box('postcustom', 'post', 'normal');
// 	remove_meta_box('postexcerpt', 'post', 'normal');
// 	remove_meta_box('commentsdiv', 'post', 'normal');
// 	remove_meta_box('trackbacksdiv', 'post', 'normal');
// 	remove_meta_box('commentstatusdiv', 'post', 'normal');
// 	remove_meta_box('authordiv', 'post', 'normal');
// 	remove_meta_box('revisionsdiv', 'post', 'normal');
// 	remove_meta_box('slugdiv', 'post', 'normal');
// 	if(!USE_POST_TAGS)
// 		remove_meta_box('tagsdiv-post_tag', 'post', 'side');

// 	remove_meta_box('postcustom', 'page', 'normal');
// 	remove_meta_box('postexcerpt', 'page', 'normal');
// 	remove_meta_box('commentsdiv', 'page', 'normal');
// 	remove_meta_box('tagsdiv-post_tag', 'page', 'side');
// 	remove_meta_box('trackbacksdiv', 'page', 'normal');
// 	remove_meta_box('commentstatusdiv', 'page', 'normal');
// 	remove_meta_box('authordiv', 'page', 'normal');
// 	remove_meta_box('revisionsdiv', 'page', 'normal');
// }
// add_action('admin_init', 'remove_metabox');



/**
 * 【管理画面】記事一覧画面の不要な項目を削除
 */
// 古い？ /////////////////////////////////////////////////
// function custom_columns($columns) {
// 	if(!USE_POST_TAGS)
// 		unset($columns['tags']);

// 	if(!USE_COMMENT)
// 		unset($columns['comments']);

// 	return $columns;
// }
// add_filter('manage_posts_columns', 'custom_columns');
// add_filter('manage_pages_columns', 'custom_columns');



/**
 * 【管理画面】ビジュアルエディタの整形機能を調整
 */
// remove_filter('the_content', 'wpautop');
// remove_filter('the_content', 'wptexturize');
// function of_override_mce_options($init_array)
// {
// 	global $allowedposttags;

// 	$init_array['valid_elements']          = '*[*]';
// 	$init_array['extended_valid_elements'] = '*[*]';
// 	$init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
// 	$init_array['indent']                  = true;
// 	$init_array['wpautop']                 = false;
// 	$init_array['force_p_newlines']        = false;

// 	return $init_array;
// }
// add_filter('tiny_mce_before_init', 'of_override_mce_options');
