    
<div class="news-feed-widget wp-block-columns">
    <div>
 <?php 
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 8,
    'post_type' => 'news'
  );
  $posts =  new WP_Query($args);
      while ($posts->have_posts()) :
        if ($posts->have_posts()) : $posts->the_post();
         get_template_part( 'template-parts/content', 'news-item-with-description' );
        endif;
      endwhile;
  
  
  ?>
  </div>
</div>