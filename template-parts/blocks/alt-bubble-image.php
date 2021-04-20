<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'product-card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Load values and assign defaults.
$title = get_field('heading') ?: 'Your Title here...';
$small_text = get_field('small_text') ?: 'Content';
$image = get_field('image') ?: 295;
$heading_first =  get_field_object('first_text_element')['value'];
?>
<div id="<?php echo esc_attr($id); ?>" class=" standard-wrapper wp-block-cover image-bubble alt">
  <div class="opass white"></div>
  <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
  <div class="text-box">
    <?php if ($heading_first == null || $heading_first !== 'subtext') {
      ?>
      <p><?php echo $small_text; ?></p>
      <h2><?php echo $title; ?></h2><?php
    } else {
      ?>
      <h2><?php echo $title; ?></h2>
      <p><?php echo $small_text; ?></p>
      <?php
      }
    ?>
  </div>
</div>