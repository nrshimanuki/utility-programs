<?php

/**
 * URL設定
 */
// add_rewrite_rule('blog/([^0-9][^/]+)/?$', 'index.php?blog_category=$matches[1]', 'top');
// add_rewrite_rule('blog/([^0-9][^/]+)/?/page/?([0-9]{1,})/?$', 'index.php?blog_category=$matches[1]&paged=$matches[2]', 'top');



/**
 * フロントエンドで管理ツールバーの非表示化
 */
// add_filter('show_admin_bar', '__return_false');



/**
 * wp_head内の不要な項目の削除
 */
// remove_action('wp_head', 'feed_links', 2);
// remove_action('wp_head', 'feed_links_extra', 3);
// remove_action('wp_head', 'rsd_link');
// remove_action('wp_head', 'wlwmanifest_link');
// remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
// remove_action('wp_head', 'wp_generator');
// remove_action('wp_head', 'rel_canonical');
// remove_action('wp_head', 'index_rel_link');
// remove_action('wp_head', 'parent_post_rel_link', 10, 0);
// remove_action('wp_head', 'start_post_rel_link', 10, 0);
// remove_action('wp_head', 'wp_shortlink_wp_head');
// remove_action('wp_head', 'print_emoji_detection_script', 7);
// remove_action('wp_head', 'wp_oembed_add_discovery_links');
// remove_action('wp_head', 'rest_output_link_wp_head');
// remove_action('wp_head', 'wp_oembed_add_host_js');
// remove_action('wp_print_styles', 'print_emoji_styles');



/**
 * titleタグ セパレータ出力
 */
function custom_title_separator($sep) {
	$sep = '|';
	return $sep;
}
add_filter('document_title_separator', 'custom_title_separator');



/**
 * カスタムクエリ変数追加
 */
// function add_query_vars_filter( $vars ) {
//   $vars[] = "calendar_year";
//   $vars[] = "calendar_month";
//   return $vars;
// }
// add_filter( 'query_vars', 'add_query_vars_filter' );



/**
 * WordPress標準で読み込むjQueryの削除
 */
// function of_delete_local_jquery()
// {
// 	if(!is_admin())
// 		wp_deregister_script('jquery');
// }
// add_action('wp_enqueue_scripts', 'of_delete_local_jquery');



/**
 * the_excerptのpタグを削除
 */
// remove_filter('the_excerpt', 'wpautop');



/**
 * contentの抜粋文字数
 */
// function excerpt_length($length) {
//  return 28;
// }
// add_filter('excerpt_length', 'excerpt_length');



/**
 * contactform7 p,brタグを削除
 */
// add_filter('wpcf7_autop_or_not', '__return_false');



/**
 * contactform7 メールアドレス再確認チェック
 */
// function wpcf7_main_validation_filter( $result, $tag ) {
// 	$type = $tag['type'];
// 	$name = $tag['name'];
// 	$_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
// 	if ( 'email' == $type || 'email*' == $type ) {
// 		if (preg_match('/(.*)_confirm$/', $name, $matches)){
// 			$target_name = $matches[1];
// 			if ($_POST[$name] != $_POST[$target_name]) {
// 				if (method_exists($result, 'invalidate')) {
// 					$result->invalidate( $tag,"確認用のメールアドレスが一致していません");
// 			} else {
// 					$result['valid'] = false;
// 					$result['reason'][$name] = '確認用のメールアドレスが一致していません';
// 				}
// 			}
// 		}
// 	}
// 	return $result;
// }
// add_filter('wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2);
// add_filter('wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2);



/**
 * Contact Form 7のエラーメッセージの場所を必要な項目のみ変更
 */
// function wpcf7_custom_item_error_position( $items, $result ) {
// 	// メッセージを表示させたい場所のタグのエラー用のクラス名
// 	$class = 'wpcf7-custom-item-error';
// 	// メッセージの位置を変更したい項目名
// 	$names = array( 'birth', 'month', 'month_day', 'age' );

// 	// 入力エラーがある場合
// 	if ( isset( $items['invalidFields'] ) ) {
// 		foreach ( $items['invalidFields'] as $k => $v ) {
// 			$orig = $v['into'];
// 			$name = substr( $orig, strrpos($orig, ".") + 1 );
// 			// 位置を変更したい項目のみ、エラーを設定するタグのクラス名を差替
// 			if ( in_array( $name, $names ) ) {
// 				$items['invalidFields'][$k]['into'] = ".{$class}.{$name}";
// 			}
// 		}
// 	}
// 	return $items;
// }
// add_filter('wpcf7_ajax_json_echo', 'wpcf7_custom_item_error_position', 10, 2);



/**
 * 記事公開時にタイトルに日付を付与する
 */
// function add_date_to_title() {
// 	if (!empty($_POST['publish']) && $_POST['post_type'] == 'calendar') {
// 		$args = $_POST;
// 		$post_title = $_POST['post_title'] . '__' . date('Ymd');
// 		$args['post_title'] = $post_title;
// 		wp_update_post($args);
// 	}
// 	add_action('save_post', 'update_post');
// }
// add_action( 'new_to_publish', 'add_date_to_title' );
// add_action( 'pending_to_publish', 'add_date_to_title' );
// add_action( 'draft_to_publish', 'add_date_to_title' );
// add_action( 'auto-draft_to_publish', 'add_date_to_title' );
// add_action( 'future_to_publish', 'add_date_to_title' );
// add_action( 'private_to_publish', 'add_date_to_title' );



/**
 * カレンダーの予約投稿機能を無効にする
 */
// function stop_post_status_future_func($data, $postarr) {
// 	if (($data['post_type'] == 'calendar' && $data['post_status'] == 'future') && $postarr['post_status'] == 'publish') {
// 		$data['post_status'] = 'publish';
// 	}
// 	return $data;
// };
// add_filter( 'wp_insert_post_data', 'stop_post_status_future_func', 10, 2 );

