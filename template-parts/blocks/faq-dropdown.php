<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'team-member-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
?> 
<div class="faq">
  <h2 class='b-text has-text-align-center'><?php echo get_field('category'); ?></h2>
  <div class="inner standard-wrapper">
    <?php
    if ( have_rows('faq') ) {
      while ( have_rows('faq') ) : the_row();
      
        $title = get_sub_field('title') ?: 'enter-dropdown-title-here';
        $description = get_sub_field('description');
      ?>
      <div id="<?php echo esc_attr($id); ?>" class="faq-entry">
        <div class="head-wrapper">
          <div class="heading flex">
            <h3 class="b-text"><?php echo $title; ?></h3>
            <span class='icon'>
              <img class="plus" src="<?php echo get_template_directory_uri() . '/assets/plus.svg'; ?>" />
            </span>
          </div>
        </div>
        <div class="hidden dropdown"><?php echo $description; ?></div>
      </div>
    <?php
      endwhile;
    }
    // Load values and assign defaults.
    ?>
  </div>
</div>