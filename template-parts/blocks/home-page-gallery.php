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
<section class="sixty-forty-gallery"  id="<?php echo esc_attr($id); ?>"> 
  <?php
if ( have_rows('two-column-gallery') ) {
  while ( have_rows('two-column-gallery') ) : the_row();
  
    $heading = get_sub_field('heading') ?: 'heading';
    $image = get_sub_field('image') ?: 295;
    $description = get_sub_field('description') ?: 'write description here';
  ?>
    <div  class="column">
      <div class="image">
        <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
      </div>
      <div class="v-align-cen">
        <div class="wp-block-group text-box">
          <h2><?php echo $heading; ?></h2>
            <?php echo $description; ?>
        </div>
      </div>
</div>
<?php
  endwhile;
}
// Load values and assign defaults.
?>
</section>