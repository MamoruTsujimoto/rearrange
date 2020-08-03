<?php

/*---------------------------------------------------------------------------
 * ウィジェットの登録
 *---------------------------------------------------------------------------*/
add_action( 'widgets_init', function() {

    register_sidebar( [
        'name'          => 'トップコンテンツ',
        'id'            => 'top-contents'
    ] );

    register_sidebar( [
        'name'          => 'サイドバー',
        'id'            => 'sidebar',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ] );

    register_sidebar( [
        'name'          => 'サイドバー固定',
        'id'            => 'sidebar-fixed',
        'before_widget' => '<div id="fixed-side-content"><div class="widget-wrap">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ] );

    register_sidebar( [
        'name'          => '記事アイキャッチ下',
        'id'            => 'singular-entry-thumb-bottom',
        'before_widget' => '<aside><div class="widget-wrap">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<p>',
        'after_title'   => '</p>'
    ] );

    register_sidebar( [
        'name'          => '記事下',
        'id'            => 'singular-entry-bottom',
        'before_widget' => '<aside><div class="widget-wrap">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<p>',
        'after_title'   => '</p>'
    ] );

} );

