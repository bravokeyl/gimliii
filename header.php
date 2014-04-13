<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">       
    <?php wp_head(); ?>
</head>	
<body <?php body_class(); ?>>
<div class="header">
    <div class="container">
        <div class="col-md-12">
            <?php if ( display_header_text() ) :?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2 class="site-title"><?php bloginfo('name') ;?></h2></a>
            <h4><?php bloginfo('description'); ?></h4>

            <?php endif;
            if(get_header_image()): ?>
            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" class="custom-header-image" />
        <?php endif;?>
        </div>
    </div>
    <?php if(has_nav_menu('primary')) : ?>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only"><?php _e('Toggle navigation','gimliii');?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">

                </a>
            </div>
            <div id="navigation" class="collapse navbar-collapse navbar-responsive-collapse">
               <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false, 
                        'menu_class'     => 'nav navbar-nav menu'
               ));?>              
            </div><!-- /navbar-collapse -->
        </div>    
    </div>  
    <?php endif; ?>  
</div><!--/header-->
   
