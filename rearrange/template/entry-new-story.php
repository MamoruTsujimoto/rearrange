<?php
global $rearrange;
$sticky_post = get_option('sticky_posts');
$args = array('posts_per_page' => 1, 'post__in' => $sticky_post, 'ignore_sticky_posts' => 1, 'order'=> 'DESC' );
$custom_post = new WP_Query($args);
?>

<?php if ( $custom_post->have_posts() ) : ?>
<?php while ( $custom_post->have_posts() ) : $custom_post->the_post(); ?>
<?php if (is_sticky(get_the_ID())): ?>
<section id="new-story">
  <article id="story-<?php echo get_the_ID(); ?>">
    <?php $url = get_the_permalink(); ?>
    <a href="<?php echo $url; ?>">
      <div id="new-story-entrance"><span class="story-category"><?php echo get_the_category()[0]->name; ?></span>
        <h1>
          <?php
          $title = get_the_title();
          echo $title;
          ?>
        </h1>
        <div id="new-story-information">
          <?php
          $post_temperature = !empty(get_field('post_temperature')) ? ' - '.get_field('post_temperature').'℃' : '';
          ?>
          <ul class="story-status">
            <li><span class="story-publish"><?php echo get_post_time('F d, Y'); ?><?php echo $post_temperature; ?></span></li>
          </ul>
          <?php
          $excerpt = get_the_excerpt();
          if ( '' !== $excerpt ) {
            echo '<p>'.$excerpt.'</p>';
          }
          ?>
        </div>
        <div class="btn btn-readmore">read more</div>
      </div>

      <?php
        if ( has_post_thumbnail() ) {
          $id = get_the_ID();
          $thumbnail = get_the_post_thumbnail_url($id);
          $outline = get_field('post_eyecatch_outline') == 'true' ? ' outline' : '';
          $zoom = get_field('post_eyecatch_zoom') == 'true' ? ' zoom' : '';
          $position = !empty(get_field('post_eyecatch_position')) ? ' '.get_field('post_eyecatch_position') : '';
          echo '<div id="new-story-image">'."\n";
          echo '<div class="new-image lazyload'.$outline.$position.$zoom.'" style="background-image: url('.$thumbnail.')" data-bg="'.$thumbnail.'"></div>'."\n";
          echo '</div>'."\n";
        } else {
          echo '<div id="new-story-image" class="no-image lazyload"></div>'."\n";
        }
      ?>

    </a>
  </article>
</section>
<?php endif; ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
