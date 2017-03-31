<?php

class Gimliii_Posts_List extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'posts-list',
			'description' => __( 'Display list of recent&#47;popular&#47;random posts with or without thumbnails.' , 'gimliii' ),
		);
		$control_ops = array(
			'width' => 250,
			'height' => 350,
			'id_base' => 'posts-list-widget'
		);
		parent::__construct( 'posts-list-widget', __('Gimli Posts list', 'gimliii'), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_posts = $instance['no_of_posts'];
		$posts_order = $instance['posts_order'];
		$thumb = $instance['thumb'];

		echo $before_widget;
		echo $before_title;
		echo $title ; ?>
		<?php echo $after_title; ?>
				<ul class="gimliii-post-list">
					<?php
					if( $posts_order == 'popular' )
						gimliii_popular_posts($no_of_posts , $thumb);

					elseif( $posts_order == 'random' )
						gimliii_random_posts($no_of_posts , $thumb);

					else
						gimliii_last_posts($no_of_posts , $thumb)?>
				</ul>
	<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['posts_order'] = strip_tags( $new_instance['posts_order'] );
		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Recent Posts' , 'gimliii') , 'no_of_posts' => '5' , 'posts_order' => 'latest', 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'gimliii' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">
				<?php _e( 'Number of posts to show:', 'gimliii' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">
				<?php _e( 'Posts order:', 'gimliii' ); ?>
			</label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="latest" <?php if( $instance['posts_order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>>
					<?php _e( 'Most recent', 'gimliii' ); ?>
				</option>
				<option value="random" <?php if( $instance['posts_order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>
					<?php _e( 'Random', 'gimliii' ); ?>
				</option>
				<option value="popular" <?php if( $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>
					<?php _e( 'Popular', 'gimliii' ); ?>
				</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">
				<?php _e( 'Use Thumbnails:', 'gimliii' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
	<?php
	}
}
