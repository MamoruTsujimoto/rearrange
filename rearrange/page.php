<?php
global $rearrange, $post;

get_header();

get_template_part( 'slider' );

?>

<!-- wrapper -->
<div id="wrapper" class="<?php echo $rearrange['column']['position']; ?>">

  <!-- side -->
  <?php if ( 'l-column' === $rearrange['column']['position'] ) get_sidebar(); ?>

  <!-- gadios wrapper -->
  <div id="rearrange-wrapper" class="<?php echo $rearrange['wrap']; ?>">
    <div class="rearrange-container">

      <!-- breadcrumb -->
      <?php get_template_part('breadcrumb'); ?>

      <!-- main -->
      <main>
        <article id="entry">
          <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>
            <?php if ( have_posts() ) : ?>
              <?php while ( have_posts() ) : the_post(); ?>
                <div class="entry-top-page entry-top <?php echo $rearrange['no-image-class']; ?>">
                  <?php
                  if ( $rearrange['has_post_thumbnail'] ) :
                    $rectangle_S = get_the_post_thumbnail_url( $post->ID, 'rectangle-small' );
                    $rectangle_M = get_the_post_thumbnail_url( $post->ID, 'rectangle-medium' );
                    $rearrange['thumbnail_url'] = $rectangle_M;
                    $args = [
                      'srcset' => $rectangle_S . ' 414w,'.$rectangle_M.'  2000w',
                      'sizes'  => '(max-width: 414px) 33.3vw, (max-width: 375px) 50vw'];
                      echo '<div class="entry-image">';
                      the_post_thumbnail( 'rectangle-medium', $args );
                      echo '</div>';
                    else:
                      $rearrange['thumbnail_url'] = get_theme_file_uri( '/images/no-image-rm.png' );
                    endif;
                    ?>
                    <header class="<?php echo $rearrange['no-image-class']; ?>">
                      <h1 class="entry-title">
                        <?php echo $post->post_title; ?>
                      </h1>
                      <p class="entry-meta">
                        <?php $rearrange['datePublished'] = get_the_date( 'c' ); ?>
                        <?php $rearrange['dateModified']  = get_the_modified_date( 'c' ); ?>

                        <?php if ( $rearrange['datePublished'] < $rearrange['dateModified'] ) : ?>
                          <span class="posted-date">
                            <?php the_date(); ?>
                          </span>

                          <span class="updated-date">
                            <time datetime="<?php echo $rearrange['dateModified']; ?>"><?php the_modified_date(); ?></time>
                          </span>
                          <?php else: ?>
                            <span class="posted-date">
                              <time datetime="<?php echo $rearrange['datePublished']; ?>"><?php the_date(); ?></time>
                            </span>
                          <?php endif; ?>
                        </p>
                      </header>
                    </div>

                    <div id="entry-content">
                      <?php the_content();?>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </article>

            <?php get_template_part( 'entry', 'pagination' ); ?>

          </main> <!-- main -->
          <?php get_template_part( 'inc/body', 'class' ); ?>
        </div> <!-- /rearrange-container -->
      </div> <!-- /rearrange-wrapper -->

      <!-- side -->
      <?php if ( 'r-column' === $rearrange['column']['position'] ) get_sidebar(); ?>

    </div> <!-- /wrapper -->

    <!-- footer -->
    <?php get_footer(); ?>