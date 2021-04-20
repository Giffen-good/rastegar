

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

    function pagination_bar( $custom_query ) {

      $total_pages = $custom_query->max_num_pages;
      $big = 999999999; // need an unlikely integer
  
      if ($total_pages > 1){
          $current_page = max(1, get_query_var('paged'));
  
          echo paginate_links(array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => $current_page,
              'total' => $total_pages,
              'type' => 'list',
              'prev_next' => false
          ));
      }
    }
    function post_type_tags( $post_type = '' ) {
      global $wpdb;
  
      if ( empty( $post_type ) ) {
          $post_type = get_post_type();
      }
  
      return $wpdb->get_results( $wpdb->prepare( "
          SELECT COUNT( DISTINCT tr.object_id ) 
              AS count, tt.taxonomy, tt.description, tt.term_taxonomy_id, t.name, t.slug, t.term_id 
          FROM {$wpdb->posts} p 
          INNER JOIN {$wpdb->term_relationships} tr 
              ON p.ID=tr.object_id 
          INNER JOIN {$wpdb->term_taxonomy} tt 
              ON tt.term_taxonomy_id=tr.term_taxonomy_id 
          INNER JOIN {$wpdb->terms} t 
              ON t.term_id=tt.term_taxonomy_id 
          WHERE p.post_type=%s 
              AND tt.taxonomy='post_tag' 
          GROUP BY tt.term_taxonomy_id 
          ORDER BY count DESC
      ", $post_type ) );
    }
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 8,
      'paged' => $paged
    );
  $include_tag_filter = get_field('add_filter_by_tag_sub_nav');
   $post_type = get_field('post_type');
    if ($post_type) {
      $args['post_type'] = $post_type;
    }
    $tag_id = null;
    if (isset($_GET['tag_id'])) {
      $tag_id = $_GET['tag_id'];
      $args['tag_id'] = $tag_id;
    }
   $posts =  new WP_Query($args); 

    $archive_tags = post_type_tags( $post_type );
    global $wp;
    if ($include_tag_filter) {
      ?><div class="xs-max-w mb1 filters">
      <h5>Filter by Topic:</h5>
      <div class="filter-topics">
      <?php
      foreach( $archive_tags as $tag ) {
        $class = ($tag_id == $tag->term_id ) ? 'current-class' : '';
          echo '<div><a href="' . add_query_arg( array('tag_id' => $tag->term_id ), $wp->request ). '" class="wp-block-button__link mr0-5 ' . $class . '">' . esc_html( $tag->name ) . '</a></div>';
      }
      ?>
      </div>  
    </div>
      <?php
    }
   
    if ($posts->have_posts()) :
      ?>
      <div class="news-feed wp-block-columns xs-max-w">
<?php
        while ($posts->have_posts()) : $posts->the_post();
          get_template_part( 'template-parts/content', 'blog-post' );

        endwhile;
    ?></div>
    <div id="pagination-container" class="pagination-container xs-max-w">
      <?php pagination_bar( $posts ); ?>
      <script>
        (function() {
          document.addEventListener('DOMContentLoaded', function() {
            var c = document.getElementById('pagination-container').querySelector('.current');
            if (c) c.closest('li').classList.add('current-page');
          })
        })();
      </script>
      </div>
<?php  endif; ?>

  
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();



// 
