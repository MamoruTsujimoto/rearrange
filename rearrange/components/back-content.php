<?php
global $rearrange;
$categories = $rearrange['categories'];
$cat_total = count($categories);
$counts = wp_count_posts();
$count_posts = $counts->publish;
$target_all_posts = $rearrange['other']['target_posts'];
$target_total_percent = ($count_posts / $target_all_posts) * 100;
?>
<div id="overlay">
  <div id="close"><span></span></div>
  <div id="back-content">
    <div class="info">
      <div class="info-box info-category">
        <a href="#">
          <div class="chart large" style="--value:<?php echo $target_total_percent; ?>%">
            <p<?php echo $count_posts >= $target_all_posts ? ' class="achievement"' : ''; ?>><?php echo $target_total_percent; ?>%</p>
          </div>
          <div class="chart-text">Target Post: <?php echo $count_posts; ?>/<?php echo $target_all_posts; ?></div>
        </a>
      </div>
    <?php
    $total_post_count = 0;

    foreach($categories as $category) {
      if($category->count !== 0) {
        $target_post_count = get_field("target_post_count", "term_" . $category->term_id);
        if($target_post_count !== null) {
          $cat_name = $category->name;
          $cat_link = get_category_link($category->term_id);
          $post_count = $category->count;
          $total_post_count += (int)$post_count;
          $target_percent = ($post_count / $target_post_count) * 100;
    ?>
      <div class="info-box info-category">
        <a href="<?php echo $cat_link; ?>">
          <div class="chart" style="--value:<?php echo $target_percent; ?>%">
            <p<?php echo $post_count >= $target_post_count ? ' class="achievement"' : ''; ?>><?php echo $target_percent; ?>%</p>
          </div>
          <div class="chart-text"><?php echo $cat_name; ?>: <?php echo $post_count; ?>/<?php echo $target_post_count; ?></div>
        </a>
      </div>
    <?php
        }
      }
    }
    ?>
    </div>
  </div>
</div>