<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
              
  $hover_panel_background_color = (get_sub_field('hover_panel_background_color', $item_id)) ? hex2rgb(get_sub_field('hover_panel_background_color', $item_id)) : '';
  $bg_color_opacity = (get_sub_field('bg_color_opacity', $item_id)) ? get_sub_field('bg_color_opacity', $item_id) : '';
  $hover_bg = ($hover_panel_background_color) ? ' style="background-color: rgba(' . $hover_panel_background_color . ',' . $bg_color_opacity . ');"' : '';
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $columns_on_desktop = get_sub_field('columns_on_desktop', $item_id);
  $column_spacing = intval(get_sub_field('column_spacing', $item_id));
  
  $gallery_negative_margin = ($column_spacing) ? ' style="margin: -' . ($column_spacing/2) . 'px"' : '';
  $gallery_spacing = ($column_spacing) ? ' style="padding: ' . ($column_spacing/2) . 'px"' : ''; 

  $team_info_in_hover_panel = get_sub_field('team_info_in_hover_panel', $item_id);

  $team_title_color = (get_sub_field('team_title_color', $item_id)) ? ' style="color:' . get_sub_field('team_title_color', $item_id) . ';"' : '';

  $position_title_color = (get_sub_field('position_title_color', $item_id)) ? ' style="color:' . get_sub_field('position_title_color', $item_id) . ';"' : '';

  $bio_button_classes = (get_sub_field('bio_button_classes', $item_id)) ? ' ' . get_sub_field('bio_button_classes', $item_id) : '';
  
  $item_add_animation = get_sub_field('add_item_animation', $item_id);
  $animation_class = ($item_add_animation == 1) ? ' wow' : '';
  $item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
  $item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
  $item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
  $item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

  $animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>

<?php 

$args1 = array (
  'post_type' => array( 'team_member' ),
  'posts_per_page' => '-1',
  'order' => 'ASC',
  'orderby' => 'menu_order',
);

$query1 = new WP_Query( $args1 );

?>

<?php if ( $query1->have_posts() ) : ?>

<div class="col-item<?php echo $animation_class . $item_animation_effect . $custom_class; ?>"<?php echo $animation;?>>

  <div class="team"<?php echo $gallery_negative_margin; ?>>

    <?php while ( $query1->have_posts() ) : $query1->the_post(); ?>

      <?php

      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'team-headshot', true);
      $thumb_url = $thumb_url_array[0];
      $position = get_field('position');
      $bio = get_field('bio');

      $team_open_tag = ($bio) ? '<a class="team-member fancybox" style="background: url(' . $thumb_url . ') center top no-repeat; background-size: cover;" href="#' . the_slug() . '">' : '<div class="team-member" style="background: url(' . $thumb_url . ') center top no-repeat; background-size: cover;">';

      $team_close_tag = ($bio) ? '</a>' : '</div>';

      ?>

      <div class="team-member-wrapper"<?php echo $gallery_spacing; ?>>
        <div class="team-wrapper-inner">
        <?php echo $team_open_tag; ?>
          <?php if ($team_info_in_hover_panel == 1) { ?>
            <div class="team-hover-panel"<?php echo $hover_bg; ?>>
              <div class="hover-panel-inner">
                <h3 class="team-title"<?php echo $team_title_color; ?>><?php the_title(); ?></h3>
                <?php if($position){ ?>
                  <div class="team-position"<?php echo $position_title_color; ?>><?php echo $position; ?></div>
                <?php } ?>
                <?php if($bio){ ?>
                  <div class="bio-btn<?php echo $bio_button_classes; ?>">View Bio</div>
                <?php } ?>
              </div>
            </div>
          <?php } elseif ($team_info_in_hover_panel !== 1 && $bio !== ''){ ?>
            <div class="team-hover-panel"<?php echo $hover_bg; ?>>
              <div class="hover-panel-inner">
                <div class="btn bio-btn<?php echo $bio_button_classes; ?>">View Bio</div>
              </div>
            </div>
          <?php } ?> 
        <?php echo $team_close_tag; ?>
        <?php if ($team_info_in_hover_panel != 1) { ?>
          <div class="team-info">
            <h3 class="team-title"<?php echo $team_title_color; ?>><?php the_title(); ?></h3>
            <?php if($position){ ?>
              <div class="team-position"<?php echo $position_title_color; ?>><?php echo $position; ?></div>
            <?php } ?>
          </div>
        <?php } ?> 
        </div>
      </div>

    <?php endwhile; ?>

  </div>
</div>

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".team-member.fancybox").fancybox({
        maxWidth: 700,
        margin: [50, 40, 20, 40]
      });
      var columns = <?php echo $columns_on_desktop; ?>;
      var maxWidth = 1/columns * 100;

      if($(window).width() >= 1000){
        $('.team-member-wrapper').css('width', maxWidth + '%');
      }

      $(window).resize(function(event) {
        if($(window).width() >= 1000){
          $('.team-member-wrapper').css('width', maxWidth + '%');
        } else if($(window).width() >= 600){
          $('.team-member-wrapper').css('width','33.333%');
        }
        else{
          $('.team-member-wrapper').css('width',  '50%');
        }
      });
    });
  </script>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php 

$args2 = array (
  'post_type' => array( 'team_member' ),
  'posts_per_page' => '-1',
  'order' => 'ASC',
  'orderby' => 'title',
);

$query2 = new WP_Query( $args2 );

?>

<?php if ( $query2->have_posts() ) : ?>

  <div class="team-bios">

    <?php while ( $query2->have_posts() ) : $query2->the_post(); ?>

      <?php
        $bio = get_field('bio');
        $position = get_field('position');
      ?>

      <?php if($bio){?>

        <div id="<?php echo the_slug(); ?>" class="team-bio">
          <h3 class="team-title"><?php the_title(); ?></h3>
          <div class="team-position"><?php echo $position; ?></div>
          <div class="bio"><?php echo $bio; ?></div>
        </div>
      <?php } ?> 

    <?php endwhile; ?>

  </div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>