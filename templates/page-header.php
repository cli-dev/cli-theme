<?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  if(is_blog()){
    
    $item_id = $page_for_posts;
  }
  else{
    
    $item_id = $postid;

  } 

  $header_type = get_field('header_type', $item_id);

  $header_item_direction = get_field('header_item_direction', $item_id);
  $header_item_horizontal_distribution = (get_field('header_item_horizontal_distribution', $item_id)) ? ' flex-position-' . get_field('header_item_horizontal_distribution', $item_id) : '';
  $header_item_horizontal_alignment = (get_field('header_item_horizontal_alignment', $item_id)) ? ' flex-align-' . get_field('header_item_horizontal_alignment', $item_id) : '';
  $header_item_vertical_distribution = (get_field('header_item_vertical_distribution', $item_id)) ? ' flex-position-' . get_field('header_item_vertical_distribution', $item_id) : '';
  $header_item_vertical_alignment = (get_field('header_item_vertical_alignment', $item_id)) ? ' flex-align-' . get_field('header_item_vertical_alignment', $item_id) : '';

  if($header_item_direction === 'row'){
    $col_position = $header_item_horizontal_distribution;
    $col_alignment = $header_item_horizontal_alignment;
    $row_direction = ' flex-direction-row';
  }
  else{
    $col_position = $header_item_vertical_distribution;
    $col_alignment = $header_item_vertical_alignment;
    $row_direction = ' flex-direction-column';
  }
  
  $header_items = $row_direction . $col_position . $col_alignment;


  $add_background_video = get_field('add_background_video', $item_id);
  $video_mp4 = get_field('video_mp4', $item_id);
  $video_ogg = get_field('video_ogg', $item_id);
  $video_webm = get_field('video_webm ', $item_id);
  $video_placeholder_image = get_field('video_placeholder_image', $item_id);
  $background_image = get_field('background_image', $item_id);
  $slider_shortcode = get_field('slider_shortcode', $item_id);
  $header_color = get_field('header_color', $item_id);

  $background_image_color_overlay = get_field('background_image_color_overlay', $item_id);
  $background_image_color_overlay_opacity = get_field('background_image_color_overlay_opacity', $item_id);
  $header_rgb = hex2rgb($background_image_color_overlay);

  $add_animation = get_field('add_animation', $item_id);
  $animation_class = ($add_animation == 1) ? ' wow' : '';
  $animation_effect = (get_field('animation_effect', $item_id)) ? ' ' . get_field('animation_effect', $item_id)  : '';
  $animation_duration = (get_field('animation_duration')) ? ' data-wow-duration="' . get_field('animation_duration', $item_id) . 's"'  : '';
  $animation_delay = (get_field('animation_delay', $item_id)) ? ' data-wow-delay="' . get_field('animation_delay', $item_id) . 's"'  : '';
  $animation = ($add_animation == 1) ? $animation_duration . $animation_delay : '';
  $bg_img = ' background: url(' . $background_image . ') center no-repeat; background-size: cover;';
  $overlay = ($background_image_color_overlay) ? ' box-shadow: inset 0 0 0 1000px rgba(' . $header_rgb . ', ' . $background_image_color_overlay_opacity . ');"' : '';
  
  $detect = new Mobile_Detect;

  $myoptions = get_option( 'themesettings_');

  $site_header_type = $myoptions['header_type'];

  if ($site_header_type === 'Top Menu') { $top_header_type = $myoptions['top_header_position']; }

  $pageHeaderWrapperStyles = '';
  $pageHeaderStyles = '';

  if($top_header_type === 'header-overlap' && $header_type === 'bg-img') {
    $pageHeaderWrapperStyles = ' style="' . $bg_img . $overlay . '"'; 
  }
  elseif ($top_header_type === 'header-overlap' && $header_type === 'color') {
    $pageHeaderWrapperStyles = ' style="background-color: ' . $header_color . '"'; 
  } else {
    $pageHeaderWrapperStyles = '';
  }
  
  if( $top_header_type === 'header-no-overlap' && $header_type === 'bg-img') {
    $pageHeaderStyles = ' style="' . $bg_img . $overlay . '"'; 
  } 
  elseif ($top_header_type === 'header-no-overlap' && $header_type === 'color') {
    $pageHeaderStyles = ' style="background-color: ' . $header_color . '"'; 
  } 
  else{
    $pageHeaderStyles = '';
  }
?>
<header class="page-header<?php echo ' ' . $header_type . $animation_class . $animation_effect; ?>"<?php echo ' ' . $pageHeaderWrapperStyles;?><?php echo $animation;?>>
  <?php if($header_type === 'slider'){ echo do_shortcode($slider_shortcode); } else {
    if(!$detect->isMobile() && $header_type === 'bg-vid') { ?>
      <div class="header-bg-video bg-video">
        <video autoplay loop poster="<?php echo $video_placeholder_image; ?>" class="bgvid">
          <source src="<?php echo $video_webm; ?>" type="video/webm">
          <source src="<?php echo $video_mp4; ?>" type="video/mp4">
          <source src="<?php echo $video_ogg; ?>" type="video/ogv">
        </video>
        <div class="bg-video-overlay"></div>
      </div>
    <?php } else if($detect->isMobile() && $header_type === 'bg-vid'){?>
      <div class="header-bg-video bg-video" style="background: url('<?php echo $video_placeholder_image; ?>') center no-repeat; background-size: cover;">
        <div class="bg-video-overlay"></div>
      </div>
    <?php } ?>
    <div class="page-header-inner-wrapper"<?php echo ' ' . $pageHeaderStyles;?>>
      <div class="page-header-inner in-grid flex-row <?php echo $header_items ?>">
      <?php if( have_rows('header_content', $item_id) ): while ( have_rows('header_content', $item_id) ) : the_row(); ?>
          <?php if( get_row_layout() == 'header_text' ) {?>
            <?php $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : ''; ?>  
            <div class="header-block<?php echo $custom_class; ?>"> 
              <?php the_sub_field('header_text', $item_id); ?>
            </div>
          <?php } ?>
          
          <?php if( get_row_layout() == 'image' ) { $image = get_sub_field('header_image', $item_id);?>
            <?php $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : ''; ?>  
            <div class="header-block<?php echo $custom_class; ?>"> 
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-image" />
            </div>
          <?php } ?>
     <?php endwhile; endif; ?>  
    </div>
    </div>
    
  <?php } ?>
</header>