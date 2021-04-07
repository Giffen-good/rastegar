

<?php
/* Template Name: Archive Blog  */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

    endwhile; // End of the loop.
    
    wp_reset_postdata(); 


    echo get_tags();

		?>

<div>
  <?php wp_list_categories('current_category=1&hide_title_if_empty=0&title_li=<h2>Filter</h2>'); ?>
</div>
<div class="news-feed wp-block-columns xs-max-w">
 <?php 
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 8
  );
 $post_type = get_field('post_type');
  if ($post_type) {
    $args['post_type'] = $post_type;
  }
  $posts =  new WP_Query($args); 
      while ($posts->have_posts()) :
        if ($posts->have_posts()) : $posts->the_post();
         get_template_part( 'template-parts/content', 'blog-post' );
        endif;
      endwhile;
  
  
  ?>
</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();



// 
