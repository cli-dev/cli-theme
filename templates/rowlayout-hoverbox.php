<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$hover_effect = get_sub_field('hover_effect', $item_id);
$custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';

$background_color = (get_sub_field('background_color', $item_id)) ? ' background-color: ' . get_sub_field('background_color', $item_id) . '; ' : '';

$box_image = get_sub_field('box_image', $item_id);

$link_type = get_sub_field('link_type', $item_id);

$internal_link = get_permalink( get_sub_field('site_link', $item_id));
$external_link = get_sub_field('external_link', $item_id);

$link = ($link_type === 'Internal') ? $internal_link : $external_link;

$target = ($link_type === 'Internal') ? '_self' : '_blank';

$minimum_height = (get_sub_field('minimum_height', $item_id)) ? ' min-height: ' . get_sub_field('minimum_height', $item_id) . 'px; ' : '';

$box_open_tag = (get_sub_field('link_box', $item_id) == 1) ? '<a id="hvr-box-' . get_row_index() . '" href="' . $link . '" target="' . $target . '" class="hover-box effect-' . $hover_effect . '" style="' . $minimum_height . ' ' . $background_color . '">' : '<div id="hvr-box-' . get_row_index() . '" class="hover-box effect-' . $hover_effect . '" style="' . $minimum_height . ' ' . $background_color . '">';

$box_close_tag = (get_sub_field('link_box', $item_id) == 1) ? '</a>' : '</div>';

$box_title = get_sub_field('box_title', $item_id);
$box_content = get_sub_field('box_content', $item_id);


$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect . $custom_class; ?>"<?php echo $animation;?>>
  <?php echo $box_open_tag; ?>
    <?php if ($box_image) { echo '<div class="box-img" style="background: url(' . $box_image . ') center no-repeat; background-size: cover;"></div>';} ?>
    <div class="box-content">
      <div class="box-title"><?php echo $box_title; ?></div>
      <div class="box-txt"><?php echo $box_content; ?></div>
    </div>
  <?php echo $box_close_tag; ?>
</div>