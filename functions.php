<?php
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

function gimliii_setup() {

	load_theme_textdomain( 'gimliii', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	// Thumbnail sizes
		add_image_size( 'thumb-small', 60, 60, true );
		add_image_size( 'thumb-medium', 336, 212, true );
   // Add theme support for Custom Header
	$gimliii_header_args = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 1175,
			'height'                 => 400,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => '333',
			'header-text'            => true,
			'uploads'                => true,

	);
	add_theme_support( 'custom-header', $gimliii_header_args );

	add_theme_support( "custom-background");
	
	add_editor_style();

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gimliii' )
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form'
	) );

}

add_action( 'after_setup_theme', 'gimliii_setup' );
get_template_part('inc/widgets');
//require_once(get_template_directory() .'/admin/theme-settings.php');

/* Widgetize Theme */
function gimliii_widgets_init() {

		register_sidebar(array(
		'name' => ' Right Sidebar',
		'id' => 'gimliii-right-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="lb lb-md"><h2>',
		'after_title' => '</h2></div>',
	));

	register_sidebar(array(
		'name' => 'Footer One',
		'id' => 'gimliii-footer-one',
		'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<div class="lb"><h2>',
		'after_title' => '</h2></div>',
	));

	register_sidebar(array(
		'name' => 'Footer Two',
		'id' => 'gimliii-footer-two',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="lb"><h2>',
		'after_title' => '</h2></div>',
	));

	register_sidebar(array(
		'name' => 'Footer Three',
		'id' => 'gimliii-footer-three',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="lb"><h2>',
		'after_title' => '</h2></div>',
	));

}
add_action( 'widgets_init', 'gimliii_widgets_init' );

function gimliii_filter_wp_title( $title, $separator ) { 
	if ( is_feed() )
		return $title;
	global $paged, $page;

	if ( is_search() ) {

		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( 'Page %s', $paged );
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'gimliii_filter_wp_title', 10, 2 );

if(!is_admin()){

function gimliii_styles(){

	wp_enqueue_style( 'bootcss', get_template_directory_uri().'/js/bootstrap/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'gimliii-style', get_stylesheet_uri(), array( 'bootcss' ) );	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/vendor/font-awesome/css/font-awesome.css', array() );  

}
add_action( 'wp_enqueue_scripts', 'gimliii_styles' );

function gimliii_scripts(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jm', get_template_directory_uri() . '/vendor/jquery-migrate.js', array('jquery'), '110', true );
	wp_enqueue_script( 'bootjs', get_template_directory_uri() . '/js/bootstrap/js/bootstrap.min.js', array('jquery'), '110', true );
	wp_enqueue_script( 'cu', get_template_directory_uri() . '/vendor/superfish.js', array('jquery'), '110', true );
	wp_enqueue_script( 'gimlijs', get_template_directory_uri() . '/js/gimli.js', array('jquery'), '110', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gimliii_scripts' );

}

if ( ! function_exists( 'gimliii_posted_on' ) ) :

function gimliii_posted_on() {
if(!is_single()){
	printf( '<a href="%1$s" rel="bookmark"><time datetime="%2$s">%3$s</time></a>', 
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
else {
	printf( '<time datetime="%2$s">%3$s</time>', 
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

}
endif;


if ( ! function_exists( 'gimliii_paging_nav' ) ) :
function gimliii_paging_nav() {

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Prev', 'gimliii' ),
		'next_text' => __( 'Next &rarr;', 'gimliii' ),
	) );

	if ( $links ) :

	?> 
	 <!--Pagination-->
    <div class="text-center">
        <ul class="postpagenum">
         <?php echo $links; ?>
        </ul>                                                            
    </div>
            <!--End Pagination-->           
	<?php
	endif;
}
endif;
if ( ! function_exists( 'gimliii_post_nav' ) ) :
function gimliii_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="post-navigation" role="navigation">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span>Published In</span>%title', 'gimliii' ) );
			else :
				previous_post_link( '%link', __( '<span class="pull-left post-nav-link"><i class="icon-arrow-left"></i>&nbsp;&nbsp;Prev Post</span>', 'gimliii' ) );
				next_post_link( '%link', __( '<span class="pull-right post-nav-link">Next Post&nbsp;&nbsp;<i class="icon-arrow-right"></i></span>', 'gimliii' ) );
			endif;
			?>
	</nav><!-- .post-navigation -->
	<?php
}
endif;


// How comments are displayed
function gimliii_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<?php $add_below = ''; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	
		<div class="the-comment">
			<div class="avatar">
				<?php echo get_avatar($comment, 54); ?>
			</div>
			
			<div class="comment-box">
			
				<div class="comment-author meta">
					<strong><?php echo get_comment_author_link() ?></strong>
					<div class="gimliii-date-reply"><?php printf(__('%1$s %2$s', 'gimliii'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__(' , Edit ', 'gimliii'),'  ','') ?><?php comment_reply_link(array_merge( $args, array('reply_text' => __('/ Reply', 'gimliii'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
				</div>
			
				<div class="comment-text">
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php echo __('Your comment is awaiting moderation.', 'gimliii') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div>
			
			</div>
			
		</div>

<?php }
function gimliii_last_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;
	
	$lastPosts = get_posts('numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li>
	<dl class="dl-horizontal">
	<dt>	
	<?php if (has_post_thumbnail() && $thumb ) : ?>				
		<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php the_post_thumbnail('thumb-small'); ?></a>	    
	<?php else: ?>
	<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	<?php if($thumb){
	echo '<img class="img-responsive" src="'.get_template_directory_uri().'/img/default-thumb-small.png">';}endif; ?>
	</dt>
	<dd>
	<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
	</dd>
    </dl>
</li>
<?php endforeach; 
	$post = $orig_post;
}

function gimliii_popular_posts($pop_posts = 5 , $thumb = true){
	global $wpdb , $post;
	$orig_post = $post;
	
	$popularposts = "SELECT ID,post_title,post_date,post_author,post_content,post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$pop_posts;
	$posts = $wpdb->get_results($popularposts);
	if($posts){
		global $post;
		foreach($posts as $post){
		setup_postdata($post);?>
			<li>
			<dl class="dl-horizontal">
	        <dt>
			<?php if (has_post_thumbnail() && $thumb ) : ?>			
					<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_post_thumbnail('thumb-small'); ?></a>
			<?php else: ?>
			<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php if($thumb){
			echo '<img class="img-responsive" src="'.get_template_directory_uri().'/img/default-thumb-small.png">';}endif; ?>
			</dt>
	        <dd>
				<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
			</dd>
    		</dl>
			</li>
	<?php 
		}
	}
	$post = $orig_post;
}

function gimliii_random_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;

	$lastPosts = get_posts('orderby=rand&numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li>
<dl class="dl-horizontal">
	<dt>	
	<?php if (has_post_thumbnail() && $thumb ) : ?>			
			<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_post_thumbnail('thumb-small'); ?></a>
	<?php else: ?>
	<a href="<?php echo the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'gimliii' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	<?php 
	if($thumb){
	echo '<img class="img-responsive" src="'.get_template_directory_uri().'/img/default-thumb-small.png">';}endif; ?>
	</dt>
    <dd>
	<a href="<?php echo the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
	</dd>
	</dl>
</li>
<?php endforeach;
	$post = $orig_post;
}?>