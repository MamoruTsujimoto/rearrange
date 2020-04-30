<?php
global $rearrange, $post;

if ( false === $rearrange['related_entry']['show'] ) {
    return;
} 

$cat_ids = [];
foreach( $rearrange['post']['categories'] as $cat ) {
    $cat_ids[] = $cat->term_id;
}

$args = [
    'category__in'   => $cat_ids,
    'post__not_in'   => [ $post->ID ],
    'posts_per_page' => 10,
    'no_found_rows'  => true,
    'orderby'        => 'rand'
]; 

$the_query = new WP_Query( $args );


if ( ! function_exists( 'rearrange_get_srcset' ) ) {
    function rearrange_get_srcset( $curren_post, $square_L, $rectangle_M, $rectangle_L ) {
        $srcset = '';
        switch ( $curren_post ) {
            case 0: $srcset = $rectangle_M.' 2000w, '.$square_L.' 600w, '.$rectangle_L.' 375w'; break;
            case 1: $srcset = $rectangle_M.' 2000w, '.$square_L.' 600w'; break;
            case 2: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w'; break;
            case 3: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w'; break;
            case 4: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w'; break;
            case 5: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w, '.$rectangle_L.' 375w'; break;
            case 6: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w'; break;
            case 7: $srcset = $square_L.' 2000w, '.$rectangle_M.' 700w, '.$square_L.' 600w'; break;
            case 8: $srcset = $rectangle_M.' 2000w, '.$square_L.' 600w'; break;
            case 9: $srcset = $rectangle_M.' 2000w, '.$square_L.' 600w'; break;
            default: $srcset = $rectangle_M.' 2000w, '.$square_L.' 600w'; break;
        }
        return $srcset;
    }
}
?>
<div id="related">

    <div class="related-head">
        <h2>関連記事</h2>
    </div>

    <div id="related-entry">
        <?php if ( $the_query->have_posts() ) : ?>
            <ul class="related-entry">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="related-image">
                                <?php
                                    if ( isset( $rearrange['lazy_load']['enable'] ) && true === $rearrange['lazy_load']['enable'] ) :
                                        if ( has_post_thumbnail() ) :
                                            $id = get_the_ID();
                                            $square_L    = get_the_post_thumbnail_url( $id, 'square-large' );
                                            $rectangle_M = get_the_post_thumbnail_url( $id, 'rectangle-medium' );
                                            $rectangle_L = get_the_post_thumbnail_url( $id, 'rectangle-large' );
                                            $data_srcset = rearrange_get_srcset( $the_query->current_post, $square_L, $rectangle_M, $rectangle_L );
                                            $src = PLACEHOLDER_IMAGE;
                                            $srcset = PLACEHOLDER_IMAGE . ' 5000w';

                                            $args = [
                                                'class' => 'lazyload',
                                                'src' => $src,
                                                'srcset' => $srcset,
                                                'data-src' => $rectangle_L,
                                                'data-srcset' => $data_srcset,
                                                'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw'
                                            ]; 
                                            the_post_thumbnail( 'rectangle-large', $args );
                                        else:
                                            $square_L    = get_theme_file_uri( '/images/no-image-sl.png' );
                                            $rectangle_M = get_theme_file_uri( '/images/no-image-rm.png' );
                                            $rectangle_L = get_theme_file_uri( 'images/no-image-rl.png' );
                                            $data_srcset = rearrange_get_srcset( $the_query->current_post, $square_L, $rectangle_M, $rectangle_L );
                                            $src = PLACEHOLDER_IMAGE;
                                            $srcset = PLACEHOLDER_IMAGE . ' 5000w';
                                            echo '<img src="'.$src.'" srcset="'.$srcset.'" data-src="'.$rectangle_L.'" data-srcset="'.$data_srcset.'" alt="no image" title="no image" height="358" width="600" class="lazyload" sizes="(max-width: 414px) 33.3vw, (max-width: 375px) 50vw" />';
                                        endif;
                                    else:
                                        if ( has_post_thumbnail() ) :
                                            $id = get_the_ID();
                                            $square_L    = get_the_post_thumbnail_url( $id, 'square-large' );
                                            $rectangle_M = get_the_post_thumbnail_url( $id, 'rectangle-medium' );
                                            $rectangle_L = get_the_post_thumbnail_url( $id, 'rectangle-large' );
                                            $srcset = rearrange_get_srcset( $the_query->current_post, $square_L, $rectangle_M, $rectangle_L );
                                            
                                            $args = [
                                                'srcset' => $srcset,
                                                'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw'
                                            ]; 
                                            the_post_thumbnail( 'rectangle-large', $args );
                                        else:
                                            $square_L = get_theme_file_uri( '/images/no-image-sl.png' );
                                            echo '<img src="'.$square_L.'no-image-sl.png" alt="no image" title="no image" height="250" width="250" />';
                                        endif;
                                    endif;
                                ?>
                            </div>
                            <div class="related-title">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        <?php else: ?>
            <p>関連記事は見つかりませんでした。</p>
        <?php endif; ?>
        
    </div>

</div>