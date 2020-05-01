<?php global $rearrange; ?>

<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <section class="entry-list">
      <?php $url = get_permalink(); ?>
      <a href="<?php echo $url; ?>">
        <div class="entry-image">
          <?php
          if ( isset( $rearrange['lazy_load']['enable'] ) && true === $rearrange['lazy_load']['enable'] ) :
            if ( has_post_thumbnail() ) {
              $id = get_the_ID();
              $square_S = get_the_post_thumbnail_url( $id, 'square-small' );
              $square_L = get_the_post_thumbnail_url( $id, 'square-large' );
              $data_srcset = $square_L.' 2000w, '.$square_S.' 414w';
              $src = PLACEHOLDER_IMAGE;
              $srcset = PLACEHOLDER_IMAGE . ' 5000w';

              $args = [
                'class' => 'lazyload',
                'src' => $src,
                'srcset' => $srcset,
                'data-src' => $square_L,
                'data-srcset' => $data_srcset,
                'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw'
              ];
              the_post_thumbnail( 'rectangle-large', $args );
            } else {
              $square_S    = get_theme_file_uri( '/images/no-image-ss.png' );
              $square_L    = get_theme_file_uri( '/images/no-image-sl.png' );
              $data_srcset = $square_L.' 2000w, '.$square_S.' 414w';
              $src = PLACEHOLDER_IMAGE;
              $srcset = PLACEHOLDER_IMAGE . ' 5000w';
              echo '<img src="'.$src.'" srcset="'.$srcset.'" data-src="'.$square_L.'" data-srcset="'.$data_srcset.'" alt="no image" title="no image" height="358" width="600" class="lazyload" sizes="(max-width: 414px) 33.3vw, (max-width: 375px) 50vw" />';
            }
          else:
            if ( has_post_thumbnail() ) {
              $id = get_the_ID();
              $square_S = get_the_post_thumbnail_url( $id, 'square-small' );
              $square_L = get_the_post_thumbnail_url( $id, 'square-large' );
              $srcset = $square_L.' 2000w, '.$square_S.' 414w';
              $args = [
                'srcset' => $srcset,
                'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw'
              ];
              the_post_thumbnail( 'rectangle-large', $args );
            } else {
              $square_L    = get_theme_file_uri( '/images/no-image-sl.png' );
              echo '<img src="'.$square_L.'no-image-sl.png" alt="no image" title="no image" height="220" width="220" />';
            }
          endif;
          ?>
        </div>
        <div class="entry-inner">
          <header>
            <?php if ( 'page' !== get_post_type() && true === $rearrange['entry_list']['show_category'] ) : ?>
              <p class="entry-category">
                <?php echo get_the_category()[0]->name; ?>
              </p>
            <?php endif; ?>
            <h2 class="entry-title">
              <?php
              $title = get_the_title();
              echo $title;
              ?>
            </h2>
          </header>

          <?php
          if ( true === $rearrange['entry_list']['show_excerpt']) {
            $excerpt = get_the_excerpt();
            if ( '' !== $excerpt ) {
              echo '<div class="entry-content"><p>'.$excerpt.'</p></div>';
            }
          }
          ?>
          <?php if ( true === $rearrange['entry_list']['show_date'] ) : ?>
            <footer class="entry-footer">
              <span class="entry-date"><?php echo get_the_date(); ?></span>
            </footer>
          <?php endif; ?>
        </div>
      </a>
    </section>
    <?php
    $rearrange['schema_org'][] = [
      '@context'      => 'http://schema.org',
      '@type'         => 'CreativeWork',
      'headline'      => $title,
      'url'           => $url,
      'datePublished' => get_the_date( 'c' ),
      'description'   => $excerpt
    ];
    ?>
  <?php endwhile; ?>

  <?php else: ?>
    <p>記事が見つかりませんでした。</p>
    <?php endif; ?>