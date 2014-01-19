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
    <div>
        <nav class="navbar navbar-default" role="navigation">
            <ul id="color-bars" class="group">
			    <li id="color-1"></li>
			    <li id="color-2"></li>
			    <li id="color-3"></li>
			    <li id="color-4"></li>
			    <li id="color-5"></li>
			    <li id="color-6"></li>
		    </ul>

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <?php
                    wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 7,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
            </div>
        </nav><!-- #site-navigation -->
    </div>
	<header id="masthead" class="jumbotron site-header text-center" role="banner">
        <div class="container">
            <?php
			$header_image = '';
            // Get default from Discussion Settings.
	        $default = get_option( 'avatar_default', 'mystery' ); // Mystery man default
	        if ( 'mystery' == $default )
		        $default = 'mm';
	        elseif ( 'gravatar_default' == $default )
		        $default = '';

	        $protocol = ( is_ssl() ) ? 'https://secure.' : 'http://';
	        $url = sprintf( '%1$sgravatar.com/avatar/%2$s/', $protocol, md5( get_option( 'admin_email' ) ) );
	        $url = add_query_arg( array(
		        's' => 120,
		        'd' => urlencode( $default ),
	        ), $url );

	        $header_image = esc_url_raw( $url );
			if ( ! empty( $header_image ) ) :
		    ?>
			    <a class="site-logo"  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				    <img src="<?php echo $header_image; ?>" alt="Gravatar" class="header-image" />
			    </a>
		    <?php endif; ?>
		    <div class="site-branding text-center">
                
                 <?php if( is_home() ) : ?>
			        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
               
			        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                <?php endif; ?>
		    </div>
            <div class="btn-group">	
					<a rel="nofollow" class="btn btn-lg social-links" title="Twitter" href="https://twitter.com/SuperDevRes42" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a rel="nofollow" class="btn btn-lg social-links" title="Facebook" href="https://www.facebook.com/superdevresources" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a rel="publisher" class="btn btn-lg social-links" title="Google Plus" href="https://www.google.com/+Superdevresources42" target="_blank"><i class="fa fa-google-plus"></i></a>
                    <a rel="nofollow" class="btn btn-lg social-links" title="RSS Feed" href="http://feeds.feedburner.com/SuperDevResources" target="_blank"><i class="fa fa-rss"></i></a>				
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
