<?php
/** @var array $args */


?>
<a rel=”noopener noreferrer” href="<?php the_field('url'); ?>" >
  <div class="news-item standard-wrapper product-card ">
  <?php
    if ( get_field('image') ) {
            echo '<img  src="' . get_field('image')['url'] . '"  />';
    }
  ?>
    <h2><?php the_field('title'); ?></h2>
    <p><?php the_field('body'); ?></h2>
    <div class="grow"></div>
    <div class="wp-block-columns">
 
      <aside class >
        <span><?php the_field('call_to_action_text'); ?></span>
        <img src="<?php echo get_template_directory_uri() . '/assets/plus.svg'; ?>" />
      </aside>
    </div>
  </div>
</a>