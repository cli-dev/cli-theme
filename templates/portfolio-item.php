<?php
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
  $thumb_url = $thumb_url_array[0];

  $link = get_field('link');

?>

<a href="<?php echo $link; ?>" target="_blank" class="hover-box effect-lexi">  
  <div class="box-img" style="background: url(<?php echo $thumb_url; ?>) center no-repeat; background-size: cover;"></div>  
  <div class="box-content">
    <div class="box-title"><h3><?php the_title(); ?></h3></div>
    <div class="box-txt">Visit Site</div>
  </div>
</a>