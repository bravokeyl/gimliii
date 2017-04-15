<?php
	get_header();
?>
<div class="breadcrumbs margin-bottom-40">
	<div class="container">
		<h1 class="pull-left">
			<?php
				if ( is_category() ) {
					printf( __( 'Posts under category : %s', 'gimliii' ), single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
					printf( __( 'Posts tagged in : %s', 'gimliii' ), single_tag_title( '', false ) );
				} else {
					esc_html_e( 'Archives: ', 'gimliii' );
				}
			?>
		</h1>
	</div>
</div>

<div class="container">
	<div class="row blog-page">
			<div class="col-md-9 md-margin-bottom-40">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
						<div class="row blog blog-medium margin-bottom-40">
								<div class="col-md-5">
  								<?php
                    if ( has_post_thumbnail() && ! post_password_required() ) {
                      the_post_thumbnail( 'gimliii-thumb-medium' );
                    } else { ?>
  										<img src="<?php echo get_theme_file_uri( 'img/default-thumb.jpg' ); ?>" alt="<?php the_title(); ?>" class="img-responsive" />
  								<?php } ?>
								</div>
								<div class="col-md-7">
                  <h2><?php the_title(); ?></h2>
									<ul class="list-unstyled list-inline blog-info">
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php gimliii_posted_on();?></li>
										<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				            <li><i class="fa fa-comments" aria-hidden="true"></i>
			              <?php comments_popup_link( __( 'Comment', 'gimliii' ), __( '1 comment', 'gimliii' ), __( '% Comments', 'gimliii' ) ); ?>
										</li>
                    <?php endif;?>
										<li><i class="fa fa-copy" aria-hidden="true"></i>
										<?php
                      $catcountpost = count( get_the_category() );
                      if ( 15 < $catcountpost ) {
                      	printf( '%1s %2s %3s', __( 'Posted in', 'gimliii' ), $catcountpost, __( 'Categories', 'gimliii' ) );
                      } else {
                      	the_category( ',' );
                      }
										?>
										</li>
										<?php if( has_tag() ) { ?>
                      <li><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags();?></li>
                    <?php } ?>
									</ul>
									<p><?php the_excerpt(); ?></p>
									<p>
										<a class="btn-u btn-u-medium" href="<?php the_permalink(); ?>">
											<i class="fa fa-eye" aria-hidden="true"></i>
											<span class="read-more-text"><?php esc_html_e( 'Read More', 'gimliii' );?></span>
										</a>
									</p>
								</div>
						</div>
						<hr class="margin-bottom-40">
			 <?php endwhile;
       gimliii_paging_nav();
			endif;
		?>
		  </div>
			<?php get_sidebar( 'homeblog' ); ?>
		</div><!--/row-->
</div><!--/container-->

<?php get_footer(); ?>
