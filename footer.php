<?php if(is_active_sidebar('spi-footer-one') || is_active_sidebar('spi-footer-two') || is_active_sidebar('spi-footer-three')){?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 md-margin-bottom-40">
		        	
				<?php dynamic_sidebar('spi-footer-one');?>				
			</div><!--/col-md-4-->	
			
			<div class="col-md-4 md-margin-bottom-40">
                <div class="posts">
                    <?php dynamic_sidebar('spi-footer-two');?>
                </div>
			</div><!--/col-md-4-->

			<div class="col-md-4">             
                <?php dynamic_sidebar('spi-footer-three');?>
			</div><!--/col-md-4-->
		</div><!--/row-->	
	</div><!--/container-->	
</div><!--/footer-->	
<?php }?>
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-6">						
	            <p class="copyright-space">
                <?php bloginfo('name');
                	  _e(' | All Rights Reserved.');
                ?>
                </p>
			</div>
		</div><!--/row-->
	</div><!--/container-->	
</div><!--/copyright-->	
<?php wp_footer(); ?>

</body>

</html>	