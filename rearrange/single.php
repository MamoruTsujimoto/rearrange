<?php
global $rearrange, $post;

get_header();

$cat = get_the_category($post->ID)[0];
?>

<article id="story-<?php echo $post->ID; ?>" class="article">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
  <header>
    <h1>
      <?php the_title(); ?>
    </h1>

    <div class="article-info">
      <ul>
        <li><strong class="date"><?php echo get_post_time('F d, Y'); ?></strong></li>
        <li><?php echo $cat->name; ?></li>
      </ul>
    </div>
    <?php
    if ( $rearrange['has_post_thumbnail'] ) :
      $rearrange['thumbnail_url'] = get_the_post_thumbnail_url();
      $outline = get_field('post_eyecatch_outline') == 'true' ? ' outline' : '';
    ?>
    <figure class="article-eyecatch cl photo">
      <div class="article-eyecatch-image<?php echo $outline; ?>" style="background-image: url(<?php echo $rearrange['thumbnail_url']; ?>);"></div>
      <?php if($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
      <figcaption><?php echo $caption; ?></figcaption>
      <?php endif; ?>
    </figure>
    <?php endif; ?>
  </header>

  <div class="article-body">
    <?php the_content(); ?>
  </div>
<?php endwhile; ?>
<?php endif; ?>
</article>

<!-- footer -->
<?php get_footer(); ?>
