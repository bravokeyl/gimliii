<?php get_header(); ?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left"><?php _e('Home','gimliii');?></h1>
    </div>
</div>
<div class="container">		
	<div class="row blog-page margin-bottom-20">    
    	<div class="col-md-9 md-margin-bottom-40">
            <?php
            $gimliii_post_class_home = " row blog blog-medium margin-bottom-40 ";
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class($gimliii_post_class_home); ?> >
                <div class="col-md-5">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ){ ?>
                    <a href="<?php the_permalink(); ?>"> 
                            <?php   the_post_thumbnail('thumb-medium');
                            echo "</a>";
                    }else{
                        ?>
                    
 <img src="<?php echo get_template_directory_uri(); ?>/img/default-thumb.jpg" alt="<?php the_title(); ?>" class="img-responsive"/>
                        <?php
                    }?>

                </div>    
                <div class="col-md-7">
                  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"> <?php the_title(); ?></a></h2>
                    <ul class="list-unstyled list-inline blog-info">
                        <li><i class="icon-calendar"></i> <?php gimliii_posted_on();?></li>
                        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                        <li><i class="icon-comments"></i> 
                        <?php comments_popup_link( __( 'Comment', 'gimliii' ), __( '1 comment', 'gimliii' ), __( '% Comments', 'gimliii' ) ); ?>
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
                    <p><a class="btn-u btn-u-small" href="<?php the_permalink(); ?>"><i class=" icon-eye-open"></i><?php _e('Read More','gimliii');?></a></p>
                </div>    
            </div>
            <!--End Blog Post-->        

            <hr class="margin-bottom-40">
            	<?php endwhile;
				gimliii_paging_nav();
			endif;
		?>
        </div>
    	<?php get_sidebar();?>
    </div><!--/row-->        
</div><!--/container-->		

<?php get_footer(); ?>