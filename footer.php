<?php
if( is_active_sidebar('gimliii-footer-one') || is_active_sidebar('gimliii-footer-two') || is_active_sidebar('gimliii-footer-three') ){ ?>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 md-margin-bottom-40">
					<?php dynamic_sidebar('gimliii-footer-one');?>
				</div><!--/col-md-4-->
				<div class="col-md-4 md-margin-bottom-40">
	                <div class="posts">
	                    <?php dynamic_sidebar('gimliii-footer-two');?>
	                </div>
				</div><!--/col-md-4-->
				<div class="col-md-4">
	                <?php dynamic_sidebar('gimliii-footer-three');?>
				</div><!--/col-md-4-->
			</div><!--/row-->
		</div><!--/container-->
	</div><!--/footer-->
<?php }?>
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
        <p class="copyright-space credit">
          <?php
						printf( '<a class="site-link" href="%s" rel="home">%s</a>', esc_url( home_url() ), get_bloginfo( 'name' ) );
        	  _e( ' | All Rights Reserved.', 'gimliii' );
          ?>
        </p>
			</div>
			<div class="col-md-6 text-right credit-alt">
				<a href="<?php echo esc_url( __( 'https://mu-bit.com/', 'gimliii' ) ); ?>"
					title="<?php echo esc_attr(__( 'With love by Mu Bit', 'gimliii' ));?>">&#10084;
				</a>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/copyright-->
<?php wp_footer(); ?>
</body>
</html>
