<?php
/*
 * Template Name: Left Sidebar
 * Description: Sidebar to the left side
 */
get_header();?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left"><?php the_title();?></h1>
    </div>
</div>
<div class="container">		
	<div class="row blog-page blog-item">

        <!-- Left Sidebar -->
        <div class="col-md-3 magazine-page">
		    <div class="posts margin-bottom-40">
		        <?php dynamic_sidebar( 'gimliii-left-sidebar' ); ?>
		    </div>
		</div>
        <!-- End Left Sidebar -->
    	<div class="col-md-9 md-margin-bottom-60">
             <?php
			if ( have_posts() ) : the_post(); ?>        
            <div class="blog margin-bottom-40"> 
            	<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
				     <?php the_post_thumbnail();?>  
				<?php }?>
                <div class="blog-body">
                <?php the_content(); ?>
                <p><?php wp_link_pages( array( 'before' => __( 'Pages:', 'gimliii' ), 'after' => '') ); ?></p>
               </div>
                 </div>       
			<?php endif;?>
             <?php
                if ( comments_open() || get_comments_number() ) {
                  comments_template();
                }?>
        </div>

    </div><!--/row-->        
</div><!--/container-->

<?php get_footer();?>