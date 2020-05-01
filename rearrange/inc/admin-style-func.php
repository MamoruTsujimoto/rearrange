<?php

/*---------------------------------------------------------------------------
 * Rearrange管理画面スタイル
 *---------------------------------------------------------------------------*/

/* カスタマイザー用CSS */
add_action( 'admin_enqueue_scripts', function() {

  $page = isset( $_GET['page'] ) ? $_GET['page'] : '';
  if ( 'rearrange' !== $page ) {
    return;
  }

  wp_enqueue_style( 'rearrange-setting', PARENT_CSS . '/admin/setting.css' );
  wp_enqueue_style( 'admin-notosansjapanese', PARENT_CSS . '/custom-notosansjapanese.min.css' );

} );

function rearrange_login_style() {
  wp_enqueue_style( 'custom-login', PARENT_CSS . '/admin/login.css' );
}
add_action( 'login_enqueue_scripts', 'rearrange_login_style' );
