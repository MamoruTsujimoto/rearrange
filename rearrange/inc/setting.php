<?php

class RearrangeSetting {

  private $rearrange_settings;
  private $input;

  public function __construct() {
    add_action( 'admin_init', [ $this, 'rearrange_customizer_init' ] );
    add_action( 'admin_menu', [ $this, 'register_rearrange_customizer_page' ] );
    global $rearrange;
    $this->rearrange_settings = $rearrange;
  }

    /*---------------------------------------------------------------------------
     * フォームの登録
     *---------------------------------------------------------------------------*/
    public function rearrange_customizer_init() {

        /*---------------------------------------------------------------------------
         * headタグ
         *---------------------------------------------------------------------------*/
        register_setting( 'head_tag', 'rearrange_head_tag', [ $this, 'validation' ] );

        /* SEO */
        add_settings_section( 'head_tag_seo', 'SEO',
          function() {
            echo '';
          }, 'rearrange_head_tag' );

        // Canonicalタグ
        add_settings_field( 'canonical', 'canonicalを追加する',
          function() {
            $checked = isset( $this->rearrange_settings['head_tag']['canonical'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="canonical" name="rearrange_head_tag[head_tag][canonical]" ' . $checked . ' />
            <input type="hidden" id="head-tag" name="rearrange_head_tag[head_tag][dummy]" value="" />';
          }, 'rearrange_head_tag', 'head_tag_seo' );

        // RSS
        add_settings_field( 'rss', 'RSSフィードを追加する',
          function() {
            $checked = isset( $this->rearrange_settings['head_tag']['rss'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="rss" name="rearrange_head_tag[head_tag][rss]" ' . $checked . ' />';
          }, 'rearrange_head_tag', 'head_tag_seo' );

        // Atom
        add_settings_field( 'atom', 'Atomフィードを追加する',
          function() {
            $checked = isset( $this->rearrange_settings['head_tag']['atom'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="atom" name="rearrange_head_tag[head_tag][atom]" ' . $checked . ' />';
          }, 'rearrange_head_tag', 'head_tag_seo' );

        // Site Description
        add_settings_field( 'description', 'トップページのディスクリプション<p>※未入力の場合はキャッチフレーズが使用されます。</p>',
          function() {
            $description = isset( $this->rearrange_settings['head_tag']['description'] ) ? $this->rearrange_settings['head_tag']['description'] : '';
            echo '
            <textarea id="description" name="rearrange_head_tag[head_tag][description]" rows="10" cols="30"/>' . $description . '</textarea>';
          }, 'rearrange_head_tag', 'head_tag_seo' );


        /* Facebook OGP */
        add_settings_section( 'head_tag_facebook_ogp', 'Facebook OGP',
          function() {
            echo '';
          }, 'rearrange_head_tag' );

        // タグ追加
        add_settings_field( 'facebook_ogp', 'Facebook OGPタグを追加する',
          function() {
            $checked = isset( $this->rearrange_settings['head_tag']['facebook_ogp'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="facebook-ogp" name="rearrange_head_tag[head_tag][facebook_ogp]"' . $checked . ' />';
          }, 'rearrange_head_tag', 'head_tag_facebook_ogp' );

        // アプリID
        add_settings_field( 'facebook_ogp_app_id', 'アプリID（fb:app_id）<p>入力するとFacebookインサイトを利用できます。（オプション）</p>',
          function() {
            $app_id = $this->rearrange_settings['head_tag']['facebook_ogp_app_id'];
            echo '
            <input type="text" id="facebook-ogp-app-id" name="rearrange_head_tag[head_tag][facebook_ogp_app_id]" value="' . $app_id . '" />';
          }, 'rearrange_head_tag', 'head_tag_facebook_ogp' );

        // デフォルト画像
        add_settings_field( 'ogp_defaul_img', 'デフォルト画像（Facebook、Twitter共通）<p>投稿・固定ページ以外や投稿にアイキャッチが設定されていない場合に使われる画像を設定します。</p>',
          function() {
            wp_enqueue_media();
            $default_img = $this->rearrange_settings['head_tag']['ogp_defaul_img'];
            $p_style = '';
            $img_style = '';
            if ( empty( $default_img ) ) {
              $img_style = ' style="display: none;"';
            } else {
            	$p_style = ' style="display: none;"';
            }

            echo <<<EOF
            <p><img class="gp-image-view" src="{$default_img}" width="260"{$img_style} /></p>

            <input class="widefat gp-image-url" id="facebook-ogp-default-img" name="rearrange_head_tag[head_tag][ogp_defaul_img]" type="hidden" value="{$default_img}" />
            <button type="button" class="gp-select-image button">画像を選択</button>
            <button type="button" class="gp-delete-image button"{$img_style}>画像を削除</button>

            <script>
            jQuery(document).ready(function($) {

              let frame;
              const placeholder = $('.gp-img-placeholder');
              const imageUrl = $('.gp-image-url');
              const imageView = $('.gp-image-view');
              const deleteImage = $('.gp-delete-image');

              $('.gp-select-image').on('click', function(e) {
               e.preventDefault();

               if ( frame ) {
                frame.open();
                return;
              }

              frame = wp.media({
                title: 'Facebook OGPデフォルト画像を選択',
                library: {
                 type: 'image'
                 },
                 button: {
                   text: 'デフォルト画像に追加'
                   },
                   multiple: false
                   });

                   frame.on('select', function() {
                    let images = frame.state().get('selection');
                    images.each(function(file) {
                     placeholder.css('display', 'none');
                     imageUrl.val(file.toJSON().url);
                     imageView.attr('src', file.toJSON().url).css('display', 'block');
                     deleteImage.css('display', 'inline-block');
                     });
                     imageUrl.trigger('change');
                     });

                     frame.open();
                     });

                     $('.gp-delete-image').off().on('click', function(e) {
                       e.preventDefault();

                       imageUrl.val('');
                       imageView.css('display', 'none');
                       deleteImage.css('display', 'none');
                       imageUrl.trigger('change');
                       });

                       });
                       </script>
EOF;
                     }, 'rearrange_head_tag', 'head_tag_facebook_ogp' );


        /* Twitter カード */
        add_settings_section( 'head_tag_twitter_card', 'Twitterカード',
          function() {
            echo '';
          }, 'rearrange_head_tag' );

        // タグ追加
        add_settings_field( 'twitter_card', 'Twitterカードタグを追加する',
          function() {
            $checked = isset( $this->rearrange_settings['head_tag']['twitter_card'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="facebook" name="rearrange_head_tag[head_tag][twitter_card]"' . $checked . ' />';
          }, 'rearrange_head_tag', 'head_tag_twitter_card' );

        // カードタイプ
        add_settings_field( 'twitter_card_type', 'カードタイプ',
          function() {
            $s_checked = '';
            $sli_checked = '';
            $card_type = $this->rearrange_settings['head_tag']['twitter_card_type'];
            'summary' === $card_type ? $s_checked = 'checked' : $sli_checked = 'checked';
            echo '
            <p><label><input type="radio" id="twitter-card-type-summary" name="rearrange_head_tag[head_tag][twitter_card_type]" value="summary" '.$s_checked.' />summary</label></p>
            <p><label><input type="radio" id="twitter-card-type-summary-large" name="rearrange_head_tag[head_tag][twitter_card_type]" value="summary_large_image" ' . $sli_checked . ' />summary_large_image</label></p>';
          }, 'rearrange_head_tag', 'head_tag_twitter_card' );


        // ユーザー名
        add_settings_field( 'twitter_user_name', 'ユーザー名',
          function() {
            $user_name = $this->rearrange_settings['head_tag']['twitter_user_name'];
            echo '
            <input type="text" id="twitter_user_name" name="rearrange_head_tag[head_tag][twitter_user_name]" value="' . $user_name . '" placeholder="@ユーザー名" />';
          }, 'rearrange_head_tag', 'head_tag_twitter_card' );


        /*---------------------------------------------------------------------------
         * titleタグ
         *---------------------------------------------------------------------------*/
        register_setting( 'title_tag', 'rearrange_title_tag', [ $this, 'validation' ] );

        add_settings_section( 'title_tag', 'titleタグ',
          function() {
            echo '';
          }, 'rearrange_title_tag' );

        // セパレーター
        add_settings_field( 'separator', 'セパレーターの種類',
          function() {
            $v_checked = '';
            $ed_checked = '';
            $separator = $this->rearrange_settings['title_tag']['separator'];
            'en_dash' === $separator ? $ed_checked = 'checked' : $v_checked = 'checked';
            echo '
            <p><label><input type="radio" id="separator-h" name="rearrange_title_tag[title_tag][separator]" value="en_dash" ' . $ed_checked . ' /> – （エン・ダッシュ）</label></p>
            <p><label><input type="radio" id="separator-v" name="rearrange_title_tag[title_tag][separator]" value="vertical_bar" ' . $v_checked . ' /> | （バーティカルバー）</label></p>
            <input type="hidden" id="title-tag" name="rearrange_title_tag[title_tag][dummy]" value="" />';
          }, 'rearrange_title_tag', 'title_tag' );

        // トップーページ（一覧）
        add_settings_field( 'top_page_list', 'トップーページ（一覧）',
          function() {
            $st_checked = '';
            $stc_checked = '';
            $cst_checked = '';
            $tpl = $this->rearrange_settings['title_tag']['top_page_list'];
            if ( 'site_title' === $tpl ) {
              $st_checked = 'checked';
            } elseif ( 'site_title_catchphrase' === $tpl ) {
              $stc_checked = 'checked';
            } else {
              $cst_checked = 'checked';
            }
            echo '
            <p><label><input type="radio" id="site-title-list" name="rearrange_title_tag[title_tag][top_page_list]" value="site_title" ' . $st_checked . ' />サイト名</label></p>
            <p><label><input type="radio" id="site-title-catchphrase-list" name="rearrange_title_tag[title_tag][top_page_list]" value="site_title_catchphrase" ' . $stc_checked . ' />サイト名 – キャッチフレーズ</label></p>
            <p><label><input type="radio" id="catchphrase-site-title-list" name="rearrange_title_tag[title_tag][top_page_list]" value="catchphrase_site_title" ' . $cst_checked . ' />キャッチフレーズ – サイト名</label></p>';
          }, 'rearrange_title_tag', 'title_tag' );


        // トップーページ（固定ページ）
        add_settings_field( 'top_page_page', 'トップーページ（固定）',
          function() {
            $st_checked = '';
            $stc_checked = '';
            $cst_checked = '';
            $ptst_checked = '';
            $tpp = $this->rearrange_settings['title_tag']['top_page_page'];
            if ( 'site_title' === $tpp ) {
              $st_checked = 'checked';
            } elseif ( 'catchphrase_site_title' === $tpp ) {
              $cst_checked = 'checked';
            } elseif ( 'page_title_site_title' === $tpp ) {
              $ptst_checked = 'checked';
            } else {
              $stc_checked = 'checked';
            }
            echo '
            <p><label><input type="radio" id="site-title-page" name="rearrange_title_tag[title_tag][top_page_page]" value="site_title" ' . $st_checked . ' />サイト名</label></p>
            <p><label><input type="radio" id="site-title-catchphrase-page" name="rearrange_title_tag[title_tag][top_page_page]" value="site_title_catchphrase" ' . $stc_checked . ' />サイト名 – キャッチフレーズ</label></p>
            <p><label><input type="radio" id="catchphrase-site-title-page" name="rearrange_title_tag[title_tag][top_page_page]" value="catchphrase_site_title" ' . $cst_checked . ' />キャッチフレーズ – サイト名</label></p>
            <p><label><input type="radio" id="page-title-site-title-page" name="rearrange_title_tag[title_tag][top_page_page]" value="page_title_site_title" ' . $ptst_checked . ' />ページタイトル – サイト名</label></p>';
          }, 'rearrange_title_tag', 'title_tag' );


        // その他のページ
        add_settings_field( 'other_page', 'その他のページ',
          function() {
            $pt_checked = '';
            $stpt_checked = '';
            $ptst_checked = '';
            $op = $this->rearrange_settings['title_tag']['other_page'];
            if ( 'page_title' === $op ) {
              $pt_checked = 'checked';
            } elseif ( 'site_title_page_title' === $op ) {
              $stpt_checked = 'checked';
            } else {
              $ptst_checked = 'checked';
            }
            echo '
            <p><label><input type="radio" id="page-title-other" name="rearrange_title_tag[title_tag][other_page]" value="page_title" '.$pt_checked.' />ページタイトル</label></p>
            <p><label><input type="radio" id="site-title-page-title-other" name="rearrange_title_tag[title_tag][other_page]" value="site_title_page_title" ' . $stpt_checked . ' />サイト名 – ページタイトル</label></p>
            <p><label><input type="radio" id="page-title-site-title-other" name="rearrange_title_tag[title_tag][other_page]" value="page_title_site_title" ' . $ptst_checked . ' />ページタイトル – サイト名</label></p>';
          }, 'rearrange_title_tag', 'title_tag' );


        /*---------------------------------------------------------------------------
         * 検索
         *---------------------------------------------------------------------------*/
        register_setting( 'search', 'rearrange_search', [ $this, 'validation' ] );

        /* 検索範囲 */
        add_settings_section( 'search_scope', '検索範囲',
          function() {
            echo '';
          }, 'rearrange_search' );

        add_settings_field( 'remove_page', '検索結果から固定ページを除外する',
          function() {
            $checked = isset( $this->rearrange_settings['search']['remove_page'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="remove-page" name="rearrange_search[search][remove_page]"' . $checked . ' />
            <input type="hidden" id="search-dummy" name="rearrange_search[search][dummy]" value="" />';
          }, 'rearrange_search', 'search_scope' );


        /*---------------------------------------------------------------------------
         * Google Analytics
         *---------------------------------------------------------------------------*/
        register_setting( 'analytics', 'rearrange_analytics', [ $this, 'validation' ] );

        add_settings_section( 'analytics_tag', 'Google Analytics Tag',
          function() {
            echo '<p>タグは'.htmlspecialchars('<head>').'直下に追加されます。</p>';
          }, 'rearrange_analytics' );

        /* gtag.js */
        add_settings_field( 'gtag_js', 'gtag.jsまたは、analytics.js',
          function() {
            $gtag_js = $this->rearrange_settings['analytics']['tag'];
            echo '
            <textarea id="gtag-js" name="rearrange_analytics[analytics][tag]" cols="60" rows="13" placeholder="ここにタグを入力してください">' . $gtag_js . '</textarea>
            <input type="hidden" id="analytics-dummy" name="rearrange_analytics[analytics][dummy]" value="" />';
          }, 'rearrange_analytics', 'analytics_tag' );

        /* ログイン時読み込まない */
        add_settings_field( 'do_not_load', '管理画面にログイン時、タグを読み込まない',
          function() {
            $checked = isset( $this->rearrange_settings['analytics']['do_not_load'] ) ? 'checked' : '';
            echo '<input type="checkbox" id="do-not-load" name="rearrange_analytics[analytics][do_not_load]"' . $checked . ' />';
          }, 'rearrange_analytics', 'analytics_tag' );


        /*---------------------------------------------------------------------------
         * セキュリティ
         *---------------------------------------------------------------------------*/
        register_setting( 'security', 'rearrange_security', [ $this, 'validation' ] );

        /* 非表示 */
        add_settings_section( 'security_hide', 'ユーザーID',
            function() {
                echo '';
            }, 'rearrange_security' );

        add_settings_field( 'hide_author_page', '作成者ページを非表示(404)にする',
        function() {
            $checked = isset( $this->rearrange_settings['security']['hide_author_page'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="remove-page" name="rearrange_security[security][hide_author_page]"'.$checked.' />
            <input type="hidden" id="security-dummy" name="rearrange_security[security][dummy]" value="" />';
        }, 'rearrange_security', 'security_hide' );


        /*---------------------------------------------------------------------------
         * CSS
         *---------------------------------------------------------------------------*/
        register_setting( 'css', 'rearrange_css', [ $this, 'validation' ] );

        /* 親テーマのCSSを読み込む */
        add_settings_section( 'load_style', '',
          function() {
            echo '';
          }, 'rearrange_css' );

        add_settings_field( 'load_parent_style', '親テーマのCSSを読み込む',
          function() {
            $checked = isset( $this->rearrange_settings['css']['load_parent_style'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="load-parent-style" name="rearrange_css[css][load_parent_style]"' . $checked . ' />
            <input type="hidden" id="css-dummy" name="rearrange_css[css][dummy]" value="" />';
          }, 'rearrange_css', 'load_style' );


        add_settings_field( 'load_child_style', '子テーマのCSSを読み込む',
          function() {
            $checked = isset( $this->rearrange_settings['css']['load_child_style'] ) ? 'checked' : '';
            $disabled = 'rearrange' === THEME ? ' disabled' : '';
            echo '
            <input type="checkbox" id="load-child-style" name="rearrange_css[css][load_child_style]"' . $checked . $disabled . ' />
            <input type="hidden" id="css-dummy" name="rearrange_css[css][dummy]" value="" />';
          }, 'rearrange_css', 'load_style' );


        /*---------------------------------------------------------------------------
         * JavaScript
         *---------------------------------------------------------------------------*/
        register_setting( 'javascript', 'rearrange_javascript', [ $this, 'validation' ] );

        /* JS非同期読み込み */
        add_settings_section( 'async_js', 'JavaScriptの非同期読込み',
          function() {
            echo '';
          }, 'rearrange_javascript' );

        add_settings_field( 'async_js', '有効にする<p>全てのscriptタグにdefer属性を付与します。</p><p>一部のプラグインでは正常に動作しない可能性があります。</p>',
          function() {
            $checked = isset( $this->rearrange_settings['javascript']['async_js'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="async-js" name="rearrange_javascript[javascript][async_js]"' . $checked . ' />
            <input type="hidden" id="javascript-dummy" name="rearrange_javascript[javascript][dummy]" value="" />';
          }, 'rearrange_javascript', 'async_js' );


        /*---------------------------------------------------------------------------
         * その他
         *---------------------------------------------------------------------------*/
        register_setting( 'other', 'rearrange_other', [ $this, 'validation' ] );

        /* その他 */
        add_settings_section( 'other_setting', 'その他の設定',
          function() {
            echo '';
          }, 'rearrange_other' );

        // 絵文字タグ
        add_settings_field( 'emoji', '絵文字関連のscript、cssタグを追加<p>（絵文字を使わない場合チェックを外してOK）</p>',
          function() {
            $checked = isset( $this->rearrange_settings['other']['emoji'] ) ? 'checked' : '';
            echo '
            <input type="checkbox" id="emoji" name="rearrange_other[other][emoji]"' . $checked . ' />
            <input type="hidden" id="emoji-dummy" name="rearrange_other[other][dummy]" value="" />';
          }, 'rearrange_other', 'other_setting' );

        // 外部投稿用タグ
        add_settings_field( 'blog_tool', '外部投稿用のタグを追加<p>（外部投稿ツールを使わない場合チェックを外してOK）</p>',
          function() {
            $checked = isset( $this->rearrange_settings['other']['blog_tool'] ) ? 'checked' : '';
            echo '<input type="checkbox" id="blog-tool" name="rearrange_other[other][blog_tool]"' . $checked . ' />';
          }, 'rearrange_other', 'other_setting' );

        // 目標投稿数
        add_settings_field( 'target_posts', '目標の投稿数',
          function() {
            $target_count = isset( $this->rearrange_settings['other']['target_posts'] ) ? $this->rearrange_settings['other']['target_posts'] : 0;
            echo '
            <input type="number" id="target_posts" name="rearrange_other[other][target_posts]" value="' . $target_count . '" />';
          }, 'rearrange_other', 'other_setting' );
      }


    /*---------------------------------------------------------------------------
     * バリデーション
     *---------------------------------------------------------------------------*/
    public function validation( $input ) {
      foreach( $input as $key => $value ) {
        set_theme_mod( $key, $value );
      }
      //add_settings_error( 'dashboard', 'error', '保存できませんでした。設定内容をもう一度ご確認ください。', 'error' );
      if ( ! $this->is_same_previous( $input ) ) {
        add_settings_error( key( $input ), 'success', '設定を保存しました。', 'updated' );
      }
      return $input;
    }


    /*---------------------------------------------------------------------------
     * メッセージが多重表示されないようデータの重複をチェック
     *---------------------------------------------------------------------------*/
    public function is_same_previous( $input ) {
      if ( $this->input !== $input ) {
        $this->input = $input;
        return false;
      }
      $this->input = $input;
      return true;
    }


    /*---------------------------------------------------------------------------
     * トップレベルメニューの登録
     *---------------------------------------------------------------------------*/
    public function register_rearrange_customizer_page() {
      $diamond = get_theme_file_uri( '/assets/img/diamond.svg' );
      $func = 'add_' . 'menu_' . 'page';
      $func( 'Rearrange', 'Rearrange', 'manage_options', 'rearrange', [ $this, 'rearrange_customizer_html' ], $diamond, 61 );
        // add_submenu_page( 'rearrange', 'サブメニュー', 'サブメニュー', 'manage_options', 'submenu', 'rearrange_customizer_html' );
    }


    /*---------------------------------------------------------------------------
     * 設定画面のhtml
     *---------------------------------------------------------------------------*/
    public function rearrange_customizer_html() {
        // add_options_page()で設定のサブメニューとして追加している場合は
        // 問題ないが、add_menu_page()で追加している場合
        // options-head.phpが読み込まれずメッセージが出ない(*)ため
        // メッセージが出るようにします。
        // ※ add_menu_page()の場合親ファイルがoptions-general.phpではない

      global $parent_file;
      if ( 'options-general.php' != $parent_file ) {
        require(ABSPATH . 'wp-admin/options-head.php');
      }

      $menus = [
        'headタグ'         => 'head_tag',
        'titleタグ'        => 'title_tag',
        '検索'             => 'search',
        'Google Analytics' => 'analytics',
            // 'セキュリティ'     => 'security',
        'CSS'              => 'css',
        'JavaScript'       => 'javascript',
        'その他'           => 'other'
      ];
      $url = admin_url();
      $active = isset( $_GET['active'] ) ? $_GET['active'] : 'head_tag';

      echo '<div id="rearrange-setting" class="wrap"><h1>Rearrange Setting</h1><ul class="g-tab-menu">';

      $list_class = '';
      foreach( $menus as $title => $slug ) {
        $list_class = $active === $slug ? 'g-current' : 'g-tab-item';
        echo '<li class="' . $list_class . '"><a href="' . $url . 'admin.php?page=rearrange&active=' . $slug . '">' . $title . '</a></li>';
      }

      echo '</ul><form id="rearrange-form" class="' . $active . '" method="post" action="options.php">';

      settings_fields( $active );
      do_settings_sections( 'rearrange_' . $active );

      submit_button();

      echo '</form></div>';
    }

  }

  if ( is_admin() ) {
    $rearrange_setting = new RearrangeSetting();
  }
