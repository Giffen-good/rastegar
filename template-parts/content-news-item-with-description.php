<?php
/** @var array $args */

$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

?>
<a rel=”noopener noreferrer” href="<?php echo get_post_field('url'); ?>" class="fl-50" target="_blank" >
  <div class="news-item standard-wrapper ">
    <?php  if (get_post_field('date')) : ?><div ><h6 class="small-text"><?php echo get_post_field('date'); ?></h6></div><?php endif; ?>
    <h2><?php the_title(); ?></h2>
    <div class="grow"></div>
    <div class="bod"><?php the_content(); ?></div>
    <div class="wp-block-columns">
    <?php
    if ( $featured_img ) {
            echo '<img class="brand-logo" src="' . $featured_img[0] . '"  />';
    }
  ?>
      <aside class >
        <span><?php echo get_post_field('call_to_action_text'); ?></span>
        <img class="hit" src="<?php echo get_template_directory_uri() . '/assets/arrow.svg'; ?>" />
      </aside>
    </div>
  </div>
  </a>