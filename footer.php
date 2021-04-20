<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rastegar
 */

?>

<?php 	$menu = wp_get_nav_menu_object('footer');
			$address = get_field('address', $menu);
			$phone_number = get_field('phone_number', $menu);
			?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri() . '/assets/logo-landscape-dark.png'; ?>" /></a></div>
			<div class="top-menus">
				<div>
					<h6 class="underline">Headquarters</h6>
					
					<span><?php echo $address; ?></span></div>
				<div>
					<h6 class="underline">Phone Number</h6>
					<span><?php echo $phone_number; ?></span>
				</div>
				<div>
					<h6 class="underline">Socials</h6>

					<div class="social-media-container">
							<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social-media',
							)
						);
						?>
					</div>
				</div>
				<div>
					<h6 class="underline">Sitemap</h6>

					<div class="main-menu-container">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
							)
						);
						?>

					</div>
				</div>
			</div>
		</div><!-- .site-info -->
		<div class="bottom-section small-text ">	
			<div class="footer-menu"><?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
				)
			);
			?>
			</div>
			<div class="all-rights-reserved">
				<span>Copyright (C) <?php echo date("Y"); ?> Rastegar Property Company, LLC. All rights reserved.</span>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
