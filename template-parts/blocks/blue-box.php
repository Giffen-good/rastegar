<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'standard-wrapper' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Your Title here...';
$body = get_field('body') ?: 'Content';
$image = get_field('image') ?: 295;
?>
<article id="<?php echo esc_attr($id); ?>">
  <div class="image">
    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
  </div>
  <h2><?php echo $title; ?></h2>
  <p><?php echo $body; ?></p>
  <span>Read More <span class="plus-icon"></span></span>
</article>