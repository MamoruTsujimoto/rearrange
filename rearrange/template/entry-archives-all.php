<?php
global $rearrange;
$categories = category_count_sort($rearrange['categories']);
?>

<section class="story-archives">
  <h1 class="section-title"><?php echo get_the_title(); ?></h1>

  <?php foreach($categories as $category): ?>
  <?php
  $cat_id = $category->term_id;
  $cat_name = $category->name;
  $cat_count = $category->category_count;
  $cat_url = get_category_link($cat_id);
  ?>
  <div class="story-archives-block">
    <div class="story-archives-category">
      <a href="<?php echo $cat_url; ?>"><?php echo $cat_name; ?></a> <span>- <?php echo $cat_count; ?> Articles -</span>
    </div>
    <?php
    $args = array( 'cat'=> $cat_id, 'order'=> 'DESC' );
    $custom_post = new WP_Query($args);

    if ( $custom_post->have_posts() ) :
      while ( $custom_post->have_posts() ) : $custom_post->the_post();
      $post_url = get_permalink();
      $title = get_the_title();
      $posted = get_post_time('F d, Y');
    ?>
    <div class="story-archives-list">
      <a href="<?php echo $post_url; ?>" class="underline"><?php echo $title; ?><span><?php echo $posted; ?></span></a>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
  <?php endforeach; ?>
</section>