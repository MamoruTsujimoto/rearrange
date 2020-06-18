<?php


/*---------------------------------------------------------------------------
 * デフォルトの設定値
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'rearrange_setup_options' ) ) :
  function rearrange_setup_options() {
    global $rearrange;

    if ( isset( $rearrange['head_tag'] ) ) {
      return;
    }

        /*---------------------------------------------------------------------------
         * 設定
         *---------------------------------------------------------------------------*/

        // headタグ
        $ogp_defaul_img = get_theme_file_uri( '/images/ogp-rectangle.png' );
        set_theme_mod( 'head_tag', [
          'canonical'           => 'on',
          'rss'                 => 'on',
          'atom'                => 'on',
          'facebook_ogp'        => 'on',
          'facebook_ogp_app_id' => '',
          'ogp_defaul_img'      => $ogp_defaul_img,
          'twitter_card'        => 'on',
          'twitter_card_type'   => 'summary_large_image',
          'twitter_user_name'   => ''
        ] );

        // titleタグ
        set_theme_mod( 'title_tag', [
          'separator'     => 'vertical_bar',
          'top_page_list' => 'site_title_catchphrase',
          'top_page_page' => 'site_title_catchphrase',
          'other_page'    => 'page_title_site_title'
        ] );

        // 検索

        // Google Analytics
        set_theme_mod( 'analytics', [
          'tag' => ''
        ] );

        // CSS
        set_theme_mod( 'css', [
          'load_parent_style' => 'on',
          'load_child_style'  => 'on',
        ] );

        // セキュリティ

        // その他
        set_theme_mod( 'other', [
          'emoji'     => 'on',
          'blog_tool' => 'on',
          'target_posts'=> '',
        ] );


        /*---------------------------------------------------------------------------
         * カスタマイザー
         *---------------------------------------------------------------------------*/
        // キャッチフレーズ
        set_theme_mod( 'title_tagline', [
          'show_tagline' => true
        ] );

        // カラー
        set_theme_mod( 'front_color', [
          'item' => 'blue_green'
        ] );

        // カラム
        set_theme_mod( 'column', [
          'position' => 'r-column'
        ] );

        // Lazy Load
        set_theme_mod( 'lazy_load', [
          'enable' => true
        ] );

        // フォント
        set_theme_mod( 'fonts', [
          'type' => 'none'
        ] );

        // 投稿
        set_theme_mod( 'entry', [
          'remove_wpautop'  => false
        ] );

        // 記事一覧
        set_theme_mod( 'entry_list', [
          'show_excerpt'  => true,
          'show_date'     => true,
          'show_category' => true,
        ] );

        // ソーシャルメディアボタン
        set_theme_mod( 'social_media', [
          'show_footer' => false,
          'color'       => 'tp_color',
          'accounts'    => [
            'instagram'     => '',
            'facebook_page' => '',
            'twitter'       => '',
            'line_at'       => '',
            'youtube'       => '',
            'skype'         => '',
            'googleplus'    => '',
            'github'        => '',
            'pinterest'     => '',
            'soundcloud'    => '',
            'linkedin'      => ''
          ]
        ] );

        // ソーシャルシェアボタン
        set_theme_mod( 'social_share', [
            // 'show_single'  => true,
            // 'show_page'    => true,
          'show_top'     => true,
          'show_bottom'  => true,
          'color'        => 'tp_white',
          'show_buttons' => [
            'facebook'   => true,
            'twitter'    => true,
            'hatena'     => true,
            'googleplus' => true,
            'pocket'     => true,
            'feedly'     => true,
            'linkedin'   => true,
            'line'       => true
          ]
        ] );

        // スライダー
        set_theme_mod( 'slider', [
          'show'        => false,
          'show_counts' => 5,
        ] );

        // 関連記事
        set_theme_mod( 'related_entry', [
          'show' => true
        ] );

      }
    endif;
    add_action( 'after_switch_theme', 'rearrange_setup_options' );

    ?>