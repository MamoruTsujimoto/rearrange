<?php

/*---------------------------------------------------------------------------
 * 広告（iframe版）ウィジェット
 *---------------------------------------------------------------------------*/
class Ad_Iframe_Widget extends WP_Widget {

	/* Ad_Iframe_Widget コンストラクタ */
	public function __construct() {
		$widget_options = [
			'classname'                     => 'rearrange-ad-iframe',
			'description'                   => 'Godモード適用時に「Rearrange - 広告」を使用しても広告が表示されない場合、こちらのiframe版をお試しください。scriptタグをiframeで読み込みます。(※表示されるかもしれません)',
			'customize_selective_refresh'   => true,
		];
		$control_options = [ 'width' => 400, 'height' => 350 ];
		parent::__construct( 'rearrange-ad-iframe', 'Rearrange - 広告（iframe版）', $widget_options, $control_options );
	}

	/**
	 * ウィジェットの内容をWebページに出力します（HTML表示）
	 *
	 * @param array $args       register_sidebar()で設定したウィジェットの開始/終了タグ、タイトルの開始/終了タグなどが渡される。
	 * @param array $instance   管理画面から入力した値が渡される。
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		global $rearrange;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$script = ! empty( $instance['script'] ) ? $instance['script'] : '';

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<div id="<?php echo $args['widget_id']; ?>" class="refresh-wrap" itemscope itemtype="https://schema.org/WPAdBlock">
		    <div class="refresh-body">
		    	<?php
		    		if ( isset( $instance['is_shortcode'] ) && '' !== $instance['is_shortcode'] ) {
		    			$script = do_shortcode( $script );
		    		}
		    	?>
		    	<?php if ( isset( $rearrange['god_mode']['enable'] ) && true === $rearrange['god_mode']['enable'] ) : ?>
		        	<iframe srcdoc="<?php echo esc_attr( $script ); ?>"></iframe>
		    	<?php else: ?>
					<?php echo $script; ?>
		    	<?php endif; ?>
            </div>
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
		    'title'  => '',
			'script' => '',
			'is_shortcode' => '',
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = sanitize_text_field( $instance['title'] );
		$script = $instance['script'];
		$shortcode_checked = '' === $instance['is_shortcode'] ? '' : 'checked';
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
			<input class="widefat" id="<?php echo $this->get_field_id( 'is_shortcode' ); ?>" name="<?php echo $this->get_field_name( 'is_shortcode' ); ?>" type="checkbox" value="true" <?php echo $shortcode_checked; ?> />
			<label for="<?php echo $this->get_field_id( 'is_shortcode' ); ?>">ショートコードを使用する</label><br />
			※ショートコードを使用する場合、ショートコードのみを入力してください。
		</p>

        <p>
            <label for="<?php echo $this->get_field_id( 'script' ); ?>">タグ:</label>
            <textarea class="widefat" rows="13" cols="20" id="<?php echo $this->get_field_id( 'script' ); ?>" name="<?php echo $this->get_field_name( 'script' ); ?>" placeholder="scriptタグ"><?php echo ( $script ); ?></textarea>
        </p>

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
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['script']  = $new_instance['script'];
		$instance['is_shortcode'] = sanitize_text_field( $new_instance['is_shortcode'] );
		return $instance;
	}
}

/*---------------------------------------------------------------------------
 * ウィジェットテンプレートの登録
 *---------------------------------------------------------------------------*/
add_action( 'widgets_init', function() {
	register_widget( 'Ad_Iframe_Widget' );
}, 3 );
