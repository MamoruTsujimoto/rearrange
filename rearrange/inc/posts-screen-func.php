<?php

/*---------------------------------------------------------------------------
 * 更新日
 *---------------------------------------------------------------------------*/
add_action( 'admin_menu', function() {
    add_meta_box( 'rearrange-update-modified-time', '更新日', 'update_modified_time_field', 'post', 'side', 'high' );
    add_meta_box( 'rearrange-update-modified-time', '更新日', 'update_modified_time_field', 'page', 'side', 'high' );
}, 10, 2 );
 
if ( ! function_exists( 'update_modified_time_field' ) ) :
    function update_modified_time_field() {
    	global $post;
    	$u_checked = '';
    	$nu_checked = '';
        'publish' === $post->post_status ? $nu_checked = 'checked' : $u_checked = 'checked';
        
    	echo '<div><label><input name="update_type" type="radio" value="update" '.$u_checked.' />更新する</label></div>';
    	echo '<div style="margin-top:5px;"><label><input name="update_type" type="radio" value="noupdate" '.$nu_checked.' />更新しない</label></div>';
    	echo '<div style="margin-top:5px;"><label><input name="update_type" type="radio" value="restore" />公開日に戻す</label></div>';
    }
endif;

add_action( 'wp_insert_post_data',  function( $data , $postarr ) {
    if ( ! isset( $postarr['update_type'] ) ) return $data;
    
    if ( 'noupdate' === $postarr['update_type'] ) {
        unset( $data['post_modified'] );
		unset( $data['post_modified_gmt'] );
    } elseif ( 'restore' === $postarr['update_type'] ) {
        $data['post_modified'] = $data['post_date'];
        $data['post_modified_gmt'] = $postarr['post_date_gmt'];
    }
    return $data;
    
}, 10, 2 );



/*---------------------------------------------------------------------------
 * 抜粋
 *---------------------------------------------------------------------------*/
add_action( 'wp_insert_post_data',  function( $data ) {

    if ( '' === $data['post_excerpt'] ) {
        $data['post_excerpt'] = str_replace( ["\r", "\n"], '', wp_strip_all_tags( mb_substr( $data['post_content'], 0, 200 ) ) );
    }
        
    return $data;
    
}, 11, 1 );
