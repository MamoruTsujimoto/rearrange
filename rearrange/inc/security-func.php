<?php

// global $rearrange;

// /*---------------------------------------------------------------------------
//  * セキュリティ
//  *---------------------------------------------------------------------------*/

// /* 作成者ページを非表示(404)にする */
// if ( isset( $rearrange['security']['hide_author_page'] ) ) {
//     add_filter( 'parse_query', function( $query ) {
//         if ( ! is_admin() && is_author() ) {
//     		$query->set_404();
//     		status_header( 404 );
//     		nocache_headers();
//     	}
//     } );
// }