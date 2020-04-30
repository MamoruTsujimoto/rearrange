<?php

/*---------------------------------------------------------------------------
 * Godモード
 *---------------------------------------------------------------------------*/
global $rearrange;

if ( ! isset( $rearrange['god_mode']['enable'] ) || false === $rearrange['god_mode']['enable'] ) {
    return;
}

add_action( 'wp_enqueue_scripts', function() {
    global $is_IE, $is_edge;

    wp_enqueue_script( 'god', PARENT_JS . '/god.min.js', [], '1.0', false );
    wp_enqueue_script( 'god-custom', PARENT_JS . '/god-custom.min.js', ['jquery'], '1.0', false );
    
    if ( $is_IE || $is_edge ) {
        wp_enqueue_script( 'srcdoc-polyfill', PARENT_JS .  '/srcdoc-polyfill.min.js', [], '1.0.0', false );
    }
}, 3 );


if ( isset( $rearrange['god_mode']['enable'] ) && true === $rearrange['god_mode']['enable'] ) : 

    /* ローディングインジケーター用html */
    add_action( 'wp_footer', function() {
        echo '
        <div id="loading-indicator">
            <svg width="35" height="35" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" id="li-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle cx="50" cy="50" fill="none" stroke="#333" stroke-width="3" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                </circle>
            </svg>
        </div>';
    } );

    /* ローディングインジケーター用CSS */
    add_action( 'wp_head', function() {
    	$li_style =
    	'<style id="rearrange-god-mode-li">
    	@keyframes rotating {
            0% { transform: rotate(0); }
            100% { transform: rotate(360deg); }
        }

        #loading-indicator {
            background-color: #fafafa;
            border-radius: 10px;
            height: 50px;
            left: calc(50% - 25px);
            opacity: 0;
            position: fixed;
            top: calc(50% - 25px);
            -webkit-transition: opacity .2s ease-in-out, visibility .2s ease-in-out;
            transition: opacity .2s ease-in-out, visibility .2s ease-in-out;
            visibility: hidden;
            width: 50px;
            z-index: 100000;
        }

    	#li-svg {
            animation: rotating 1s linear infinite;
            left: calc(50% - 17px);
            height: 34px;
            position: absolute;
            top: calc(50% - 17px);
            width: 34px;
    	}
    	</style>';

        echo $li_style;
    }, 30 );

endif;


/* iframeタグが自動変換されるのを防ぐ */
add_filter( 'no_texturize_tags', function( $tag ) {
    $tag[] = 'iframe';
    return $tag;
}, 10, 1 );