<?php
class Gimliii_Search extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'search',
			'description' => __( 'A search form for your site.' , 'gimliii' ),
		);
		$control_ops = array(
			'width' => 250,
			'height' => 350,
			'id_base' => 'search-widget'
		);
		parent::__construct( 'search-widget', __( 'Gimli Search', 'gimliii' ), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Search', 'gimliii' ) : $instance['title'], $instance, $this->id_base );
		$placeholder = empty( $instance['placeholder'] ) ? __( 'Search', 'gimliii' ) : $instance['placeholder'];
		?>
		<div class="lb lb-md">
			<h2>
				<?php
					if ( $title ) {
						echo $title;
					}
				?>
			</h2>
		</div>
		<div class="input-group margin-bottom-40">
			<form method="get" id="searchform" action="<?php echo esc_url(home_url()) ; ?>/">
				<input type="text" id="s" name="s" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>"  />
			</form>
		</div><!-- .search-widget /-->
		<?php
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'placeholder' => '' ) );
		$title = $instance['title'];
		$placeholder = $instance['placeholder'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'gimliii' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('placeholder'); ?>"><?php _e( 'Placeholder:', 'gimliii' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>" /></label></p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['placeholder'] = sanitize_text_field( $new_instance['placeholder'] );
		return $instance;
	}
}
