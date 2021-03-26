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
$title = get_field('title') ?: 'Your Title here...';
$subtext = get_field('subtext') ?: 'Content';
$video = get_field('embed') ?: 'https://www.youtube.com/embed/1PooSJl9Vdk';
$button_text = get_field('button_text') ?: 295;
$url = get_field('url') ?: 295;
$self_hosted_video = get_field('self_hosted_video');
$cover_image = get_field('cover_image');

if ($self_hosted_video) {

  $video = '
    <video autoplay muted loop>
      <source src="' . $self_hosted_video['url'] .'"
              type="video/webm">

      <source src="' . $self_hosted_video['url'] . '"
              type="video/mp4">
            Sorry, your browser doesn\'t support embedded videos.
    </video>
';
} else if ( $video ) {
  // Add autoplay functionality to the video code
  if ( preg_match('/src="(.+?)"/', $video, $matches) ) {
    // Video source URL
    $src = $matches[1];
    
    // Add option to hide controls, enable HD, and do autoplay -- depending on provider
    $params = array(
      'controls'    => 0,
      'hd'        => 1,
      'autoplay' => 1
    );
    
    $new_src = add_query_arg($params, $src);
    
    $video = str_replace($src, $new_src, $video);
    
    // add extra attributes to iframe html
    $attributes = 'frameborder="0"';
    
    $video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
  }
}
?>
<div class="largest-hero-section">
    <div class="wp-block-cover__inner-container">
      <h2><?php echo $title; ?></h2>
      <p><?php echo $subtext; ?></p>
      <div class="wp-block-button">
        <a class="wp-block-button__link" href="<?php echo $url; ?>"><?php echo $button_text; ?></a>
      </div>
    </div>
  <div class="hero-vid-wrapper">
    <section id="<?php echo esc_attr($id); ?>" class="hero-banner vid">
      <?php echo $video; ?>  
    </section>
    <div class="opass"></div>
  </div>
</div>
