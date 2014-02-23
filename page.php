<?php get_header();?>
<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
  <div class="row">
     <?php the_post_thumbnail();?>  
  </div>

 <?php }?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left"><?php the_title();?></h1>
    </div>
</div>
<div class="container">		
	<div class="row blog-page blog-item">
    	<div class="col-md-9 md-margin-bottom-60">
             <?php
			if ( have_posts() ) : the_post(); ?>        
            <div class="blog margin-bottom-40"> 
                <div class="blog-body">
                <?php the_content(); ?>
                <p><?php wp_link_pages( array( 'before' => __( 'Pages:', 'spi' ), 'after' => '') ); ?></p>
               </div>
                 </div>       
			<?php endif;?>
             <!-- Recent Comments -->
             <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                  comments_template();
                }?>
            <!-- End Recent Comments -->
        </div>

        <!-- Right Sidebar -->
        <?php get_sidebar();?>
        <!-- End Right Sidebar -->
    </div><!--/row-->        
</div><!--/container-->		
<!--=== End Content Part ===-->

<?php get_footer();?>