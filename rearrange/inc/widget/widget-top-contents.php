<?php

/*---------------------------------------------------------------------------
 * トップコンテンツ ウィジェット
 *---------------------------------------------------------------------------*/
class Widget_Top_Contents extends WP_Widget {

	/* Widget_Top_Contents コンストラクタ */
	public function __construct() {
		$widget_options = [
			'classname'                     => 'rearrange-top-contents',
			'description'                   => 'トップコンテンツを配置します',
			'customize_selective_refresh'   => true,
		];
		$control_options = [ 'width' => 400, 'height' => 350 ];
		parent::__construct( 'rearrange-top-contents', 'コンテンツ', $widget_options, $control_options );
	}

	/**
	 * ウィジェットの内容をWebページに出力します（HTML表示）
	 *
	 * @param array $args       register_sidebar()で設定したウィジェットの開始/終了タグ、タイトルの開始/終了タグなどが渡される。
	 * @param array $instance   管理画面から入力した値が渡される。
	 */
	public function widget( $args, $instance ) {
    global $rearrange;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $cat_id = apply_filters( 'widget_category', empty( $instance['category'] ) ? '' : $instance['category'], $instance, $this->id_base );
    $view_count = empty( $instance['category'] ) ? 3 : $instance['count'];
    $classname = empty( $instance['classname'] ) ? '' : $instance['classname'];

    $cat_diary = get_category($cat_id);
    $cat_diary_name = $cat_diary->name;
    $cat_diary_id = $cat_diary->term_id;
    $args = array( 'cat'=> $cat_id, 'posts_per_page' => $view_count, 'post__not_in' => get_option('sticky_posts'), 'order'=> 'DESC' );
    $custom_post = new WP_Query($args);
    ?>
      <?php if ( $custom_post->have_posts() ) : ?>
      <section class="story-past">
        <h1 class="section-title" id="diary"><?php echo $cat_diary_name; ?></h1>
        <div class="article-wrapper">
          <?php while ( $custom_post->have_posts() ) : $custom_post->the_post(); ?>
          <?php if(!is_sticky(get_the_ID())): ?>
          <?php
          $term_id = get_the_category()[0]->term_id;
          $use_category_figure = get_field('use_category_figure', 'term_'.$term_id);
          $classname = ($use_category_figure === 'true') ? 'other' : '';
          $outline = get_field('category_figure_outline', 'term_'.$term_id);
          $outline_class = ($outline === 'true') ? ' outline' : '';
          ?>
          <article id="story-<?php echo get_the_ID(); ?>" class="<?php echo $classname; ?>">
            <?php $url = get_permalink(); ?>
            <a href="<?php echo $url; ?>">
              <?php
                if ( $use_category_figure !== 'false' &&  $use_category_figure !== null) {
                  $thumbnail = get_field('category_figure', 'term_'.$term_id);
                  echo '<div class="story-figure lazyload figure'.$outline_class.'" style="background-image: url('.$thumbnail.')"></div>'."\n";
                } else {
                  if ( has_post_thumbnail() ) {
                    $id = get_the_ID();
                    $thumbnail = get_the_post_thumbnail_url($id);
                    $outline = get_field('post_eyecatch_outline') == 'true' ? ' outline' : '';
                    $position = !empty(get_field('post_eyecatch_position_past')) ? ' '.get_field('post_eyecatch_position_past') : '';
                    echo '<div class="story-figure lazyload figure'.$outline.$position.'" style="background-image: url('.$thumbnail.')" data-bg="'.$thumbnail.'"></div>'."\n";
                  } else {
                    if ($classname !== 'wordpress') {
                      echo '<div class="story-figure figure lazyload no-image"></div>'."\n";
                    } else {
                      $no_image    = get_theme_file_uri( '/assets/img/wordpress-logo.png' );
                      $thumbnail = $no_image;
                      echo '<div class="story-figure lazyload figure" style="background-image: url('.$thumbnail.')"></div>'."\n";
                    }
                  }
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
          <?php endif; ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
        <div class="btn btn-viewall"><a href="<?php echo get_category_link($cat_diary_id); ?>">view all</a></div>
      </section>
      <?php endif; ?>

    <?php
	}

	/**
	 * 管理画面のウィジェット設定フォームを出力します。
	 *
	 * @param array $instance   現在のオプション値が渡される。
	 */
	public function form( $instance ) {

		$defaults = [
      'title' => '',
			'category'  => '1',
      'count'  => '3',
      'classname' => ''
		];
    $instance = wp_parse_args( (array) $instance, $defaults );
    $title = sanitize_text_field( $instance['title'] );
    $selected = $instance['category'];
    $count = $instance['count'];
    $classname = $instance['classname'];
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル:</label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'category' ); ?>" class="widget-label">カテゴリ:</label>
      <?php
      $args = array(
        'id' => $this->get_field_id( 'category' ),
        'name' => $this->get_field_name( 'category' ),
        'selected' => $selected,
        'class' => 'widget-form-select'
      );
      wp_dropdown_categories($args);
      ?>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'count' ); ?>" class="widget-label">件数:</label>
      <input class="widefat widget-form-input" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'classname' ); ?>" class="widget-label">クラス名:</label>
      <input class="widefat widget-form-input" id="<?php echo $this->get_field_id( 'classname' ); ?>" name="<?php echo $this->get_field_name( 'classname' ); ?>" type="text" value="<?php echo esc_attr( $classname ); ?>" />
    </p>
    <style>
    .widget-label {display:block;}
    .widget-form-select {width:100%;}
    .widget-form-input {width:100%;}
    </style>
<?php
	}

	/**
	 * ウィジェットオプションのデータ検証/無害化
	 *
	 * @param array $new_instance   新しいオプション値
	 * @param array $old_instance   以前のオプション値
	 *
	 * @return array データ検証/無害化した値を返す
	 */
	public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['category']  = $new_instance['category'];
    $instance['count']  = $new_instance['count'];
    $instance['classname']  = $new_instance['classname'];
		return $instance;
	}
}

/*---------------------------------------------------------------------------
 * ウィジェットテンプレートの登録
 *---------------------------------------------------------------------------*/
add_action( 'widgets_init', function() {
	register_widget( 'Widget_Top_Contents' );
}, 1 );
