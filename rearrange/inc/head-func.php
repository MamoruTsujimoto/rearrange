<?php
global $rearrange;

/*---------------------------------------------------------------------------
 * Canonicalタグ
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'rearrange_the_canonical_url' ) ) :
    function rearrange_the_canonical_url() {
        global $rearrange;

    	$canonical_url = null;

    	switch( true ) {
    		case is_home() || is_front_page():
    			$canonical_url = $rearrange['home_url'];
    			break;
    		case is_singular():
    			$rearrange['page_url'] = $canonical_url = get_permalink();
    			break;
    		case is_post_type_archive() :
    			$post_type = get_query_var( 'post_type' );
    			$canonical_url = get_post_type_archive_link( $post_type );
    			break;
    		case is_category():
    			$canonical_url = get_category_link( get_query_var( 'cat' ) );
    			break;
    		case is_tag():
    			$canonical_url = get_tag_link( get_query_var( 'tag_id' ) );
    			break;
    		case is_author():
    			$canonical_url = get_author_posts_url( get_query_var( 'author' ), get_query_var( 'author_name' ) );
    			break;
    		case is_year():
    			$canonical_url = get_year_link( get_the_time('Y') );
    			break;
    		case is_month():
    			$canonical_url = get_month_link( get_the_time('Y'), get_the_time('m') );
    			break;
    		case is_day():
    			$canonical_url = get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') );
    			break;
    		default:
    			break;
    	}

    	if ( null !== $canonical_url ) {
            echo '<link rel="canonical" href="'.esc_url( $canonical_url ).'" />';
    	}
    }
endif;


/*---------------------------------------------------------------------------
 * OGPタグ
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'rearrange_the_ogp_tags' ) ) :
    function rearrange_the_ogp_tags() {
        global $rearrange, $post;

        $type = '';
        $url = '';
        $image = '';
        $width = '';
        $height = '';

        if ( is_singular() ) {
          $type = 'article';
          if ( isset( $rearrange['page_url'] ) ) {
            $url = $rearrange['page_url'];
          } else {
            $url = get_permalink();
          }
          $rearrange['has_post_thumbnail'] = has_post_thumbnail();
          if (preg_match("/amazonaws/",get_the_post_thumbnail_url( $post->ID, 'rectangle-ogp' ))) {
            $image = get_the_post_thumbnail_url( $post->ID, 'rectangle-ogp' );
            $width = '1200';
            $height = '630';
          } elseif ( $rearrange['has_post_thumbnail'] ) {
            $image = get_the_post_thumbnail_url( $post->ID, 'rectangle-ogp' );
            $imgsize = rearrange_getimagesize( $image );
            // $imgsize = getimagesize( $image );
            if ( 200 <= $imgsize[0] && 200 <= $imgsize[1] ) {
              $width = $imgsize[0];
              $height = $imgsize[1];
            } else {
              if ( '' !== $rearrange['head_tag']['ogp_defaul_img'] ) {
                $image = $rearrange['head_tag']['ogp_defaul_img'];
                if ( isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
                  $imgsize = rearrange_getimagesize( $image );
                  // $imgsize = getimagesize( $image );
                  $width = $imgsize[0];
                  $height = $imgsize[1];
                }
              } else {
                $image = get_theme_file_uri( '/assets/img/rearrange.jpg' );
                $width = '1200';
                $height = '630';
              }
            }
          } else {
            if ( '' !== $rearrange['head_tag']['ogp_defaul_img'] ) {
              $image = $rearrange['head_tag']['ogp_defaul_img'];
              if ( isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
                $imgsize = rearrange_getimagesize( $image );
                // $imgsize = getimagesize( $image );
                $width = $imgsize[0];
                $height = $imgsize[1];
              }
            } else {
              $image = get_theme_file_uri( '/assets/img/rearrange.jpg' );
              $width = '1200';
              $height = '630';
            }
          }
        } elseif ( is_archive() ) {
            $type = 'website';
            $url = $rearrange['home_url'];
            if ( '' !== $rearrange['head_tag']['ogp_defaul_img'] ) {
                $image = $rearrange['head_tag']['ogp_defaul_img'];
                if ( isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
                    $imgsize = rearrange_getimagesize( $image );
                    // $imgsize = getimagesize( $image );
                    $width = $imgsize[0];
                    $height = $imgsize[1];
                }
            } else {
                $image = get_theme_file_uri( '/assets/img/rearrange.jpg' );
                $width = '600';
                $height = '600';
            }
        } else {
            $type = 'website';
            $url = $rearrange['home_url'];

            if ( '' !== $rearrange['head_tag']['ogp_defaul_img'] ) {
                $image = $rearrange['head_tag']['ogp_defaul_img'];
                if ( isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
                    $imgsize = rearrange_getimagesize( $image );
                    // $imgsize = getimagesize( $image );
                    $width = $imgsize[0];
                    $height = $imgsize[1];
                }
            } else {
                $image = get_theme_file_uri( '/assets/img/rearrange.jpg' );
                $width = '600';
                $height = '600';
            }
        }

        $rearrange['ogp_img_width']  = $width;
        $rearrange['ogp_img_height'] = $height;

        if ( isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
            $facebook_ogp  = '<meta property="og:type" content="'.$type.'" />'."\n";
            $facebook_ogp .= '<meta property="og:url" content="'.$url.'" />'."\n";
            $facebook_ogp .= '<meta property="og:site_name" content="'.$rearrange['site_name'].'" />'."\n";
            $facebook_ogp .= '<meta property="og:title" content="'.$rearrange['meta_title'].'" />'."\n";
            $facebook_ogp .= '<meta property="og:description" content="'.$rearrange['meta_description'].'" />'."\n";
            $facebook_ogp .= '<meta property="og:image" content="'.$image.'" />'."\n";
            $facebook_ogp .= '<meta property="og:image:width" content="'.$width.'" />'."\n";
            $facebook_ogp .= '<meta property="og:image:height" content="'.$height.'" />'."\n";
            $facebook_ogp .= '<meta property="og:locale" content="ja_JP" />'."\n";
            if ( '' !== $rearrange['head_tag']['facebook_ogp_app_id'] ) {
                $facebook_ogp .= '<meta property="fb:app_id" content="'.$rearrange['head_tag']['facebook_ogp_app_id'].'" />'."\n";
            }
            echo $facebook_ogp;
        }


        if ( isset( $rearrange['head_tag']['twitter_card'] ) ) {
            $twitter_card = '<meta name="twitter:card" content="'.$rearrange['head_tag']['twitter_card_type'].'" />';
            $user_name = $rearrange['head_tag']['twitter_user_name'];
            if ( '' !== $user_name ) {
                $twitter_card .= '<meta name="twitter:site" content="'.$user_name.'" />';
                $twitter_card .= '<meta name="twitter:creator" content="'.$user_name.'" />';
            }
            if ( ! isset( $rearrange['head_tag']['facebook_ogp'] ) ) {
                $twitter_card .= '<meta property="og:url" content="'.$url.'" />';
                $twitter_card .= '<meta property="og:title" content="'.$rearrange['meta_title'].'" />';
                $twitter_card .= '<meta property="og:description" content="'.$rearrange['meta_description'].'" />';
                $twitter_card .= '<meta property="og:image" content="'.$image.'" />';
            }
            echo $twitter_card;
        }

    }
endif;


/*---------------------------------------------------------------------------
 * Descriptionタグ
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'rearrange_the_description_tag' ) ) :
    function rearrange_the_description_tag() {
        global $rearrange;

        $rearrange['meta_title'] = wp_get_document_title();
        $rearrange['meta_description'] = '';

        if ( is_front_page() && is_page() ) {
            $rearrange['meta_description'] = $rearrange['site_description'];
        } elseif ( is_singular() ) {
            $rearrange['meta_description'] = get_the_excerpt();
            if ( '' === $rearrange['meta_description'] ) {
                $rearrange['meta_description'] = $rearrange['meta_title'];
            }
        } elseif ( is_archive() ) {
            if ( is_category() ) {
                $cat_desc = wp_strip_all_tags( category_description() );
                $rearrange['meta_description'] = '' === $cat_desc ? $rearrange['meta_title'] : $cat_desc ;
            } else {
                $rearrange['meta_description'] = $rearrange['meta_title'];
            }
        } else {
            $rearrange['meta_description'] = $rearrange['site_description'];
        }

        echo '<meta name="description" content="'.$rearrange['meta_description'].'" />';
    }
endif;


/*---------------------------------------------------------------------------
 * headタグ
 *---------------------------------------------------------------------------*/
add_action( 'wp_head', function() {
    global $rearrange;

    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui,viewport-fit=cover" />';
    echo '<meta name="mobile-web-app-capable" content="yes" />';
    echo '<meta name="apple-mobile-web-app-capable" content="yes" />';
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="default" />';
    echo '<meta name="msapplication-TileColor" content="#da532c">';
    echo '<meta name="apple-mobile-web-app-capable" content="yes">';
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="black">';
    echo '<meta name="theme-color" content="#000000">';
    echo '<link rel="shortcut icon" href="'.get_template_directory_uri().'/assets/img/favicon.ico">';
    echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_template_directory_uri().'/assets/img/apple-touch-icon.png">';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="'.get_template_directory_uri().'/assets/img/favicon-32x32.png">';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="'.get_template_directory_uri().'/assets/img/favicon-16x16.png">';

    // Description
    rearrange_the_description_tag();

    // noindex
    if ( is_search() || is_date() || is_author() ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
    }

    // canonical
    if ( isset( $rearrange['head_tag']['canonical'] ) ) {
        rearrange_the_canonical_url();
    }

    // サイトアイコン
    $rearrange['has_site_icon'] = has_site_icon();
    if ( false === $rearrange['has_site_icon'] ) {
        $site_icon = get_theme_file_uri( '/images/site-icon.png' );
        echo '<link rel="icon" type="image/png" href="' . $site_icon . '">';
        echo '<link rel="apple-touch-icon" href="' . $site_icon . '" sizes="180x180">';
    }

    // RSS
    if ( isset( $rearrange['head_tag']['rss'] ) ) {
        echo '<link rel="alternate" type="application/rss+xml" title="'.$rearrange['site_name'].' RSS Feed" href="'.get_bloginfo('rss2_url').'" />';
    }

    // Atom
    if ( isset( $rearrange['head_tag']['atom'] ) ) {
        echo '<link rel="alternate" type="application/atom+xml" title="'.$rearrange['site_name'].' Atom Feed" href="'.get_bloginfo('atom_url').'" />';
    }

    // OGP
    if ( isset( $rearrange['head_tag']['facebook_ogp'] ) || isset( $rearrange['head_tag']['twitter_card'] ) ) {
        rearrange_the_ogp_tags();
    }

    // Swiper Inline CSS
    if ( true === $rearrange['slider']['show'] ) {
        $swiper_css = wp_remote_get( 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
        echo '<style id="swiper-inline-style">' . $swiper_css['body'] . '</style>';
    }

}, 1 );


/*---------------------------------------------------------------------------
 * CSS、JSの読み込み
 *---------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', function() {
    global $rearrange, $is_IE;

    $theme = wp_get_theme();

    if ( isset( $rearrange['css']['load_parent_style'] ) ) {
        wp_register_style( 'rearrange', PARENT_CSS . '/style.css', [], $theme->Version );
        wp_enqueue_style( 'rearrange' );
    }

    if ( true === $rearrange['slider']['show'] ) {
        wp_enqueue_script( 'swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js', [], '3.4.2', false );
    }

    if ( $is_IE ) {
        wp_enqueue_script( 'ofi', PARENT_JS . '/ofi.min.js', [], '3.2.3', false );
    }

    if ( isset( $rearrange['lazy_load']['enable'] ) && true === $rearrange['lazy_load']['enable'] ) {
        wp_enqueue_script( 'lazySizes', '//cdnjs.cloudflare.com/ajax/libs/lazysizes/4.0.1/lazysizes.min.js', [], '4.0.1', false );
    }
    wp_enqueue_script( 'imageloaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', [], $theme->Version, true );
    wp_enqueue_script( 'rearrange', PARENT_JS . '/rearrange.js', [ 'jquery' ], $theme->Version, true );

    if ( is_single() ) {
        wp_enqueue_script( 'comment-reply' );
    }

}, 2 );

add_action( 'wp_enqueue_scripts', function() {
	if( !is_admin() ) {
		$theme = wp_get_theme();
	    wp_deregister_script('jquery');
        wp_enqueue_script( 'jquery', PARENT_JS . '/jquery.min.js', [], '3.4.1', true );	}
});

if ( ! isset( $rearrange['css']['load_child_style'] ) ) :
    add_action( 'wp_enqueue_scripts', function() {

        wp_dequeue_style( 'rearrange-child-style' );

    }, 15 );
endif;

function dequeue_plugins_style() {
  //プラグインIDを指定し解除する
  wp_dequeue_style('wp-block-library');
}
add_action( 'wp_enqueue_scripts', 'dequeue_plugins_style', 9999);

/* Noto Sans Japaneseの非同期読み込み */
add_action( 'wp_print_footer_scripts', function() {
    global $rearrange;

    if ( 'Noto_Sans_Japanese' !== $rearrange['fonts']['type'] ) {
        return;
    }

    $custom_font = PARENT_CSS . '/custom-notosansjapanese.min.css?ver=1.0';

    $script = '<script>';
    $script .= <<<EOF
        const loadDeferredStyles = function() {
            const link = document.createElement('link');
            link.async = true;
            link.defer = true;
            link.rel   = 'stylesheet';
            link.href  = '{$custom_font}';
            document.getElementsByTagName('head')[0].appendChild(link);
        };
        const raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

        if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
        else window.addEventListener('load', loadDeferredStyles);
EOF;
    $script .= '</script>';
    echo $script;

} );

/* jsの非同期読み込み */
if ( isset( $rearrange['javascript']['async_js'] ) && 'on' === $rearrange['javascript']['async_js'] ) :
    add_filter( 'script_loader_tag', function( $tag ) {
        if ( is_admin() ) return $tag;

        return str_replace( "type='text/javascript'", 'defer', $tag );
    } );
endif;

/* linkタグからtype=text/cssを削除する */
add_filter( 'style_loader_tag', function( $tag ) {
    if ( is_admin() ) return $tag;

    if ( false !== strpos( $tag, "type='text/css'" ) ) {
        return str_replace( "type='text/css'", '', $tag );
    }

    return $tag;
}, 9999 );

/* CSS・JSからWordPressのバージョンを削除する */
if ( ! function_exists( 'rearrange_remove_version_parameter' ) ) :
    function rearrange_remove_version_parameter( $src ) {
        if ( is_admin() ) return $src;

        if ( false !== strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
            $src = remove_query_arg( 'ver', $src );
        }
        return $src;
    }
endif;
add_filter( 'style_loader_src', 'rearrange_remove_version_parameter', 9999 );
add_filter( 'script_loader_src', 'rearrange_remove_version_parameter', 9999 );


/*---------------------------------------------------------------------------
 * 不要なタグを削除
 *---------------------------------------------------------------------------*/
if ( ! isset( $rearrange['other']['blog_tool'] ) ) {
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer(サポート終了した)
    remove_action( 'wp_head', 'rsd_link' ); // リモート投稿用
}

if ( ! isset( $rearrange['other']['emoji'] ) ) {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

add_filter( 'the_generator', '__return_empty_string' ); // バージョン情報
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // 前後の記事URL
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // 短縮URL(/?p=123)
remove_action( 'wp_head', 'feed_links', 2 ); // フィード（別で指定するため削除）
remove_action( 'wp_head', 'feed_links_extra', 3 ); // カテゴリー別やタグ別など特定の条件に応じたフィード（別で指定するため削除）
remove_action( 'wp_head', 'rel_canonical' ); // 別で指定するため削除


/*---------------------------------------------------------------------------
 * カスタムカラー
 *---------------------------------------------------------------------------*/
add_action( 'wp_head', function() {
    global $rearrange;

    $main_color1 = '';
    $main_color2 = '';
    $sub_color   = '';

    switch ( $rearrange['front_color']['item'] ) {

        case 'blue_green':
            // $main_color1 = '#81a9d9';
            // $main_color2 = '#b3bfff';
            // $sub_color   = '#8be8bf';
            return;
            break;

        case 'blue_pink':
            $main_color1 = '#81a9d9';
            $main_color2 = '#b3bfff';
            $sub_color   = '#ffc6d0';
            break;

        case 'green_blue':
            $main_color1 = '#66c5a2';
            $main_color2 = '#8be8bf';
            $sub_color   = '#b3bfff';
            break;

        case 'green_yellow':
            $main_color1 = '#66c5a2';
            $main_color2 = '#8be8bf';
            $sub_color   = '#ffe08a';
            break;

        case 'yellow_green':
            $main_color1 = '#fbd756';
            $main_color2 = '#ffe08a';
            $sub_color   = '#8be8bf';
            break;

        case 'pink_orange':
            $main_color1 = '#d988a8';
            $main_color2 = '#ffc6d0';
            $sub_color   = '#ffc5ac';
            break;

        case 'pink_blue':
            $main_color1 = '#d988a8';
            $main_color2 = '#ffc6d0';
            $sub_color   = '#b3bfff';
            break;

        case 'orange_pink':
            $main_color1 = '#ef9b6f';
            $main_color2 = '#ffc5ac';
            $sub_color   = '#ffc6d0';
            break;

        default:
            break;
    }

    echo <<<EOF
    <style>
        a:hover,
        #entry-content a,
        .gnav > li > a:hover,
        .entry-list > a:hover .entry-title {
            color: {$main_color1};
        }

        input[type=radio]:checked::before {
            background-color: {$main_color1};
        }

        .btn-primary,
        input[type="submit"],
        #side li:nth-of-type(odd)::before,
        #side li:nth-of-type(odd) li::before,
        #entry-content ul > li:nth-of-type(odd)::before,
        .tags > li > a,
        .tagcloud > a,
        .comment-reply-link,
        .pagination .current,
        .pagination a:hover,
        #wp-calendar > tbody td > a,
        #not-found > a,
        #contents > ol > li:nth-of-type(odd)::before,
        #contents > ol > li:nth-of-type(odd) > ul::before,
        #entry-content h2::before,
        #entry-content h4::before {
            background-color: {$main_color2};
        }

        #entry-content a:hover,
        #entry-content #contents a:hover {
            color: {$main_color2};
        }

        .btn-secondary,
        #side li:nth-of-type(even)::before,
        #side li:nth-of-type(even) li::before,
        #entry-content ul > li:nth-of-type(even)::before,
        .entry-category,
        #today,
        #contents > ol > li:nth-of-type(even)::before,
        #contents > ol > li:nth-of-type(even) > ul::before,
        #entry-content h3::before,
        #entry-content h5::before {
            background-color: {$sub_color};
        }

        @media (max-width: 48em) {
            a:hover,
            .entry-list > a:hover .entry-title,
            #entry-content #contents a:hover {
                color: #333;
            }

            a:active,
            .entry-list > a:active .entry-title,
            #entry-content a:hover {
                color: {$main_color1};
            }

            #entry-content a:active,
            #entry-content #contents a:active {
                color: {$main_color2};
            }

            .pagination a:hover {
                background-color: #fff;
            }

            .pagination a:active {
                background-color: {$main_color2};
            }
        }

    </style>
EOF;
}, 15 );


/*---------------------------------------------------------------------------
 * カスタムtitle_tagline CSS
 *---------------------------------------------------------------------------*/
add_action( 'wp_head', function() {
    global $rearrange;

    // タイトルの文字の大きさ
    $tfs_pc = '';
    $tfs_max900 = '';
    $tfs_max320 = '';
    $title_font_size_style = '';

    if ( ! isset( $rearrange['title_tagline']['title_font_size'] ) ) {
        $rearrange['title_tagline']['title_font_size'] = 'M';
    }

    if ( 'M' !== $rearrange['title_tagline']['title_font_size'] ) :
        switch( $rearrange['title_tagline']['title_font_size'] ) {

            case 'XS':
                $tfs_pc = '2rem';
                $tfs_max900 = '1.6rem';
                $tfs_max320 = '1.4rem';
                break;

            case 'S':
                $tfs_pc = '2.5rem';
                $tfs_max900 = '2rem';
                $tfs_max320 = '1.7rem';
                break;

            case 'M':
                // $tfs_pc = '3.4rem';
                // $tfs_max900 = '2.5rem';
                // $tfs_max320 = '2.3rem';
                break;

            case 'L':
                $tfs_pc = '4.5rem';
                $tfs_max900 = '3rem';
                $tfs_max320 = '2.6rem';
                break;

            case 'XL':
                $tfs_pc = '5.5rem';
                $tfs_max900 = '3.5rem';
                $tfs_max320 = '2.9rem';
                break;

            default:
                break;
        }
        $title_font_size_style = <<<EOF
        .site-title {
            font-size: {$tfs_pc};
        }

        @media (max-width: 56.25em) {
            .site-title {
                font-size: {$tfs_max900};
            }
        }

        @media (max-width: 20em) {
            .site-title {
                font-size: {$tfs_max320};
            }
        }
EOF;

    endif;

    // タイトルの最大幅
    $title_max_width_style = '';
    if ( isset( $rearrange['title_tagline']['title_max_width'] ) && 'default' !== $rearrange['title_tagline']['title_max_width'] ) {
        $title_max_width_style = <<<EOF
        @media (min-width: 80.0625em) {
            .site-title,
            .site-description {
                max-width: {$rearrange['title_tagline']['title_max_width']}vw;
                width: {$rearrange['title_tagline']['title_max_width']}vw;
            }
        }
EOF;
    }

    // タイトルを改行しない場合のスタイル
    $nowrap_title_style = '';
    if ( isset( $rearrange['title_tagline']['wrap_title'] ) && false === $rearrange['title_tagline']['wrap_title'] ) {

        $nowrap_title_style = <<<EOF
        .site-title {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
EOF;
    }

    // キャッチフレーズを改行しない場合のスタイル
    $site_description_style = '';
    if ( isset( $rearrange['title_tagline']['wrap_tagline'] ) && false === $rearrange['title_tagline']['wrap_tagline'] ) {
        $site_description_style = <<<EOF
        .site-description {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
EOF;
    }

    if (
        '' === $title_font_size_style &&
        '' === $title_max_width_style &&
        '' === $nowrap_title_style    &&
        '' === $site_description_style
    ) return;

    echo <<<EOF
    <style id="rearrange-title-tagline-css">
        {$title_font_size_style}
        {$title_max_width_style}
        {$nowrap_title_style}
        {$site_description_style}
    </style>
EOF;

}, 20 );


/*---------------------------------------------------------------------------
 * titleタグ
 *---------------------------------------------------------------------------*/
/* セパレーター */
add_filter( 'document_title_separator', function( $sep ) {
    global $rearrange;

    if ( 'en_dash' === $rearrange['title_tag']['separator'] ) {
        return $sep;
    }
    $sep = '|';

    return $sep;
} );


/* 並び替え */
add_filter( 'document_title_parts', function( $title ) {
    global $rearrange, $post;

    if ( is_home() ) {
        if ( 'site_title' === $rearrange['title_tag']['top_page_list'] ) {
            unset( $title['tagline'] );
        } elseif ( 'catchphrase_site_title' === $rearrange['title_tag']['top_page_list'] ) {
            $new_title['tagline'] = $title['tagline'];
            $new_title['title'] = $title['title'];
            return $new_title;
        } else {
            return $title;
        }
    } elseif ( is_front_page() && is_page() ) {
        if ( 'site_title' === $rearrange['title_tag']['top_page_page'] ) {
            unset( $title['tagline'] );
        } elseif ( 'catchphrase_site_title' === $rearrange['title_tag']['top_page_page'] ) {
            $new_title['tagline'] = $title['tagline'];
            $new_title['title'] = $title['title'];
            return $new_title;
        } elseif ( 'page_title_site_title' === $rearrange['title_tag']['top_page_page'] ) {
            $new_title['tagline'] = $post->post_title;
            $new_title['title'] = $title['title'];
            return $new_title;
        } else {
            return $title;
        }
    } else {
        if ( 'page_title' === $rearrange['title_tag']['other_page'] ) {
            unset( $title['site'] );
        } elseif ( 'site_title_page_title' === $rearrange['title_tag']['other_page'] ) {
            $new_title['site'] = $title['site'];
            $new_title['title'] = $title['title'];
            return $new_title;
        } else {
            return $title;
        }
    }

    return $title;
} );
