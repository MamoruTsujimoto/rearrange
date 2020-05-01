<?php
    $defaults = [
    	'before'    => '',
    	'after'     => '',
    	'separator' => '',
    	'echo'      => 0,
    ];
    
    $link_pages = wp_link_pages( $defaults );
    if ( '' !== $link_pages ) {
        echo '<div class="pagination"><ul class="page-numbers">';
        preg_match_all( '/(<a [^>]*>[\d]+<\/a>|[\d]+)/i', $link_pages, $matched, PREG_SET_ORDER );
        foreach ( $matched as $link ) {
            if ( preg_match( '/<a ([^>]*)>([\d]+)<\/a>/i', $link[0], $link_matched ) ) {
                echo '<li><a class="page-numbers" '.$link_matched[1].'>'.$link_matched[2].'</a></li>';
            } else {
                echo '<li><span class="page-numbers current">'.$link[0].'</span></li>';
            }
        }
        echo '</ul></div>';
    }
?>