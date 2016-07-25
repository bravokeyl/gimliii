<?php get_header(); ?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
	   <h3> <?php	
		if ( have_posts() ) :
			printf( __( 'Search Results for: %s', 'gimliii' ), '<span>' . get_search_query() . '</span>' ); ?>
			<?php else : ?>
			<?php _e( 'Nothing Found', 'gimliii' ); ?>
			<?php endif; ?>	
        </h3>
    </div>
</div>

<div class="container">		
	<div class="row blog-page">    
        <!-- Left Sidebar -->
    	<div class="col-md-9 md-margin-bottom-40">
            <!--Blog Post-->
	
			 <?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
            <div class="row blog blog-medium margin-bottom-40">
                <div class="col-md-5">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ){
                                the_post_thumbnail('thumb-medium');
                    }else{
                        ?>
 <img src="<?php echo get_template_directory_uri(); ?>/img/default-thumb.jpg" alt="<?php the_title(); ?>" class="img-responsive"/>
                        <?php
                    }?>

                </div>    
                <div class="col-md-7">
                    <h2><?php the_title(); ?></h2>
                    <ul class="list-unstyled list-inline blog-info">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php gimliii_posted_on();?></li>
                        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                        <li><i class="fa fa-comments" aria-hidden="true"></i> 
                        <?php comments_popup_link( __( 'Comment', 'gimliii' ), __( '1 comment', 'gimliii' ), __( '% Comments', 'gimliii' ) ); ?>
                    	</li><?php endif;?>
                    	<li><i class="fa fa-copy" aria-hidden="true"></i> 
                    		<?php
			                 $catcountpost= sizeof(get_the_category());
			                   if( $catcountpost>15){
			                   		echo 'Posted in '. $catcountpost.' Categories';?>
			                   <?php }else{
			                   	the_category(',');
			                   }
							   ?>
                    	</li>
						<?php if(has_tag()){ ?><li><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags();?></li><?php } ?>	
                    </ul>
                    <p><?php the_excerpt(); ?></p>
                    <p><a class="btn-u btn-u-small" href="<?php the_permalink(); ?>"><i class="fa fa-location-arrow" aria-hidden="true"></i><?php _e("Read More","gimliii");?></a></p>
                </div>    
            </div>
            <!--End Blog Post-->        

            <hr class="margin-bottom-40">
            	<?php endwhile;
				gimliii_paging_nav();
				else:?>
					<div class="alert alert-danger fade in"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gimliii' ); ?></div>
			<?php endif;
		?>
        </div>
        <!-- End Left Sidebar -->

        <!-- Right Sidebar -->
    	<?php get_sidebar();?>
        <!-- End Right Sidebar -->
    </div><!--/row-->        
</div>

<?php get_footer(); ?>
