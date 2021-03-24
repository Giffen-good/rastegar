<?php
/** @var array $args */

$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$url = get_field('url') ? get_field('url') : get_permalink();
  ?>
<a rel=”noopener noreferrer” href="<?php echo $url; ?>" class="fl-50" >
  <div class="news-item standard-wrapper blog-postcard">
  <?php
    if ( $featured_img ) {
            echo '<img class="featured-image" src="' . $featured_img[0] . '"  />';
    }
  ?>
    <?php  if (get_field('date')) : ?><div ><h6 class="small-text"><?php the_field('date'); ?></h6></div><?php endif; ?>
    <h2><?php the_title(); ?></h2>
    <?php if(has_excerpt()) {
      the_excerpt();
    }  ?>
    <div class="grow"></div>
    
    <aside class >
      <span><?php the_field('call_to_action_text'); ?></span>
      <img class="hit" src="<?php echo get_template_directory_uri() . '/assets/plus.svg'; ?>" />
    </aside>
  </div>


</a>