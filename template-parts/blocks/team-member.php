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
<div class="team-gallery sm-max-w">
  <h2 class='b-text has-text-align-center'>Our Team</h2>
  <div>
    <?php
    if ( have_rows('team_member_gallery') ) {
      while ( have_rows('team_member_gallery') ) : the_row();
      
        $name = get_sub_field('name') ?: 'Member Name';
        $job_title = get_sub_field('job_title') ?: 'Job Title';
        $image = get_sub_field('image') ?: 295;
        $bio = get_sub_field('bio') ?: 'write bio here';
      ?>
        <div id="<?php echo esc_attr($id); ?>" class="team-member">
          <div class="image">
            <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
          </div>
          <h3><?php echo $name; ?></h3>
          <h4><?php echo $job_title; ?></h4>
          <div class="hidden bio">
            <?php echo $bio; ?>
        </div>
      </div>
    <?php
      endwhile;
    }
    // Load values and assign defaults.
    ?>
  </div>
</div>