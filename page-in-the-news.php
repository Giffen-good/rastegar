
<?php
/* Template Name: Archive Page News  */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

    endwhile; // End of the loop.
    
    wp_reset_postdata(); 
		?>

<div class="news-feed wp-block-columns xs-max-w">
 <?php 
  $args = array(
    'post_type' => 'news',
    'posts_per_page' => 8
  );
  $news_query =  new WP_Query($args);
      while ($news_query->have_posts()) :
        if ($news_query->have_posts()) : $news_query->the_post();
          get_template_part( 'template-parts/content', 'news-item' );
          ?>
          


<?php
        endif;
      endwhile;
  
  
  ?>
</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();



// 
