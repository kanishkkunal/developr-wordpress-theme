<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Developr
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    
    <?php do_action( 'before' ); ?>
    <div id="topbar">
        <?php if (has_nav_menu('primary')): ?>
			<nav class="nav-container group" id="nav-topbar">                
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap"><?php wp_nav_menu(array('theme_location'=>'primary','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				
				<div>	
					<div class="toggle-search"><i class="fa fa-search"></i></div>
					<div class="search-expand">
						<div class="search-expand-inner">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div><!--/.container-->
				
			</nav><!--/#nav-topbar-->
		<?php endif; ?>
    </div>
	<header id="masthead" class="jumbotron site-header text-center" role="banner">
        <div class="container">
            <?php
			$header_image = ot_get_option('custom-image') ? ot_get_option('custom-image') : developr_admin_gravatar();
            $header_class = ot_get_option('clip-image') ? '' : 'img-circle' ;
			if ( ! empty( $header_image ) ) :
		    ?>
			    <a class="site-logo"  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				    <img src="<?php echo $header_image; ?>" alt="Gravatar" class="<?php echo $header_class; ?>" width="120" height="120" />
			    </a>
		    <?php endif; ?>
		    <div class="site-branding text-center">
                
                 <?php if( is_home() || is_front_page() ) : ?>
			        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php if ( !ot_get_option('site-description') ): ?><h2 class="site-description"><?php bloginfo( 'description' ); ?></h2><?php endif; ?>
                <?php endif; ?>
		    </div>
        </div>
        <div class="social-flare-container">
            <div class="social-flare">	
				<?php developr_social_links() ?>
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
