<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rastegar
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rastegar' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class='dark-mode' src="<?php echo get_template_directory_uri() . '/assets/logo-dark.png'; ?>" />
				<img class='white-mode' src="<?php echo get_template_directory_uri() . '/assets/logo-white.png'; ?>" />

			</a>
			
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$rastegar_description = get_bloginfo( 'description', 'display' );
			if ( $rastegar_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $rastegar_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
		
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
			<div class="wp-block-button contact-button"><a target="_blank" class="wp-block-button__link" href="https://connect.rastegarproperty.com/rastegarproperty-contact-us">Contact</a></div>
			<button class="menu-toggle" aria-controls="primary-menu" id="nav-icon3" aria-expanded="false">  
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</button>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
