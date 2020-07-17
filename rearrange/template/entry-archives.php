<?php
global $rearrange;
$cat = get_category($cat);
$cat_name = $cat->name;
$cat_id = $cat->term_id;
$args = array( 'cat'=> $cat_id, 'posts_per_page' => 20, 'order'=> 'DESC' );
$custom_post = new WP_Query($args);
$use_category_figure = get_field('use_category_figure', 'term_'.$cat_id);
$outline = get_field('category_figure_outline', 'term_'.$cat_id);
$outline_class = ($outline === 'true') ? ' outline' : '';
?>

<?php if ( $custom_post->have_posts() ) : ?>
<section class="story-past">
  <h1 class="section-title" id="diary"><?php echo $cat_name; ?></h1>
  <div class="article-wrapper">
    <?php while ( $custom_post->have_posts() ) : $custom_post->the_post(); ?>
    <article id="story02">
      <?php $url = get_permalink(); ?>
      <a href="<?php echo $url; ?>">
        <?php
          if ( has_post_thumbnail() ) {
            $id = get_the_ID();
            $thumbnail = get_the_post_thumbnail_url($id);
            $position = !empty(get_field('post_eyecatch_position')) ? ' '.get_field('post_eyecatch_position') : '';
            echo '<div class="story-figure figure'.$position.'" style="background-image: url('.$thumbnail.')"></div>'."\n";
          } elseif( $use_category_figure !== 'false' &&  $use_category_figure !== null) {
            $thumbnail = get_field('category_figure', 'term_'.$cat_id);
            echo '<div class="story-figure figure other '.$outline_class.'" style="background-image: url('.$thumbnail.')"></div>'."\n";
          } else {
            echo '<div class="story-figure figure no-image"></div>'."\n";
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
</section>
<?php else: ?>
<p>記事が見つかりませんでした。</p>
<?php endif; ?>
