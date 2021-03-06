<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rastegar
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$splash_color = get_field('splash_video_background_color');
			$splash = get_field('splash_page_video');
			$splash_mobile = get_field('splash_page_video_mobile');
			if (   $splash ||  $splash_mobile ) {
				if ( $splash && $splash_mobile ) {
					echo "<div id='splash-video' class='hidden hero-banner vid' small-src='". $splash_mobile ."' src='" . $splash . "'><div style='background-color:" . $splash_color . "'></div></div>";
				} else if ( $splash_mobile ) {
					echo "<div id='splash-video' class='hidden hero-banner vid' src='" . $splash_mobile . "'><div style='background-color:" . $splash_color . "'></div></div>";
				} else {
					echo "<div id='splash-video' class='hidden hero-banner vid' src='" . $splash . "'><div style='background-color:" . $splash_color . "'></div></div>";
				}
			}
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	<div id="apng-array" data-src=""></div>
	</main><!-- #main -->
<?php

get_sidebar();
get_footer();
