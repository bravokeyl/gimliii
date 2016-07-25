<?php get_header();?>

<div class="container  margin-top-20">		
	<div class="row blog-page blog-item">
    	<div class="col-md-9 md-margin-bottom-60">
             <?php
             $gimliii_post_class=" blog margin-bottom-40 ";
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>        
            <div id="post-<?php the_ID(); ?>" <?php post_class($gimliii_post_class); ?>>
                <h2><?php the_title();?></h2>
                <div class="blog-post-tags">
                    <ul class="list-unstyled list-inline blog-info">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php gimliii_posted_on();?></li>
                        <li><i class="fa fa-pencil" aria-hidden="true"></i> <?php the_author(); ?></li>
                        <li><i class="fa fa-comments" aria-hidden="true"></i>
                        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                        <?php comments_popup_link( __( 'Comment', 'gimliii' ), __( '1 comment', 'gimliii' ), __( '% Comments', 'gimliii' ) ); ?>
                    	<?php endif;?>
                    	<?php if(!comments_open()){ echo "Comments off";} ?>
                    	</li>
	                    <li><i class="fa fa-tags" aria-hidden="true"></i>
	                    	<?php
			                 $catcountpost= sizeof(get_the_category());
			                   if( $catcountpost>15){
			                   		echo 'Posted in '. $catcountpost.' Categories';  
			                   }else{
			                   	the_category(',');
			                   }
							   ?>
						</li>
						<?php if(has_tag()){ ?><li><i class="fa fa-tags" aria-hidden="true"></i><?php the_tags();?></li><?php } ?>  
					</ul>                                             
                </div>
                <div class="blog-img">

                	<?php if ( has_post_thumbnail() && ! post_password_required() ){
								the_post_thumbnail('full');
					}?> 
                </div>
                <div class="blog-body">
                	<?php the_content(); ?>
                	<p><?php wp_link_pages( array( 'before' => __( 'Pages:', 'gimliii' ), 'after' => '') ); ?></p>
                </div>
             </div>       

			<hr>
			<?php gimliii_post_nav();endwhile; endif;?>
             <?php
			    // If comments are open or we have at least one comment, load up the comment template.
			    if ( comments_open() || get_comments_number() ) {
			      comments_template();
			    }?>
            <hr>
        </div>
        <?php get_sidebar();?>
    </div>        
</div>		

<?php get_footer();?>