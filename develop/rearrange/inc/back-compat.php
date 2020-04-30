<?php

const REQUIRED_PHP_VER = '5.4';
const REQUIRED_WP_VER  = '4.7';

// define( 'REQUIRED_PHP_VER ', '5.4' );
// define( 'REQUIRED_WP_VER', '4.7' );

$message['php'] = sprintf( 'RearrangeにはPHP %s以降のバージョンが必要です。現在ご利用中のバージョンは%sです。アップグレードしてもう一度お試しください。', REQUIRED_PHP_VER, PHP_VERSION );
$message['wp']  = sprintf( 'RearrangeにはWordPress %s以降のバージョンが必要です。現在ご利用中のバージョンは%sです。アップグレードしてもう一度お試しください。', REQUIRED_WP_VER, $GLOBALS['wp_version'] );

function rearrange_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'rearrange_upgrade_notice' );
}
add_action( 'after_switch_theme', 'rearrange_switch_theme' );

function rearrange_upgrade_notice() {
    global $message;
    $msg = '';

    if ( version_compare( PHP_VERSION, REQUIRED_PHP_VER, '<' ) ) {
		$msg = $message['php'];
	} else {
		$msg = $message['wp'];
	}
	printf( '<div class="error"><p>%s</p></div>', $msg );
}

function rearrange_load_customize() {
    global $message;

	if ( version_compare( PHP_VERSION, REQUIRED_PHP_VER, '<' ) ) {
		wp_die( $message['php'], '', [ 'back_link' => true ] );
	} else {
		wp_die( $message['wp'], '', [ 'back_link' => true ] );
	}
}
add_action( 'load-customize.php', 'rearrange_load_customize' );

function rearrange_preview() {
    global $message;
	if ( isset( $_GET['preview'] ) ) {
		if ( version_compare( PHP_VERSION, REQUIRED_PHP_VER, '<' ) ) {
    		wp_die( $message['php'], '', [ 'back_link' => true ] );
    	} else {
    		wp_die( $message['wp'], '', [ 'back_link' => true ] );
    	}
	}
}
add_action( 'template_redirect', 'rearrange_preview' );
