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
    <div id="topbar" data-spy="affix" data-offset-top="280" class="affix-top">
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
				    <img src="<?php echo $header_image; ?>" alt="Gravatar" class="img-circle" width="120" height="120" />
			    </a>
		    <?php endif; ?>
		    <div class="site-branding text-center">
                
                 <?php if( is_home() ) : ?>
			        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
               
			        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                <?php endif; ?>
		    </div>
        </div>
        <div class="social-flare-container">
            <div class="social-flare">	
				<a rel="nofollow" class="social-links" title="Twitter" href="https://twitter.com/SuperDevRes42" target="_blank"><i class="fa fa-twitter"></i></a>
                <a rel="nofollow" class="social-links" title="Facebook" href="https://www.facebook.com/superdevresources" target="_blank"><i class="fa fa-facebook"></i></a>
                <a rel="publisher" class="social-links" title="Google Plus" href="https://www.google.com/+Superdevresources42" target="_blank"><i class="fa fa-google-plus"></i></a>
                <a rel="nofollow" class="social-links" title="RSS Feed" href="http://feeds.feedburner.com/SuperDevResources" target="_blank"><i class="fa fa-rss"></i></a>
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
