<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Rubik&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="site-topbar">
		<div class="site-topbar-inner">
		  <div class="site-topbar-inner-left"></div>
		  <div class="site-topbar-inner-right">
		    <div class="topbar-text">
			<a href="tel:+30 2310279517"><i class="fa fa-phone"></i>+30 2310279517</a>
			<a href="mailto:info@bestfor.com"><i class="fa fa-envelope"></i>info@bestfor.com</a>
			</div>
			<div class="header-social-icons">
			<a href="https://www.facebook.com/BestForGr/" class="social-icons-footer"><i class="fa fa-facebook-f"></i></a>	
			<a href="https://www.instagram.com/bestforgr/" class="social-icons-footer"><i class="fa fa-instagram"></i></a>	
			<a href="https://twitter.com/bestforcompany" class="social-icons-footer"><i class="fa fa-twitter"></i></a>	
			<a href="https://www.youtube.com/channel/UC2WgQ3PfRKVsx1fKP1LWxhQ" class="social-icons-footer"><i class="fa fa-youtube-play"></i></a>	
			<a href="https://gr.pinterest.com/bestforgr/" class="social-icons-footer"><i class="fa fa-pinterest-p"></i></a>	
			<a href="https://www.tiktok.com/@bestforgr?" class="social-icons-footer"><i class="fa fa-tumblr"></i></a>
			</div>
		  </div>
		</div>
	</div>
	<div id="wrapper-navbar">
	<div class="header-logo">
			 <a href="/"><img src="<?php echo get_template_directory_uri() . '/src/images/logo.png' ?>" alt=""></a>
		 </div>
		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>
		<b class="screen-overlay"></b>

<button data-trigger="#navbar_main" class="d-lg-none btn btn-warning" type="button">  <div class="hamburger-wrapper">
	<div class="hamburger1"></div>
	<div class="hamburger2"></div>
	<div class="hamburger3"></div>
</div> 
</button>

<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="offcanvas-header">  
    <button class="btn btn-danger btn-close float-right"> &times</button>
    
  </div>
		<nav id="main-nav" class=" navbar navbar-expand-lg bg-primary" aria-labelledby="main-nav-label">
         <div class="header-logo">
			 <a href="/"><img src="<?php echo get_template_directory_uri() . '/src/images/logo.png' ?>" alt=""></a>
		 </div>
		 <div class="header-search"><?php echo do_shortcode('[ivory-search id="192" title="Default Search Form"]'); ?></div>

		
	

				

				<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button> -->

				<!-- The WordPress Menu goes here -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
		
			
		

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
