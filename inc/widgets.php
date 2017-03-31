<?php
require get_parent_theme_file_path( '/inc/class-gimliii-posts-list.php' );
require get_parent_theme_file_path( '/inc/class-gimliii-search.php' );

add_action( 'widgets_init', 'gimliii_posts_list_widget' );
function gimliii_posts_list_widget() {
	register_widget( 'Gimliii_Posts_List' );
}

add_action( 'widgets_init', 'gimliii_search_widget' );
function gimliii_search_widget() {
	register_widget( 'Gimliii_Search' );
}
