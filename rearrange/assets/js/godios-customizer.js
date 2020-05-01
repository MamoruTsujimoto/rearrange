( function( $ ) {
 
    
    /*---------------------------------------------------------------------------
     * サイト基本情報
     *---------------------------------------------------------------------------*/
    /* サイトタイトルの文字の大きさ */
    wp.customize( 'title_tagline[title_font_size]', function( value ) {
        value.bind( function( newval ) {
            let tfs_pc = '';
            let tfs_max900 = '';
            let tfs_max320 = '';
            
            switch ( newval ) {
                case 'XS':
                    tfs_pc = '2rem';
                    tfs_max900 = '1.6rem';
                    tfs_max320 = '1.4rem';
                    break;
                    
                case 'S':
                    tfs_pc = '2.5rem';
                    tfs_max900 = '2rem';
                    tfs_max320 = '1.7rem';
                    break;
                
                case 'M':
                    tfs_pc = '3.4rem';
                    tfs_max900 = '2.5rem';
                    tfs_max320 = '2.3rem';
                    break;
                    
                case 'L':
                    tfs_pc = '4.5rem';
                    tfs_max900 = '3rem';
                    tfs_max320 = '2.6rem';
                    break;
                    
                case 'XL':
                    tfs_pc = '5.5rem';
                    tfs_max900 = '3.5rem';
                    tfs_max320 = '2.9rem';
                    break;
                    
                default:
                    // code
            }
            
            let style = '<style>';
            style += '.site-title { font-size: ' + tfs_pc + '; }'
            style += '@media (max-width: 56.25em) { .site-title { font-size: ' + tfs_max900 + '; } }';
            style += '@media (max-width: 20em) { .site-title { font-size: ' + tfs_max320 + '; } }';
            style += '</style>';
            $('head').append(style);
        } );
    } );
    
    /* タイトル・キャッチフレーズの横幅 */
    wp.customize( 'title_tagline[title_max_width]', function( value ) {
        value.bind( function( newval ) {
            if ( 'default' === newval ) {
                $('.site-title, .site-description').css({'max-width': '400px', 'width': '400px'});  
            } else {
                $('.site-title, .site-description').css({'max-width': newval + 'vw', 'width': newval + 'vw'});    
            }
        } );
    } );
    
    /* タイトルを改行する */
    wp.customize( 'title_tagline[wrap_title]', function( value ) {
        value.bind( function( newval ) {
            if ( false === newval ) {
                let style = '<style>';
                style += '.site-title { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }';
                style += '@media (max-width: 80em) { .site-title { max-width: calc(100vw - 150px); } }';
                style += '@media (max-width: 37.5em) { .site-title { max-width: calc(100vw - 109px); } }';
                style += '</style>';
                $('head').append(style);  
            } else {
                let style = '<style>';
                style += '.site-title { overflow: visible; text-overflow: clip; white-space: normal; }';
                style += '@media (max-width: 80em) { .site-title { max-width: auto; } }';
                style += '@media (max-width: 37.5em) { .site-title { max-width: auto; } }';
                style += '</style>';
                $('head').append(style);  
            }
        } );
    } );
    
    /* キャッチフレーズを表示する */
    wp.customize( 'title_tagline[show_tagline]', function( value ) {
        value.bind( function( newval ) {
            if ( 900 >= window.innerWidth ) {
                $('.site-description').hide();
                return;
            }
            
            if ( true === newval ) {
                $('.site-description').show();
            } else {
                $('.site-description').hide();
            }
        } );
    } );
    
    /* キャッチフレーズを改行する */
    wp.customize( 'title_tagline[wrap_tagline]', function( value ) {
        value.bind( function( newval ) {
            if ( false === newval ) {
                let style = '<style>';
                style += '.site-description { max-width: calc(100vw - 150px); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }';
                style += '</style>';
                $('head').append(style);  
            } else {
                let style = '<style>';
                style += '.site-description { max-width: auto; overflow: visible; text-overflow: clip; white-space: normal; }';
                style += '</style>';
                $('head').append(style);  
            }
        } );
    } );
    
    
    /*---------------------------------------------------------------------------
     * カラム
     *---------------------------------------------------------------------------*/
    wp.customize( 'column[position]', function( value ) {
        value.bind( function( newval ) {
            if ( 'r-column' === newval ) {
                $('#wrapper').removeClass('l-column').addClass('r-column');
                $('#godios-wrapper').removeClass('r-wrap').addClass('l-wrap');
                $('#side').insertAfter('#godios-wrapper');
            } else {
                $('#wrapper').removeClass('r-column').addClass('l-column');
                $('#godios-wrapper').removeClass('l-wrap').addClass('r-wrap');
                $('#side').insertBefore('#godios-wrapper');
            }
        } );
    } );
    
    
    /*---------------------------------------------------------------------------
     * 色
     *---------------------------------------------------------------------------*/
    wp.customize( 'front_color[item]', function( value ) {
        value.bind( function( newval ) {
            let main_color1 = '';
            let main_color2 = '';
            let sub_color   = '';

            switch ( newval ) {
                case 'blue_green':
                    main_color1 = '#81a9d9';
                    main_color2 = '#b3bfff';
                    sub_color   = '#8be8bf';
                    break;
                case 'blue_pink':
                    main_color1 = '#81a9d9';
                    main_color2 = '#b3bfff';
                    sub_color   = '#ffc6d0';
                    break;
                case 'green_blue':
                    main_color1 = '#66c5a2';
                    main_color2 = '#8be8bf';
                    sub_color   = '#b3bfff';
                    break;
                case 'green_yellow':
                    main_color1 = '#66c5a2';
                    main_color2 = '#8be8bf';
                    sub_color   = '#ffe08a';
                    break;
                case 'yellow_green':
                    main_color1 = '#fbd756';
                    main_color2 = '#ffe08a';
                    sub_color   = '#8be8bf';
                    break;
                case 'pink_orange':
                    main_color1 = '#d988a8';
                    main_color2 = '#ffc6d0';
                    sub_color   = '#ffc5ac';
                    break;
                case 'pink_blue':
                    main_color1 = '#d988a8';
                    main_color2 = '#ffc6d0';
                    sub_color   = '#b3bfff';
                    break;
                case 'orange_pink':
                    main_color1 = '#ef9b6f';
                    main_color2 = '#ffc5ac';
                    sub_color   = '#ffc6d0';
                    break;
                default:
                    break;
            }

            let style = '<style>';
            
            style += 'a:hover, .gnav > li > a:hover, .entry-list > a:hover .entry-title { color: ' + main_color1 + '; }';
            style += '.btn-primary, input[type="submit"], #side li:nth-of-type(odd)::before, #side li:nth-of-type(odd) li::before, .tags > li > a, .tagcloud > a, .comment-reply-link, .pagination .current, .pagination a:hover, #wp-calendar > tbody td > a, #not-found > a { background-color: ' + main_color2 + '; }';
            style += '@media (max-width: 48em) { a:hover, .entry-list > a:hover .entry-title { color: #333; } a:active, .entry-list > a:active .entry-title { color: ' + main_color1 + '; }  .pagination a:hover { background-color: #fff; } .pagination a:active { background-color: ' + main_color2 + ' ; } }';
            style += '.btn-secondary, #side li:nth-of-type(even)::before, #side li:nth-of-type(even) li::before, .entry-category, #today { background-color: ' + sub_color + '; }';
            style += '</style>';
            
            $('head').append(style);
            
        } );
    } );
    
    /*---------------------------------------------------------------------------
     * フォント
     *---------------------------------------------------------------------------*/
    wp.customize( 'fonts[type]', function( value ) {
        value.bind( function( newval ) {
            if ( 'Noto_Sans_Japanese' === newval ) {
                const n = document.createElement('link');
                n.rel   = 'stylesheet';
                n.href  = location.protocol + '//' + location.host + '/wp-content/themes/godios/css/custom-notosansjapanese.css?ver=1.0';
                document.getElementsByTagName('head')[0].appendChild(n);
                
                $('body').css('font', '200 1.5rem "Noto Sans Japanese", -apple-system, BlinkMacSystemFont, "Helvetica Neue", "ヒラギノ角ゴ ProN W3", Hiragino Kaku Gothic ProN, Arial, Meiryo, sans-serif');
            } else {
                $('body').css('font', '200 1.5rem -apple-system, BlinkMacSystemFont, "Helvetica Neue", "ヒラギノ角ゴ ProN W3", Hiragino Kaku Gothic ProN, Arial, Meiryo, sans-serif');
            }
        } );
    } );
    
    
    /*---------------------------------------------------------------------------
     * 記事一覧
     *---------------------------------------------------------------------------*/
    // カテゴリー　表示
    wp.customize( 'entry_list[show_category]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('.entry-category').fadeIn();
            } else {
                $('.entry-category').fadeOut();
            }
        } );
    } );
    
    // 抜粋　表示
    wp.customize( 'entry_list[show_excerpt]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('.entry-content').fadeIn();
            } else {
                $('.entry-content').fadeOut();
            }
        } );
    } );
    
    // 日付　表示
    wp.customize( 'entry_list[show_date]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('.entry-footer').fadeIn();
            } else {
                $('.entry-footer').fadeOut();
            }
        } );
    } );
    
    
    /*---------------------------------------------------------------------------
     * ソーシャルメディア
     *---------------------------------------------------------------------------*/
    // 表示
    wp.customize( 'social_media[show_footer]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('#social-media').fadeIn();
            } else {
                $('#social-media').fadeOut();
            }
        } );
    } );
    
    // カラー
    wp.customize( 'social_media[color]', function( value ) {
        value.bind( function( newval ) {
            const list = $('.social-media > li');
            const a = $('.social-media > li > a');
            const svg = $('.social-media > li > a > svg');
            if ( 'tp_color' === newval ) {
                list.removeClass('icon-round');
                list.addClass('transparent');
                a.removeClass('gray');
                a.addClass('color');
                svg.removeClass('social-icon-white');
            } else if ( 'tp_gray' === newval ) {
                list.removeClass('icon-round');
                list.addClass('transparent');
                a.removeClass('color');
                a.addClass('gray');
                svg.removeClass('social-icon-white');
            } else { // round
                list.removeClass('transparent');
                list.addClass('icon-round');
                a.addClass('color');
                svg.addClass('social-icon-white');
            }
        } );
    } );
    
    // instagram
    wp.customize( 'social_media[accounts][instagram]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .instagram').fadeIn();
            } else { // round
                $('.social-media > .instagram').fadeOut();
            }
        } );
    } );
    
    // facebook_page
    wp.customize( 'social_media[accounts][facebook_page]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .facebook').fadeIn();
            } else { // round
                $('.social-media > .facebook').fadeOut();
            }
        } );
    } );
    
    // twitter
    wp.customize( 'social_media[accounts][twitter]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .twitter').fadeIn();
            } else { // round
                $('.social-media > .twitter').fadeOut();
            }
        } );
    } );
    
    // line_at
    wp.customize( 'social_media[accounts][line_at]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .line').fadeIn();
            } else { // round
                $('.social-media > .line').fadeOut();
            }
        } );
    } );
    
    // youtube
    wp.customize( 'social_media[accounts][youtube]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .youtube').fadeIn();
            } else { // round
                $('.social-media > .youtube').fadeOut();
            }
        } );
    } );
    
    // skype
    wp.customize( 'social_media[accounts][skype]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .skype').fadeIn();
            } else { // round
                $('.social-media > .skype').fadeOut();
            }
        } );
    } );
    
    // googleplus
    wp.customize( 'social_media[accounts][googleplus]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .googleplus').fadeIn();
            } else { // round
                $('.social-media > .googleplus').fadeOut();
            }
        } );
    } );
    
    // github
    wp.customize( 'social_media[accounts][github]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .github').fadeIn();
            } else { // round
                $('.social-media > .github').fadeOut();
            }
        } );
    } );
    
    // pinterest
    wp.customize( 'social_media[accounts][pinterest]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .pinterest').fadeIn();
            } else { // round
                $('.social-media > .pinterest').fadeOut();
            }
        } );
    } );
    
    // soundcloud
    wp.customize( 'social_media[accounts][soundcloud]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .soundcloud').fadeIn();
            } else { // round
                $('.social-media > .soundcloud').fadeOut();
            }
        } );
    } );
    
    // linkedin
    wp.customize( 'social_media[accounts][linkedin]', function( value ) {
        value.bind( function( newval ) {
            if ( '' !== newval ) {
                $('.social-media > .linkedin').fadeIn();
            } else { // round
                $('.social-media > .linkedin').fadeOut();
            }
        } );
    } );
    
    /*---------------------------------------------------------------------------
     * ソーシャルシェア
     *---------------------------------------------------------------------------*/
    // 表示 top
    wp.customize( 'social_share[show_top]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('.social-share-wrap.top').fadeIn();
            } else {
                $('.social-share-wrap.top').fadeOut();
            }
        } );
    } );
    
    // 表示 bottom
    wp.customize( 'social_share[show_bottom]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('.social-share-wrap.bottom').fadeIn();
            } else {
                $('.social-share-wrap.bottom').fadeOut();
            }
        } );
    } );
    
    // カラー
    wp.customize( 'social_share[color]', function( value ) {
        value.bind( function( newval ) {
            $('.social-share > li').toggleClass('icon-round transparent');
            $('.social-share > li > a').toggleClass('white color');
            $('.social-share > li > a > svg').toggleClass('social-icon-white');
        } );
    } );
    
    /*---------------------------------------------------------------------------
     * スライダー
     *---------------------------------------------------------------------------*/
    // 表示
    wp.customize( 'slider[show]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('#slider').fadeIn();
            } else {
                $('#slider').fadeOut();
            }
        } );
    } );
    
    /*---------------------------------------------------------------------------
     * 関連記事
     *---------------------------------------------------------------------------*/
    // 表示
    wp.customize( 'related_entry[show]', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $('#related').fadeIn();
            } else {
                $('#related').fadeOut();
            }
        } );
    } );
    
} ) ( jQuery );