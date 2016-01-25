<?php 
        
  //Vars
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  
  $width_in_percentage_or_pixels = get_sub_field('width_in_percentage_or_pixels', $item_id);
  $width_percentage = (get_sub_field('width_percentage', $item_id)) ? 'width: ' . get_sub_field('width_percentage', $item_id) . '%;' : '';
  $width_pixels = (get_sub_field('width_pixels', $item_id)) ? 'width: ' . get_sub_field('width_pixels', $item_id) . 'px;' : '';
  $height = (get_sub_field('height', $item_id)) ? ' height: ' . get_sub_field('height', $item_id) . 'px;' : '';
  $color = (get_sub_field('color', $item_id)) ? ' background-color: ' . get_sub_field('color', $item_id) . ';' : '';
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $center_divider = get_sub_field('center_divider', $item_id);
  $margin_top = (get_sub_field('margin_top', $item_id)) ? ' margin-top: ' . get_sub_field('margin_top', $item_id) . 'px;' : '';
  $margin_bottom = (get_sub_field('margin_bottom', $item_id)) ? ' margin-bottom: ' . get_sub_field('margin_bottom', $item_id) . 'px;' : '';
  $margin_left = (get_sub_field('margin_left', $item_id)) ? ' margin-left: ' . get_sub_field('margin_left', $item_id) . 'px;' : '';
  $margin_right = (get_sub_field('margin_right', $item_id)) ? ' margin-right: ' . get_sub_field('margin_right', $item_id) . 'px;' : '';

  $divider_styles = 'style="' . (($width_in_percentage_or_pixels == 'percentage') ? $width_percentage : $width_pixels) . $height . (($center_divider == 1) ? ' margin-left: auto; margin-right: auto; ' : $margin_left . $margin_right) . $margin_top . $margin_bottom . $color . '"' ;

$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $custom_class . $animation_class . $item_animation_effect; ?>"<?php echo $animation;?>>

  <div class="divider" <?php echo $divider_styles; ?>></div>
</div>