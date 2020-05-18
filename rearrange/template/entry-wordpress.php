<?php
global $rearrange;
$cat_diary = get_category_by_slug("wordpress");
$cat_diary_name = $cat_diary->name;
$cat_diary_id = $cat_diary->term_id;
$args = array( 'cat'=> $cat_diary_id, 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'order'=> 'DESC' );
$custom_post = new WP_Query($args);
?>

<?php if ( $custom_post->have_posts() ) : ?>
<section class="story-past">
  <h1 class="section-title" id="diary"><?php echo $cat_diary_name; ?></h1>
  <div class="article-wrapper">
    <?php while ( $custom_post->have_posts() ) : $custom_post->the_post(); ?>
    <article id="story-<?php echo get_the_ID(); ?>" class="wordpress">
      <?php $url = get_permalink(); ?>
      <a href="<?php echo $url; ?>">
        <?php
          if ( has_post_thumbnail() ) {
            $id = get_the_ID();
            $thumbnail = get_the_post_thumbnail_url($id);
            echo '<div class="story-figure figure" style="background-image: url('.$thumbnail.')"></div>'."\n";
          } else {
            $no_image    = get_theme_file_uri( '/assets/img/wordpress-logo.png' );
            $thumbnail = $no_image;
            echo '<div class="story-figure figure" style="background-image: url('.$thumbnail.')"></div>'."\n";
          }
        ?>
        <div class="story-entrance">
          <?php
          $title = get_the_title();
          echo '<h1>'.$title.'</h1>';
          ?>
          <div class="story-information">
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
        </div>
      </a>
    </article>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </div>
  <div class="btn btn-viewall"><a href="<?php echo get_category_link($cat_diary_id); ?>">view all</a></div>
</section>
<?php else: ?>
<p>記事が見つかりませんでした。</p>
<?php endif; ?>
