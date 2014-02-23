<?php get_header(); ?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left"><?php if(is_category()){ printf( __( 'Post under category : %s', 'spi' ), single_cat_title( '', false ) ); }elseif(is_tag()){ printf( __( 'Posts tagged in : %s', 'spi' ), single_tag_title( '', false ) ); } else{ echo 'Archives: ';}?></h1>
    </div>
</div>

<div class="container">		
	<div class="row blog-page">    
    	<div class="col-md-9 md-margin-bottom-40">
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
                        <li><i class="icon-calendar"></i> <?php spi_posted_on();?></li>
                        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                        <li><i class="icon-comments"></i> 
                        <?php comments_popup_link( __( 'Comment', 'spi' ), __( '1 comment', 'spi' ), __( '% Comments', 'spi' ) ); ?>
                    	</li><?php endif;?>
                    	<li><i class="icon-copy"></i> 
                    		<?php
			                 $catcountpost= sizeof(get_the_category());
			                   if( $catcountpost>15){
			                   		echo 'Posted in '. $catcountpost.' Categories';?>
			                   <?php }else{
			                   	the_category(',');
			                   }
							   ?>
                    	</li>
						<?php if(has_tag()){ ?><li><i class="icon-tags"></i> <?php the_tags();?></li><?php } ?>	
                    </ul>
                    <p><?php the_excerpt(); ?></p>
                    <p><a class="btn-u btn-u-small" href="<?php the_permalink(); ?>"><i class="icon-location-arrow"></i> Read More</a></p>
                </div>    
            </div>     

            <hr class="margin-bottom-40">
            	<?php endwhile;
				spi_paging_nav();
			endif;
		?>
        </div>
    	<?php get_sidebar('homeblog');?>
    </div><!--/row-->        
</div><!--/container-->		

<?php get_footer(); ?>