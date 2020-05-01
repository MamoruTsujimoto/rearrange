<?php

// $prev_svg = '<svg id="pager-chevron-left" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 24 24"><path d="M14 20c0.128 0 0.256-0.049 0.354-0.146 0.195-0.195 0.195-0.512 0-0.707l-8.646-8.646 8.646-8.646c0.195-0.195 0.195-0.512 0-0.707s-0.512-0.195-0.707 0l-9 9c-0.195 0.195-0.195 0.512 0 0.707l9 9c0.098 0.098 0.226 0.146 0.354 0.146z" fill="#333"></path></svg>';
// $next_svg = '<svg id="pager-chevron-right" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 19 22"><path d="M5 20c-0.128 0-0.256-0.049-0.354-0.146-0.195-0.195-0.195-0.512 0-0.707l8.646-8.646-8.646-8.646c-0.195-0.195-0.195-0.512 0-0.707s0.512-0.195 0.707 0l9 9c0.195 0.195 0.195 0.512 0 0.707l-9 9c-0.098 0.098-0.226 0.146-0.354 0.146z" fill="#333"></path></svg>';


global $wp_query;
$big = 999999999;

$args = [
    // 'prev_text' => $prev_svg,
    // 'next_text' => $next_svg,
    // 'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	// 'format'    => '?paged=%#%',
	'current'   => max( 1, get_query_var('paged') ),
	'total'     => $wp_query->max_num_pages,
    'prev_next' => false,
    'end_size'  => 0,
    'mid_size'  => 1,
    'type'      => 'list'
];

$paginate_links = paginate_links( $args );

if ( NULL !== $paginate_links ) {
    echo '<nav class="pagination">'.$paginate_links.'</nav>';
}


