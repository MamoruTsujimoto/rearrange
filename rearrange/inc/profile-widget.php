<?php

/*---------------------------------------------------------------------------
 * プロフィールウィジェット
 *---------------------------------------------------------------------------*/
class Profile_Widget extends WP_Widget {

	/* Profile_Widget コンストラクタ */
	public function __construct() {
		$widget_options = [
			'classname'                     => 'rearrange-profile',
			'description'                   => 'プロフィールを表示します。',
			'customize_selective_refresh'   => true,
		];
		$control_options = [ 'width' => 400, 'height' => 350 ];
		parent::__construct( 'rearrange-profile', 'Rearrange - プロフィール', $widget_options, $control_options );
	}

	/**
	 * ウィジェットの内容をWebページに出力します（HTML表示）
	 *
	 * @param array $args       register_sidebar()で設定したウィジェットの開始/終了タグ、タイトルの開始/終了タグなどが渡される。
	 * @param array $instance   管理画面から入力した値が渡される。
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$name = ! empty( $instance['name'] ) ? $instance['name'] : '';
		$message = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$img_url = ! empty( $instance['image-url'] ) ? $instance['image-url'] : '';
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div id="rearrange-profile">
			<?php
				if ( '' !== $img_url ) {
					echo '<img src="'.$img_url.'" alt="プロフィール画像" />';
				}
				if ( '' !== $name ) {
					echo '<p class="g-name">'.$name.'</p>';
				}
				if ( '' !== $message ) {
					echo '<p class="g-message">'.$message.'</p>';
				}
			?>
        </div>

<?php
		echo $args['after_widget'];
	}

	/**
	 * 管理画面のウィジェット設定フォームを出力します。
	 *
	 * @param array $instance   現在のオプション値が渡される。
	 */
	public function form( $instance ) {

		$defaults = [
			'title' => '',
			'image-url' => '',
			'name'  => '',
			'text'  => ''
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = sanitize_text_field( $instance['title'] );
		$name = sanitize_text_field( $instance['name'] );
		$image_url = sanitize_text_field( $instance['image-url'] );
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'name' ); ?>">名前:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>">メッセージ:</label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea>
        </p>


 		<p>
        	<label for="<?php echo $this->get_field_id( 'image-url' ); ?>">画像:</label>
            <?php
            	$p_style = '';
            	$img_style = '';
	            if ( empty( $image_url ) ) {
					$img_style = ' style="display: none;"';
	            } else {
	            	$p_style = ' style="display: none;"';
	            }
            ?>
            <p class="gp-img-placeholder"<?php echo $p_style; ?>>画像が選択されていません</p>
            <p><img class="gp-image-view" src="<?php echo $image_url; ?>" width="260"<?php echo $img_style; ?> /></p>

            <input class="widefat gp-image-url" id="<?php echo $this->get_field_id( 'image-url' ); ?>" name="<?php echo $this->get_field_name( 'image-url' ); ?>" type="text" value="<?php echo esc_attr( $image_url ); ?>" />
            <button type="button" class="gp-select-image button">画像を選択</button>
            <button type="button" class="gp-delete-image button"<?php echo $img_style; ?>>画像を削除</button>
        </p>
        <script>
			jQuery(document).ready(function($) {

			   let frame;
			   const placeholder = $('.gp-img-placeholder');
			   const imageUrl = $('.gp-image-url');
			   const imageView = $('.gp-image-view');
			   const deleteImage = $('.gp-delete-image');

			   $('.gp-select-image').on('click', function(e) {
			      e.preventDefault();

			      if ( frame ) {
			         frame.open();
			         return;
			      }

			      frame = wp.media({
			         title: 'プロフィール画像を選択',
			         library: {
			            type: 'image'
			         },
			         button: {
			            text: 'ウィジェットに追加'
			         },
			         multiple: false
			      });

			      frame.on('select', function() {
			         let images = frame.state().get('selection');
			         images.each(function(file) {
			            placeholder.css('display', 'none');
			            imageUrl.val(file.toJSON().url);
			            imageView.attr('src', file.toJSON().url).css('display', 'block');
			            deleteImage.css('display', 'inline-block');
			         });
			         imageUrl.trigger('change');
			      });

			      frame.open();
			   });

			   $('.gp-delete-image').off().on('click', function(e) {
			      e.preventDefault();

			      imageUrl.val('');
			      imageView.css('display', 'none');
			      deleteImage.css('display', 'none');
			      imageUrl.trigger('change');
			   });

			});
        </script>
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
		$instance['name']  = sanitize_text_field( $new_instance['name'] );
		$instance['image-url']  = sanitize_text_field( $new_instance['image-url'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text']   = $new_instance['text'];
		} else {
			$instance['text']   = wp_kses_post( $new_instance['text'] );
		}
		return $instance;
	}
}

/*---------------------------------------------------------------------------
 * ウィジェットテンプレートの登録
 *---------------------------------------------------------------------------*/
add_action( 'widgets_init', function() {
	register_widget( 'Profile_Widget' );
}, 1 );
