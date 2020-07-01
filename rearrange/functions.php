<?php
if ( basename( $_SERVER['SCRIPT_NAME'] ) === basename(__FILE__) ) {
  exit;
}

define( 'THEME',  get_option( 'stylesheet' ) );
define( 'PARENT',  get_parent_theme_file_uri() );
define( 'PARENT_CSS',  PARENT . '/assets/css' );
define( 'PARENT_JS',  PARENT . '/assets/js' );
define( 'PARENT_INC',  get_parent_theme_file_path() . '/inc' );
define( 'PLACEHOLDER_IMAGE',  'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );

/*---------------------------------------------------------------------------
 * グローバル変数
 *---------------------------------------------------------------------------*/
$rearrange = get_option( 'theme_mods_' . THEME );
$rearrange['base_url'] = get_bloginfo('url');
$rearrange['categories'] = init_category();


/*---------------------------------------------------------------------------
 * バージョンチェック
 *---------------------------------------------------------------------------*/
$php_ver_compare = version_compare( PHP_VERSION, '5.4', '<' );
$wp_ver_compare  = version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' );

if ( $php_ver_compare || $wp_ver_compare ) {
  require PARENT_INC . '/back-compat.php';
  if( false !== defined( 'WP_DEFAULT_THEME' ) ) {
    switch_theme( WP_DEFAULT_THEME );
  } else {
    switch_theme( 'default' );
  }
  return;
}


/*---------------------------------------------------------------------------
 * オプション
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/default-option.php';


/*---------------------------------------------------------------------------
 * デバッグ
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/debug.php';


/*---------------------------------------------------------------------------
 * wp_head関連
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/head-func.php';


/*---------------------------------------------------------------------------
 * 管理画面スタイル
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/admin-style-func.php';


/*---------------------------------------------------------------------------
 * ウィジェットの登録
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/register-widgets.php';


/*---------------------------------------------------------------------------
 * カスタムウィジェット
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/custom-widgets.php';


/*---------------------------------------------------------------------------
 * Godモード
 *---------------------------------------------------------------------------*/
//require PARENT_INC . '/god-func.php';


/*---------------------------------------------------------------------------
 * Setting
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/setting.php';


/*---------------------------------------------------------------------------
 * カスタマイザー
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/customizer.php';


/*---------------------------------------------------------------------------
 * セキュリティー
 *---------------------------------------------------------------------------*/
// require PARENT_INC . '/security-func.php';


/*---------------------------------------------------------------------------
 * 投稿画面
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/posts-screen-func.php';


/*---------------------------------------------------------------------------
 * 検索
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/search-func.php';


/*---------------------------------------------------------------------------
 * ショートコード
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/shortcodes.php';


/*---------------------------------------------------------------------------
 * クイックタグ
 *---------------------------------------------------------------------------*/
require PARENT_INC . '/quicktags.php';


/*---------------------------------------------------------------------------
 * テーマサポート
 *---------------------------------------------------------------------------*/
add_action( 'after_setup_theme', function() {

  /* カスタムメニューの登録 */
  register_nav_menus( [
    'global' => 'グローバルナビ',
    'footer' => 'フッター'
  ] );

  /* titleタグ */
  add_theme_support( 'title-tag' );

  /* アイキャッチ */
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'square-small',     160, 160, true ); // 一覧SP
  add_image_size( 'square-large',     320, 320, true ); // 関連記事 正方形 SP
  add_image_size( 'rectangle-small',  184, 117, true ); // 個別記事アイキャッチ SP
  add_image_size( 'rectangle-medium', 368, 234, true ); // 個別記事アイキャッチ PC、関連記事 長方形PC、
  add_image_size( 'rectangle-large',  600, 358, true ); // 関連記事 長方形SP

  /* headerでの投稿とコメントのRSSフィードのリンクを有効にします */
  add_theme_support( 'automatic-feed-links' );

  /* テキストドメインの警告回避 */
  __( 'rearrange', 'rearrange' );

  /* ヘッダー画像 */
  $ch_param = [
    'width'       => 750,
    'height'      => 200,
    'header-text' => false
  ];
  add_theme_support( 'custom-header', $ch_param );

  /* 背景色・背景画像 */
  $cb_param = [
    'default-color' => 'F2F1F3',
  ];
  add_theme_support( 'custom-background', $cb_param );

  /* 固定ページで抜粋を有効化 */
  add_post_type_support( 'page', 'excerpt' );

  /* ウィジェットでショートコードを有効化 */
  add_filter( 'widget_text', 'do_shortcode' );

} );


/*---------------------------------------------------------------------------
 * オリジナルアバダーを追加
 *---------------------------------------------------------------------------*/
add_filter( 'avatar_defaults', function( $avatar_defaults ) {
  $avatar_url = get_theme_file_uri( '/images/rearrange-anonymous.png' );
  $avatar_defaults[$avatar_url] = 'rearrange Anonymous';
  return $avatar_defaults;
} );


/*---------------------------------------------------------------------------
 * 記事一覧の抜粋
 *---------------------------------------------------------------------------*/
// 抜粋の文字数
add_filter( 'excerpt_mblength', function() {
  return 120;
} );

// […]の変更
add_filter( 'excerpt_more', function( $more ) {
  return '…';
} );


/*---------------------------------------------------------------------------
 * タグクラウドの区切り空白文字削除（CSSでやるため）
 *---------------------------------------------------------------------------*/
add_filter( 'widget_tag_cloud_args', function( $args ) {
  $args['separator'] = '';
  return $args;
} );


/*---------------------------------------------------------------------------
 * post_class()からhentryを消す
 *---------------------------------------------------------------------------*/
add_filter( 'post_class', function( $post_class ) {
  $post_class = array_diff( $post_class, ['hentry'] );
  return $post_class;
} );


/*---------------------------------------------------------------------------
 * 画像の絶対パスからルートパスを取得する
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'rearrange_getimagesize' ) ) :
  function rearrange_getimagesize( $image ) {

    if ( false !== strpos( $image, '/uploads/' ) ) {
      preg_match( '/\/uploads(.+)$/', $image, $matches );
      return getimagesize( wp_upload_dir()['basedir'] . $matches[1] );
    } else {
      preg_match( '/\/themes\/rearrange(.+)$/', $image, $matches );
      return get_theme_file_path( $matches[1] );
    }

  }
endif;


/*---------------------------------------------------------------------------
 * pタグ、改行タグの自動挿入を停止
 *---------------------------------------------------------------------------*/
if ( isset( $rearrange['entry']['remove_wpautop'] ) && true === $rearrange['entry']['remove_wpautop'] ) {
  remove_filter( 'the_content', 'wpautop' );
}

/*---------------------------------------------------------------------------
 * カテゴリの整形
 *---------------------------------------------------------------------------*/
function init_category() {
  $cat_args = array(
    'orderby'      => 'name',
    'show_count'   => 0,
    'hierarchical' => 1,
    'exclude' => 1,
    'depth' => 0,
  );

  $cat_parents = get_categories($cat_args);
  $category = array();

  foreach($cat_parents as $cat_parent) {
    if($cat_parent->parent == 0) {
      array_push($category,$cat_parent);
    }
  }

  return $category;
}

/*---------------------------------------------------------------------------
 * 子カテゴリ判定
 *---------------------------------------------------------------------------*/
function in_child_category( $cat_data ) {
	foreach($cat_data as $data) {
		if($data->parent != 0) {
			return true;
		}
	}

	return false;
}

/*---------------------------------------------------------------------------
 * 特定カテゴリの検索エンジンブロック
 *---------------------------------------------------------------------------*/
add_action( 'wp_head', 'noindex_for_category' );
function noindex_for_category() {
  $cat_id = get_category_by_slug("secret");
  $cat_id = $cat_id->cat_ID;
  if( is_category($cat_id) ) {
    echo '<meta name="robots" content="noindex,follow" />'."\n";
  }else if( is_singular() ) {
    $cat = get_the_category();
    foreach($cat as $val) {
      if($cat_id === $val->term_id) {
        echo '<meta name="robots" content="noindex,follow" />'."\n";
      }
    }
  }
}

/*---------------------------------------------------------------------------
 * 更新日英語表記
 *---------------------------------------------------------------------------*/
add_filter('get_the_modified_time','modified_date_format');
function modified_date_format(){
  $modified_date_format = get_post_modified_time(get_option( 'date_format' ));
  return $modified_date_format;
}