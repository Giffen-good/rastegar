<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rastegar
 */


$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="wp-block-group hero-banner">
		<div class="wp-block-group__inner-container">
			<div class="wp-block-cover has-background-dim-30 has-background-dim">	
				<img loading="lazy" width="1440" height="566" class="wp-block-cover__image-background wp-image-162" alt=""
					src="<?php echo $featured_img[0]; ?>">
					<div class="wp-block-cover__inner-container">
						<div class="wp-block-group"><div class="wp-block-group__inner-container">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="entry-content post-page">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rastegar' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rastegar' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php rastegar_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
