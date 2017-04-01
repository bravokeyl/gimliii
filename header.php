<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header">
  <div class="container header-title hidden-xs">
      <div class="header-inner">
          <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <div class="site-logo">
              <?php the_custom_logo(); ?>
            </div>
          <?php endif;?>
          <?php if ( display_header_text() ) :?>
            <a href="<?php echo esc_url( home_url() ); ?>" rel="home">
              <?php if( is_front_page() ){ ?>
                <h1 class="site-title"><?php bloginfo( 'name' ) ;?></h1>
              <?php } else { ?>
                <h2 class="site-title"><?php bloginfo( 'name' ) ;?></h2>
              <?php } ?>
            </a>
            <h4><?php bloginfo( 'description' ); ?></h4>
          <?php endif;
          if(get_header_image()): ?>
          <div class="custom-header">
            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" class="custom-header-image" />
          </div>
      <?php endif;?>
      </div>
  </div>
  <?php if( has_nav_menu( 'primary' ) ) : ?>
  <div class="navbar navbar-default" role="navigation">
      <div class="container">
          <div class="navbar-header visible-xs">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                  <span class="sr-only"><?php _e( 'Toggle navigation', 'gimliii' );?></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
                <?php if ( has_custom_logo() ) :  ?>
                  <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                    <div class="site-logo mobile-site-logo">
                      <?php the_custom_logo(); ?>
                    </div>
                  <?php endif;?>
                <?php else: ?>
                  <?php if( is_front_page() ){ ?>
                    <h1 class="site-title mobile-site-title"><?php bloginfo( 'name' ) ;?></h1>
                  <?php } else { ?>
                    <h2 class="site-title mobile-site-title"><?php bloginfo( 'name' ) ;?></h2>
                  <?php } ?>
                <?php endif; ?>
              </a>
          </div>
          <div id="navigation" class="collapse navbar-collapse navbar-responsive-collapse">
             <?php
               wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'container'      => false,
                  'menu_class'     => 'nav navbar-nav menu'
               ));
             ?>
          </div><!-- /navbar-collapse -->
      </div>
  </div>
  <?php endif; ?>
</header><!--/header-->
