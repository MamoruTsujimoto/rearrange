<?php
global $rearrange, $post;

get_header();

$cat = get_the_category($post->ID)[0];
$cat_link = get_category_link($cat->term_id);
$get_the_time = get_the_time();
$get_the_modified_date = get_the_modified_date();
$posted = 'Posted on '.get_post_time('F d, Y');
$updated = 'Updated on '.get_the_modified_time('F d, Y');
?>

<article id="story-<?php echo $post->ID; ?>" class="article">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
  <header>
    <h1>
      <?php
      echo $title = str_replace('非公開: ', '', get_the_title());
      ?>
    </h1>

    <div class="article-meta">
      <ul>
        <?php if($get_the_time != $get_the_modified_date):?>
        <li><?php echo $updated; ?></li>
        <?php endif; ?>
        <li><?php echo $posted; ?></li>
        <li><a href="<?php echo $cat_link; ?>"><?php echo $cat->name; ?></a></li>
      </ul>
    </div>

    <?php
    if ( $rearrange['has_post_thumbnail'] ) :
      $thumbnail_id = get_post_thumbnail_id($post->ID);
      $thumbnail_info = wp_get_attachment_image_src($thumbnail_id, 'full');
      $thumbnail_w = $thumbnail_info[1];
      $thumbnail_h = $thumbnail_info[2];
      $rearrange['thumbnail_url'] = $thumbnail_info[0];
      $position = !empty(get_field('post_eyecatch_position')) ? ' '.get_field('post_eyecatch_position') : '';
      $outline = get_field('post_eyecatch_outline') == 'true' ? ' outline' : '';
    ?>
    <figure class="article-eyecatch cl photo">
      <div class="article-eyecatch-image<?php echo $outline; ?><?php echo $position; ?>" style="background-image: url(<?php echo $rearrange['thumbnail_url']; ?>);"></div>
      <?php if($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
      <figcaption><?php echo $caption; ?></figcaption>
      <?php endif; ?>
    </figure>
    <?php endif; ?>
  </header>

  <div class="article-body">
    <?php the_content(); ?>
  </div>

  <footer>
    <div class="article-meta">
      <ul>
        <?php if($get_the_time != $get_the_modified_date):?>
        <li><?php echo $updated; ?></li>
        <?php endif; ?>
        <li><?php echo $posted; ?></li>
        <li><a href="<?php echo $cat_link; ?>"><?php echo $cat->name; ?></a></li>
      </ul>
      <?php
        $tags = get_the_tags();
        if($tags):
      ?>
      <div class="article-meta-tag">
        <div class="article-meta-tag-heading">tags:</div>
        <div class="article-meta-tag-wrapper">
          <?php foreach($tags as $tag): ?>
          <div class="tag"><?php echo $tag->name; ?></div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php
        endif;
      ?>
    </div>
  </footer>
<?php endwhile; ?>
<?php endif; ?>
</article>

<!-- footer -->
<?php get_footer(); ?>
