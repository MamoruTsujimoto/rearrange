<?php

add_action( 'customize_register' , function( $wp_customize ) {

    /*---------------------------------------------------------------------------
     * サイト基本情報
     *---------------------------------------------------------------------------*/
    /* サイトタイトルの文字の大きさ */
    $wp_customize->add_setting( 'title_tagline[title_font_size]', [
        'default'           => 'M',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'title_tagline_title_font_size', [
        'settings'    => 'title_tagline[title_font_size]',
        'label'       => 'サイトタイトルの文字の大きさ',
        'section'     => 'title_tagline',
        'type'        => 'select',
        'choices'     => [
            'XS' => 'XS',
            'S'  => 'S',
            'M'  => 'M',
            'L'  => 'L',
            'XL' => 'XL'
        ]
    ] );
    
    /* サイトタイトル・キャッチフレーズの横幅 */
    $wp_customize->add_setting( 'title_tagline[title_max_width]', [
        'default'           => 'default',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'title_tagline_title_max_width', [
        'settings'    => 'title_tagline[title_max_width]',
        'label'       => 'サイトタイトル・キャッチフレーズの横幅（ブラウザ幅1281px以上時のみ有効）',
        'section'     => 'title_tagline',
        'type'        => 'select',
        'choices'     => [
            'default' => 'デフォルト（400px）',
            '40'      => '40%',
            '50'      => '50%',
            '60'      => '60%',
            '70'      => '70%'
        ]
    ] );
    
    /* サイトタイトルを改行する */
    $wp_customize->add_setting( 'title_tagline[wrap_title]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'title_tagline_wrap_title', [
        'settings'    => 'title_tagline[wrap_title]',
        'label'       => 'サイトタイトルを改行する',
        'section'     => 'title_tagline',
        'type'        => 'checkbox'
    ] );
    
    /* キャッチフレーズを表示する */
    $wp_customize->add_setting( 'title_tagline[show_tagline]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'title_tagline_tagline', [
        'settings'    => 'title_tagline[show_tagline]',
        'label'       => 'キャッチフレーズを表示する',
        'section'     => 'title_tagline',
        'type'        => 'checkbox'
    ] );
    
    /* キャッチフレーズを改行する */
    $wp_customize->add_setting( 'title_tagline[wrap_tagline]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'title_tagline_wrap_tagline', [
        'settings'    => 'title_tagline[wrap_tagline]',
        'label'       => 'キャッチフレーズを改行する',
        'section'     => 'title_tagline',
        'type'        => 'checkbox'
    ] );
    

    /*---------------------------------------------------------------------------
     * カラー
     *---------------------------------------------------------------------------*/
    $wp_customize->add_setting( 'front_color[item]', [
        'default'           => 'blue_green',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'front_color_item', [
        'settings'    => 'front_color[item]',
        'label'       => 'カラー設定',
        'description' => 'メインカラー：リンク、ボタン、リスト等<br>サブカラー　：カテゴリ背景、リスト等',
        'section'     => 'colors',
        'type'        => 'radio',
        'choices'     => [
            'blue_green'   => 'メイン：ブルー　　サブ：グリーン',
            'green_blue'   => 'メイン：グリーン　サブ：ブルー',
            'pink_blue'    => 'メイン：ピンク　　サブ：ブルー',
            'blue_pink'    => 'メイン：ブルー　　サブ：ピンク',
            'yellow_green' => 'メイン：イエロー　サブ：グリーン',
            'green_yellow' => 'メイン：グリーン　サブ：イエロー',
            'orange_pink'  => 'メイン：オレンジ　サブ：ピンク',
            'pink_orange'  => 'メイン：ピンク　　サブ：オレンジ'
        ]
    ] );

    /*---------------------------------------------------------------------------
     * カラム
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_column', [
        'title'    => 'カラム',
        'priority' => 50
    ] );
    
    $wp_customize->add_setting( 'column[position]', [
        'default'           => 'r-column',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_column_position', [
        'settings' => 'column[position]',
        'label'    => 'サイドバーの位置',
        'section'  => 'rearrange_column',
        'type'     => 'radio',
        'choices'  => [
            'r-column' => '右',
            'l-column' => '左',
        ]
    ] );
    
    /*---------------------------------------------------------------------------
     * Lazy Load（遅延読み込み）
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_lazy_load', [
        'title'             => 'Lazy Load（遅延読み込み）',
        'priority'          => 90,
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    /* 表示設定 */
    $wp_customize->add_setting( 'lazy_load[enable]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_lazy_load_enable', [
        'settings'    => 'lazy_load[enable]',
        'label'       => '有効にする',
        'description' => '※デフォルト対応：記事一覧、スライダー、関連記事',
        'section'     => 'rearrange_lazy_load',
        'type'        => 'checkbox'
    ] );
    
    
    /*---------------------------------------------------------------------------
     * Godモード（非同期画面遷移）
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_god_mode', [
        'title'             => 'Godモード（非同期画面遷移）',
        'priority'          => 100,
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    /* 有効化 */
    $wp_customize->add_setting( 'god_mode[enable]', [
        'default'           => false,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_god_mode_enable', [
        'settings' => 'god_mode[enable]',
        'label'    => '有効にする',
        'description' => '<p>非同期で画面遷移します。<br /><strong><small>※導入しているプラグインや
                JavaScript広告が正常に動作しない可能性があります。</small></strong></p>',
        'section'  => 'rearrange_god_mode',
        'type'     => 'checkbox'
    ] );
    
    /* ローディングインジケーター */
    $wp_customize->add_setting( 'god_mode[li][enable]', [
        'default'           => false,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_god_mode_li_enable', [
        'settings' => 'god_mode[li][enable]',
        'label'    => 'ローディングインジケーターを表示する',
        'section'  => 'rearrange_god_mode',
        'type'     => 'checkbox'
    ] );
    
    
    /*---------------------------------------------------------------------------
     * フォント
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_fonts', [
        'title'    => 'フォント',
        'priority' => 250
    ] );
    
    /* 種類 */
    $wp_customize->add_setting( 'fonts[type]', [
        'default'           => 'none',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_fonts_type', [
        'settings' => 'fonts[type]',
        'label'    => 'フォント',
        'section'  => 'rearrange_fonts',
        'type'     => 'radio',
        'choices'  => [
            'none' => '指定なし',
            'Noto_Sans_Japanese'  => 'Noto Sans Japanese',
        ]
    ] );
    
    
    /*---------------------------------------------------------------------------
     * 投稿
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_entry', [
        'title'    => '投稿',
        'priority' => 252
    ] );
    
    /* pタグ、改行タグの自動挿入を停止 */
    $wp_customize->add_setting( 'entry[remove_wpautop]', [
        'default'           => false,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_entry_remove_wpautop', [
        'settings' => 'entry[remove_wpautop]',
        'label'    => 'pタグ、改行タグの自動挿入を停止する',
        'section'  => 'rearrange_entry',
        'type'     => 'checkbox'
    ] );
    
    
    /*---------------------------------------------------------------------------
     * 記事一覧
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_entry_list', [
        'title'    => '記事一覧',
        'priority' => 253
    ] );
    
    /* カテゴリー */
    $wp_customize->add_setting( 'entry_list[show_category]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_entry_list_show_category', [
        'settings' => 'entry_list[show_category]',
        'label'    => 'カテゴリーを表示する',
        'section'  => 'rearrange_entry_list',
        'type'     => 'checkbox'
    ] );
    
    /* 抜粋 */
    $wp_customize->add_setting( 'entry_list[show_excerpt]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_entry_list_show_excerpt', [
        'settings' => 'entry_list[show_excerpt]',
        'label'    => '抜粋を表示する',
        'section'  => 'rearrange_entry_list',
        'type'     => 'checkbox'
    ] );
    
    /* 日付 */
    $wp_customize->add_setting( 'entry_list[show_date]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_entry_list_show_date', [
        'settings' => 'entry_list[show_date]',
        'label'    => '日付を表示する',
        'section'  => 'rearrange_entry_list',
        'type'     => 'checkbox'
    ] );


    /*---------------------------------------------------------------------------
     * ソーシャルメディアボタン
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_social_media', [
        'title'    => 'ソーシャルメディアボタン',
        'priority' => 255
    ] );
    
    /* 表示 */
    $wp_customize->add_setting( 'social_media[show_footer]', [
        'default'           => false,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_social_show_media', [
        'settings' => 'social_media[show_footer]',
        'label'    => 'フッターに表示する',
        'section'  => 'rearrange_social_media',
        'type'     => 'checkbox',
    ] );
    
    /* カラー */
    $wp_customize->add_setting( 'social_media[color]', [
        'default'           => 'tp_color',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_social_media_color', [
        'settings' => 'social_media[color]',
        'label'    => 'カラー',
        'section'  => 'rearrange_social_media',
        'type'     => 'radio',
        'choices'  => [
            'tp_color' => '背景なし カラーアイコン（デフォルト）',
            'tp_gray'  => '背景なし グレーアイコン',
            'round'    => 'カラーラウンド背景 ホワイトアイコン',
        ]
    ] );
    
    /* アカウント */
    $media = [
        'instagram'     => 'Instagram（ユーザーネーム）',
        'facebook_page' => 'Facebookページ（ページID）',
        'twitter'       => 'Twitter（ユーザー名）',
        'line_at'       => 'LINE@（友だち追加URL）',
        'youtube'       => 'YouTube（チャンネルID）',
        'skype'         => 'Skype（Skype ID）',
        'googleplus'    => 'Google+（プロフィールorページID）',
        'github'        => 'GitHub（ユーザーネーム）',
        'pinterest'     => 'Pinterest（ユーザー名）',
        'soundcloud'    => 'SoundCloud（プロフィールID）',
        'linkedin'      => 'LinkedIn（プロフィールID）'
    ];
    
    foreach( $media as $media_en => $media_ja ) {
        $sc_description = '';
        switch ( $media_en ) {
            case 'soundcloud':
                $sc_description = 'Profile URLの"soundcloud.com/"以降';
                break;
            
            case 'linkedin':
                $sc_description = 'Profile URLの"www.linkedin.com/in/"以降';
                break;
            
            default:
                # code...
                break;
        }
        $wp_customize->add_setting( 'social_media[accounts]['.$media_en.']', [
            'default'           => '',
            'type'              => 'theme_mod',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'rearrange_customizer_sanitize'
        ] );
        
        $wp_customize->add_control( 'rearrange_social_media_accounts'.$media_en, [
            'settings'    => 'social_media[accounts]['.$media_en.']',
            'label'       => $media_ja,
            'section'     => 'rearrange_social_media',
            'type'        => 'text',
            'description' => $sc_description
        ] );
    }
    
    /*---------------------------------------------------------------------------
     * ソーシャルシェアボタン
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_social_share', [
        'title'             => 'ソーシャルシェアボタン',
        'priority'          => 260,
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    /* 表示ページ */
    // $pages = [ 'single' => '記事ページに表示する', 'page' => '固定ページに表示する' ];
    // foreach ( $pages as $page_en => $page_ja) {
    //     $wp_customize->add_setting( 'social_share[show_'.$page_en.']', [
    //         'default'           => true,
    //         'type'              => 'theme_mod',
    //         'transport'         => 'postMessage',
    //         'sanitize_callback' => 'rearrange_customizer_sanitize'
    //     ] );
        
    //     $wp_customize->add_control( 'rearrange_social_share_show_'.$page_en, [
    //         'settings' => 'social_share[show_'.$page_en.']',
    //         'label'    => $page_ja,
    //         'section'  => 'rearrange_social_share',
    //         'type'     => 'checkbox'
    //     ] );
    // }
    
    /* 表示位置 */
    $share = [ 'top' => '記事タイトル下に表示する', 'bottom' => '記事本文下に表示する' ];
    foreach ( $share as $position_en => $position_ja) {
        $wp_customize->add_setting( 'social_share[show_'.$position_en.']', [
            'default'           => true,
            'type'              => 'theme_mod',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'rearrange_customizer_sanitize'
        ] );
        
        $wp_customize->add_control( 'rearrange_social_share_show_'.$position_en, [
            'settings' => 'social_share[show_'.$position_en.']',
            'label'    => $position_ja,
            'section'  => 'rearrange_social_share',
            'type'     => 'checkbox'
        ] );
    }
    
    /* カラー */
    $wp_customize->add_setting( 'social_share[color]', [
        'default'           => 'tp_white',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_social_share_color', [
        'settings' => 'social_share[color]',
        'label'    => 'カラー',
        'section'  => 'rearrange_social_share',
        'type'     => 'radio',
        'choices'  => [
            'tp_white' => '背景なし ホワイト(記事本文下はグレー)アイコン（デフォルト）',
            'round'    => 'カラーラウンド背景 ホワイトアイコン',
        ]
    ] );
    
    /* アイコン表示設定 */
    $share_icons = [
        'facebook'   => 'Facebook',
        'twitter'    => 'Twitter',
        'hatena'     => 'はてなブックマーク',
        'googleplus' => 'Google+',
        'pocket'     => 'Pocket',
        'feedly'     => 'Feedly',
        'linkedin'   => 'LinkedIn',
        'line'       => 'LINE'
    ];
    
    foreach ( $share_icons as $share_en => $share_ja) {
        $wp_customize->add_setting( 'social_share[show_buttons]['.$share_en.']', [
            'default'           => true,
            'type'              => 'theme_mod',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'rearrange_customizer_sanitize'
        ] );
        
        $wp_customize->add_control( 'rearrange_social_share_show_'.$share_en, [
            'settings' => 'social_share[show_buttons]['.$share_en.']',
            'label'    => $share_ja,
            'section'  => 'rearrange_social_share',
            'type'     => 'checkbox'
        ] );
    }
    
    /* シェア数 */
    /*$wp_customize->add_setting( 'social_share[show_counts]', [
        'default'   => '',
        'type'      => 'theme_mod',
        'transport' => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'social_share_show_counts', [
        'settings'  => 'social_share[show_counts]',
        'label'     => 'シェア数を表示する',
        'section'   => 'rearrange_social_share',
        'type'      => 'checkbox'
    ] );*/
    
    
    /*---------------------------------------------------------------------------
     * スライダー
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_slider', [
        'title'             => 'スライダー',
        'priority'          => 265,
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    /* 表示設定 */
    $wp_customize->add_setting( 'slider[show]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_slider_show', [
        'settings' => 'slider[show]',
        'label'    => '表示する',
        'section'  => 'rearrange_slider',
        'type'     => 'checkbox'
    ] );
    
    /* 表示件数 */
    $wp_customize->add_setting( 'slider[show_counts]', [
        'default'           => 5,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_slider_show_counts', [
        'settings' => 'slider[show_counts]',
        'label'    => '表示件数',
        'section'  => 'rearrange_slider',
        'type'     => 'radio',
        'choices'  => [
            '5'  => '5件（デフォルト）',
            '10' => '10件'
        ]
    ] );
    
    /*---------------------------------------------------------------------------
     * 関連記事
     *---------------------------------------------------------------------------*/
    $wp_customize->add_section( 'rearrange_related_entry', [
        'title'             => '関連記事',
        'priority'          => 270,
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    /* 表示設定 */
    $wp_customize->add_setting( 'related_entry[show]', [
        'default'           => true,
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'rearrange_customizer_sanitize'
    ] );
    
    $wp_customize->add_control( 'rearrange_related_entry_show', [
        'settings' => 'related_entry[show]',
        'label'    => '表示する',
        'section'  => 'rearrange_related_entry',
        'type'     => 'checkbox'
    ] );
    
} );
    
    
add_action( 'customize_preview_init' , function() {
    wp_enqueue_script( 
        'mytheme-themecustomizer',
        PARENT_JS . '/rearrange-customizer.js',
        [ 'jquery', 'customize-preview' ],
        1.0,
        true
    );
} );
    

if ( ! function_exists( 'rearrange_customizer_sanitize' ) ) :
    function rearrange_customizer_sanitize( $input, $setting ) {
        return $input;
    }
endif;
