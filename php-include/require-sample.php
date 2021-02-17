<?php
// WP専用ディレクトリ:
// require_once( dirname( __FILE__ ) . '/wp/wp-blog-header.php' );
// パーマリンクを変更すると .htaccess が書き換えられてしまうので、パーミッションを読み取りのみに変更する
?>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/assets/inc/__constant.php');
	$page_slug        = INDEX_PAGE_SLUG;
	$meta_title       = INDEX_META_TITLE . '｜' . SITE_TITLE;
	$meta_description = INDEX_META_DESCRIPTION;
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/inc/_header.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/inc/_sidebar.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/inc/_footer.php'); ?>
