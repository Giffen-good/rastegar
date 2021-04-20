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
<div class="team-gallery">
  <h2 class='b-text has-text-align-center'>Our Executive Team</h2>
  <div class="member-card">
    <?php
    if ( have_rows('team_member_gallery') ) {
      while ( have_rows('team_member_gallery') ) : the_row();
      
        $name = get_sub_field('name') ?: 'Member Name';
        $job_title = get_sub_field('job_title') ?: 'Job Title';
        $image = get_sub_field('image') ?: 295;
        $bio = get_sub_field('bio') ?: 'write bio here';
        $cta = get_sub_field('cta');
      ?>
        <div id="<?php echo esc_attr($id); ?>" class="team-member">
          <div class="image">
            <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
          </div>
          <h3><?php echo $name; ?></h3>
          <h4><?php echo $job_title; ?></h4>
          <div class="bio hidden"><?php echo $bio; ?></div>
          <?php if ($cta) {
?>
            <a class="cta-btn hidden" src="<?php echo $cta ?>"></a>
<?php
          } ?>
      </div>
    <?php
      endwhile;
    }
    // Load values and assign defaults.
    ?>
  </div>
  <div class="modal hidden">
    <div class="inner">
    <div class="bg"></div> 

      <img class="modal-close" src="<?php echo get_template_directory_uri() . '/assets/close.svg'; ?>"/> 
      <div class="flex">
        <div class="image">
          <img class="modal-image" />
        </div>
        <hgroup>
          <h3 class="modal-name"></h3>
          <h4 class="modal-job-title"></h4>
        </hgroup>
      </div>
      <div>
        <div class="modal-bio"></div>
      </div>
    </div>
  </div>
  <div class="modal hidden modal-wrap"></div>

</div>