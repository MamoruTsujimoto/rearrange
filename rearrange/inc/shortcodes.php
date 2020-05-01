<?php

/*---------------------------------------------------------------------------
 * ショートコード達
 *---------------------------------------------------------------------------*/

$func = 'add_' . 'short' . 'code';

/* Godモード用広告 */
$func( 'ad', function( $atts, $content = null ) {
    $type   = isset( $atts['type'] ) ? $atts['type'] : '';
    $class  = isset( $atts['class'] ) ? $atts['class'] : '';
    $god_ad  = '<div class="refresh-wrap '.$class.'" itemscope itemtype="https://schema.org/WPAdBlock"><div class="refresh-body '.$type.'">';
    $god_ad .= preg_replace( '/\<p\>|\<\/p\>|\<br \/\>/', '', $content );
    $god_ad .= '</div></div>';
    return $god_ad;
} );


/* Godモード用広告（iframe版） */
$func( 'adiframe', function( $atts, $content = null ) {
    global $rearrange;
    
    $class = isset( $atts['class'] ) ? $atts['class'] : '';
    $god_ad_iframe  = '<div class="refresh-wrap '.$class.'" itemscope itemtype="https://schema.org/WPAdBlock"><div class="refresh-body">';
    
    if ( isset( $rearrange['god_mode']['enable'] ) && true === $rearrange['god_mode']['enable'] ) {
        $god_ad_iframe .= '<iframe srcdoc="';
    }
    
    $god_ad_iframe .= esc_attr( preg_replace( '/\<p\>|\<\/p\>|\<br \/\>/', '', $content ) );
    
    if ( isset( $rearrange['god_mode']['enable'] ) && true === $rearrange['god_mode']['enable'] ) {
        $god_ad_iframe .= '"></iframe>';
    }
    
    $god_ad_iframe .= '</div></div>';
    
    return $god_ad_iframe;
} );


/* code */
$func( 'code', function( $atts, $content = null ) {
    $lang = isset( $atts['lang'] ) ? $atts['lang'] : '';
    $name = isset( $atts['name'] ) ? $atts['name'] : '';
    
    $code  = '<pre>';
    if ( '' !== $name || '' !== $lang ) {
        $dot = '' !== $name && '' !== $lang ? '.' : '';
        $code .= '<span class="code-title">' . $name . $dot . $lang . '</span>';
    }
    $code .= '<code>';
    $code .= esc_html( $content );
    $code .= '</code></pre>';
    return $code;
} );