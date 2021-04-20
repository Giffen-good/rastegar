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
?>
<div id="<?php echo esc_attr($id); ?>" class=" standard-wrapper wp-block-cover image-bubble">
  <div class="image bg-img">
    <div class="opass white"></div>
    <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
  </div>
  <div class="text-box">
    <p><?php echo $small_text; ?></p>
    <h2><?php echo $title; ?></h2>
    <p></p>
    <p class="bod">1899 Mckinney is a planned high-rise development in the heart of the Victory Park neighborhood.</p>
  </div>
</div>