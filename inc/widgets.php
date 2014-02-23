<?php
add_action( 'widgets_init', 'spi_posts_list_widget' );
function spi_posts_list_widget() {
	register_widget( 'spi_posts_list' );
}
class spi_posts_list extends WP_Widget {

	function spi_posts_list() {
		$widget_ops = array( 'classname' => 'posts-list'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-list-widget' );
		$this->WP_Widget( 'posts-list-widget','Spi Posts list', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_posts = $instance['no_of_posts'];
		$posts_order = $instance['posts_order'];
		$thumb = $instance['thumb'];

		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
				<ul class="spi-post-list">
					<?php
					if( $posts_order == 'popular' )
						spi_popular_posts($no_of_posts , $thumb);
						
					elseif( $posts_order == 'random' )
						spi_random_posts($no_of_posts , $thumb);
						
					else
						spi_last_posts($no_of_posts , $thumb)?>	
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
		$defaults = array( 'title' =>__('Recent Posts' , 'spi') , 'no_of_posts' => '5' , 'posts_order' => 'latest', 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">Number of posts to show: </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">Posts order : </label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="latest" <?php if( $instance['posts_order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>>Most recent</option>
				<option value="random" <?php if( $instance['posts_order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
				<option value="popular" <?php if( $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Use Thumbinals : </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>

<?php
add_action( 'widgets_init', 'spi_search_widget' );
function spi_search_widget() {
	register_widget( 'spi_search' );
}
class spi_search extends WP_Widget {
	function spi_search() {
		$widget_ops = array( 'classname' => 'search'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		$this->WP_Widget( 'search-widget',' Spi Search', $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) { ?>
	<div class="lb lb-md"><h2><?php _e('Search','spi');?></h2></div> 
	<div class="input-group margin-bottom-40">
		<form method="get" id="searchform" action="<?php echo home_url() ; ?>/">
			<input type="text" id="s" name="s" class="form-control" placeholder="Search"  />
		</form>
	</div><!-- .search-widget /-->		
<?php
	}
}
?>


