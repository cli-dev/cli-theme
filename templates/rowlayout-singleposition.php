<?php 
        
//Vars
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$positionID = get_sub_field('position', $item_id);
$block_background_color = (get_sub_field('block_background_color', $item_id)) ? 'background-color: ' . get_sub_field('block_background_color', $item_id) . '; ' : '';
$block_text_color = (get_sub_field('block_text_color', $item_id)) ?  'color: ' . get_sub_field('block_text_color', $item_id) . '; ' : '';
$extra_class = (get_sub_field('extra_class', $item_id)) ? get_sub_field('extra_class', $item_id) : '';
$description = get_field('description', $positionID);

$block_styles = ($block_background_color || $block_text_color) ? 'style="' . $block_background_color . $block_text_color . '"' : '';

$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect; ?>"<?php echo $animation;?>>

<a href="<?php echo get_permalink($positionID); ?>" class="position-block">
  <div class="position-block-inner <?php echo $extra_class; ?>" <?php echo $block_styles; ?>>
    <h3><?php echo get_the_title($positionID); ?></h3>
    <div class="job-description">
      <?php echo $description; ?>
    </div>
  </div>
</a>

</div>