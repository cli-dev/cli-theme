<header class="page-header wow fadeIn" data-wow-delay="0.5s" <?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  $careers_page = get_id_by_slug( 'careers' );
  
  if(is_blog()){
    
    $item_id = $page_for_posts;
  }
  else if( is_singular( 'position' ) ){
    
    $item_id = $careers_page;

  }else{
    
    $item_id = $postid;

  } 

  $header_type = get_field('header_type', $item_id);

  $header_item_direction = get_field('header_item_direction', $item_id);
  $header_item_distribution = get_field('header_item_distribution', $item_id);
  $header_item_alignment = get_field('header_item_alignment', $item_id);
  $add_background_video = get_field('add_background_video', $item_id);
  $video_mp4 = get_field('video_mp4', $item_id);
  $video_ogg = get_field('video_ogg', $item_id);
  $video_webm = get_field('video_webm ', $item_id);
  $video_placeholder_image = get_field('video_placeholder_image', $item_id);
  $background_image = get_field('background_image', $item_id);
  $slider_shortcode = get_field('slider_shortcode', $item_id);

  if($header_type === 'Background Image'){echo 'style="background: url(' . $background_image . ') center no-repeat; background-size: cover;"';}
  
  $detect = new Mobile_Detect;
?>>
  <?php if($header_type === 'Slider'){ echo do_shortcode($slider_shortcode); } else {
    if(!$detect->isMobile() && $header_type === 'Background Video') { ?>
      <div class="header-bg-video bg-video">
        <video autoplay loop poster="<?php echo $video_placeholder_image; ?>" class="bgvid">
          <source src="<?php echo $video_webm; ?>" type="video/webm">
          <source src="<?php echo $video_mp4; ?>" type="video/mp4">
          <source src="<?php echo $video_ogg; ?>" type="video/ogv">
        </video>
        <div class="bg-video-overlay"></div>
      </div>
    <?php } else if($detect->isMobile() && $header_type === 'Background Video'){?>
      <div class="header-bg-video bg-video" style="background: url('<?php echo $video_placeholder_image; ?>') center no-repeat; background-size: cover;">
        <div class="bg-video-overlay"></div>
      </div>
    <?php } ?>
    <div class="page-header-inner in-grid flex-row<?php if($header_item_direction){ echo ' flex-direction-' . $header_item_direction;} ?><?php if($header_item_distribution){ echo ' flex-position-' . $header_item_distribution;} ?><?php if($header_item_alignment){ echo ' flex-align-' . $header_item_alignment;} ?>">
      <?php if( have_rows('header_content', $item_id) ): while ( have_rows('header_content', $item_id) ) : the_row(); ?>
         
        <div class="header-block">   
          <?php if( get_row_layout() == 'header_text' ) { $text_color = get_sub_field('text_color', $item_id)?>
            <span<?php if($text_color) { echo ' style="color:' . $text_color . ';"';} ?>><?php the_sub_field('header_text', $item_id); ?></span>
          <?php } ?>
          
          <?php if( get_row_layout() == 'image' ) { $image = get_sub_field('header_image', $item_id);?>
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-image" />
          <?php } ?>
        
        </div>
      
     <?php endwhile; endif; ?>  
    </div>
  <?php } ?>
</header>