<?php

global $rearrange;
/*---------------------------------------------------------------------------
 * 検索関連
 *---------------------------------------------------------------------------*/

if ( isset( $rearrange['search']['remove_page'] ) ) {
    /* 検索結果から固定ページを除外 */
    add_filter( 'posts_search', function( $query ) {
        if ( is_search() && ! is_admin() ) {
            $query .= " AND post_type not in('page')";
        }
        return $query;
    } );
}