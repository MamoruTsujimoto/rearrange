<?php
global $rearrange, $is_IE;

if ( false === $rearrange['slider']['show'] ) {
    return;
}

$args = [
    'posts_per_page' => intval( $rearrange['slider']['show_counts'] ),
    'no_found_rows'  => true,
    'orderby'        => 'rand'
]; 

$the_query = new WP_Query( $args );
?>

<?php if ( 5 <= $the_query->post_count ) : ?>
    <div id="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <section class="swiper-slide">
                        <?php
                            if ( isset( $rearrange['lazy_load']['enable'] ) && true === $rearrange['lazy_load']['enable'] ) :
                                
                                if ( has_post_thumbnail() ) :
                                    $id = get_the_ID();
                                    $square_L    = get_the_post_thumbnail_url( $id, 'square-large' );
                                    $rectangle_L = get_the_post_thumbnail_url( $id, 'rectangle-large' );
                                    $data_srcset = $square_L.' 2000w, '.$rectangle_L.' 450w';
                                    $src = '';
                                    $srcset = '';
                                    if ( ! $is_IE ) {
                                        $src = PLACEHOLDER_IMAGE;
                                        $srcset = PLACEHOLDER_IMAGE . ' 5000w';
                                    }
                                    $args = [
                                        'class'       => 'swiper-lazy',
                                        'src'         => $src,
                                        'srcset'      => $srcset,
                                        'data-src'    => $rectangle_L,
                                        'data-srcset' => $data_srcset,
                                        'sizes'       => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw']; 
                                    the_post_thumbnail( 'rectangle-large', $args );
                                else:
                                    $square_L    = get_theme_file_uri( '/images/no-image-sl.png' );
                                    $rectangle_L = get_theme_file_uri( '/images/no-image-rl.png' );
                                    $data_srcset = $square_L.' 2000w, '.$rectangle_L.' 450w';
                                    $src = '';
                                    $srcset = '';
                                    if ( ! $is_IE ) {
                                        $src = PLACEHOLDER_IMAGE;
                                        $srcset = PLACEHOLDER_IMAGE . ' 5000w';
                                    }
                                    echo '<img src="'.$src.'" data-src="'.$rectangle_L.'" srcset="'.$srcset.'" data-srcset="'.$data_srcset.'" alt="no-image" height="358" width="600" class="swiper-lazy" sizes="(max-width: 414px) 33.3vw, (max-width: 375px) 50vw" />';
                                endif;
                                
                            else:
                                
                                if ( has_post_thumbnail() ) :
                                    $id = get_the_ID();
                                    $square_L    = get_the_post_thumbnail_url( $id, 'square-large' );
                                    $rectangle_L = get_the_post_thumbnail_url( $id, 'rectangle-large' );
                                    $srcset = $square_L.' 2000w, '.$rectangle_L.' 450w';
                                    $args = [
                                        'srcset' => $srcset,
                                        'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw']; 
                                    the_post_thumbnail( 'rectangle-large', $args );
                                else:
                                    $square_L = get_theme_file_uri( '/images/no-image-sl.png' );
                                    echo '<img src="'.$square_L.'no-image-sl.png" alt="no image" title="no image" height="220" width="220" />';
                                endif;
                                
                            endif;
                        ?>
                        
                        <header class="swiper-header">
                            <?php $url = esc_url( get_permalink() ); ?>
                            <a href="<?php echo $url; ?>">
                                <h2 class="swiper-title">
                                    <?php
                                        $title = get_the_title();
                                        echo $title;
                                    ?>
                                </h2>
                            </a>
                        </header>
                    </section>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>  
    
<?php else: ?>
    <p class="aligncenter">該当する記事が見つかりませんでした。</p>
    <p class="aligncenter">スライダーを表示するには最低5件記事が必要です。</p>
<?php endif; ?>
        
 