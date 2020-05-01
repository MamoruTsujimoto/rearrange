(function($) {
    
    $(document).ready(function(){
    
        /*---------------------------------------------------------------------------
         * スライダー
         *---------------------------------------------------------------------------*/
        if ( $('.swiper-container').length ) {
            const godiosSwiper = new Swiper('.swiper-container', {
                loop: true,
                // autoplay: 3500,
                speed: 400,
                slidesPerView: 5,
                spaceBetween: 5,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                breakpoints: {
                    1200: { slidesPerView: 4 },
                    950:  { slidesPerView: 3 },
                    700:  { slidesPerView: 2 },
                    450:  { slidesPerView: 1 }
                },
                preloadImages: false,
                lazyLoading: true,
                lazyLoadingOnTransitionStart: true
            });
        }
        
        /* スクロール無効化 */
        const disableScrolling = function() {
            $(window).on('touchmove.noScroll mousewheel', function(e) {
                e.preventDefault();
            });
        }
        
        /* スクロール無効化解除 */
        const enableScrolling = function() {
            $(window).off('.noScroll mousewheel');
        }
        
    
        /*---------------------------------------------------------------------------
         * ヘッダー検索
         *---------------------------------------------------------------------------*/
        /* 検索メニューを表示 */
        document.getElementById('topbar-search-btn').addEventListener('click', function(event) {
            $('#overlay-search').fadeIn(300);
            disableScrolling();
            
        });
        /* 検索メニューを非表示 */
        document.getElementById('overlay-search-close-btn').addEventListener('click', function(event) {
            $('#overlay-search').fadeOut(300);
            enableScrolling();
        });
        
        
        /*---------------------------------------------------------------------------
         * ヘッダーメニュー
         *---------------------------------------------------------------------------*/
        /* メニューを表示 */
        document.getElementById('topbar-menu-btn').addEventListener('click', function(event) {
            $('.gnav').fadeIn(300);
            $('#overlay-menu-close-btn').fadeIn(300);
            disableScrolling();
        });
        
        /* メニューを非表示 */
        document.getElementById('overlay-menu-close-btn').addEventListener('click', function(event) {
            $('.gnav').fadeOut(300);
            $('#overlay-menu-close-btn').fadeOut(300);
            enableScrolling();
        });
        
        
        /*---------------------------------------------------------------------------
         * object-fitを有効化(IE、Edge用)
         *---------------------------------------------------------------------------*/
        if (typeof objectFitImages === 'function') {
            objectFitImages();
        }
        
        
        /*---------------------------------------------------------------------------
         * スマホのタッチイベント:activeを有効化
         *---------------------------------------------------------------------------*/
        document.addEventListener('touchstart', function() {}, false);
        
        
        /*---------------------------------------------------------------------------
         * Lazy Load（lazySizes）
         *---------------------------------------------------------------------------*/
        const docElem = document.documentElement;
        window.lazySizesConfig = window.lazySizesConfig || {};
        window.lazySizesConfig.loadMode = 1;
        window.lazySizesConfig.expand = docElem.clientWidth / 10;
        window.lazySizesConfig.expFactor = 3;
        
        
        /*---------------------------------------------------------------------------
         * 目次
         *---------------------------------------------------------------------------*/
		$('a[href^=#]').click(function() {
          const speed = 400;
          const href= $(this).attr('href');
          const target = $(href == '#' || href == '' ? 'html' : href);
          const position = target.offset().top - $('#header').height() - 20;
          $('body,html').animate({scrollTop:position}, speed, 'swing');
          return false;
       });
    
    });

    window.addEventListener('load', function() {

        /* スマホのメニュータップ時にサブメニューを表示 */
        /* document ready内で書くと稀にCSSが取得できずにtbmbにdisplayの初期値inlineが入るからこっちに書いた */
        const tbmb = $('#topbar-menu-btn').css('display');
        if ('block' === tbmb) {
            $('.menu-item-has-children > a').on('click', function(e) {
                e.preventDefault();
                $(this).next().slideToggle();
            });
        }
        
        let fixedSideContent = {};
        let fixedSCOffsetTop = 0;
        let mainBottom = 0;
        let y;
        const ftc = '.fixed-topbar';
        const fscc = 'fsc-active';
        
        fixedSideContent = $('#fixed-side-content');
        if (fixedSideContent.length) {
            const mainContent = $('main');
            mainBottom = mainContent.offset().top + mainContent.height();
        
        	fixedSCOffsetTop = fixedSideContent.offset().top - 85;
        }
        
        const showFixedHeader = function() {
            const header = $('#header');
            const headerHeight = header.height();
            $('body').prepend('<div id="empty-header" style="height:'+ headerHeight +'px;">');
            header.addClass('fixed-topbar');
        }
        
        const hideFixedHeader = function() {
            $('#empty-header').remove();
            $('#header').removeClass('fixed-topbar');
        }
    
    
        /*---------------------------------------------------------------------------
         * スクロール時の挙動
         *---------------------------------------------------------------------------*/
        $(window).scroll(function() {
            y = $(this).scrollTop();
    
            /* ヘッダー */
            if (150 <= y && ! $(ftc).length) {
                showFixedHeader();
            } else if (0 >= y && $(ftc).length) {
                hideFixedHeader();
            }
            
            /* 固定サイドバー */
            if (fixedSideContent.length) {
                if (mainBottom <= fixedSideContent.offset().top + fixedSideContent.height()) {
                    return;
                }
                if (y >= fixedSCOffsetTop && ! fixedSideContent.hasClass(fscc)) {
                    fixedSideContent.addClass(fscc);
                } else if (y < fixedSCOffsetTop && fixedSideContent.hasClass(fscc)) {
                    fixedSideContent.removeClass(fscc);
                }
            }
        });
        
    }, false);
    
})(jQuery);

