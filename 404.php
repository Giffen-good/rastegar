<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rastegar
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="page-header" style="margin: 0 auto;margin-top:65px;width:95%">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rastegar' ); ?></h1>
			</div><!-- .page-header -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
