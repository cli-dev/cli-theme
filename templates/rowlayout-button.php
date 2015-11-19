<?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;

  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $text = (get_sub_field('text', $item_id)) ? get_sub_field('text', $item_id) : '';

$link_type = get_sub_field('link_type', $item_id);

$internal_link = get_permalink( get_sub_field('internal_link', $item_id));
$external_link = get_sub_field('external_link', $item_id);

$link = ($link_type === 'Internal') ? $internal_link : $external_link;

$target = ($link_type === 'Internal') ? '_self' : '_blank';

$solid_initial_state = get_sub_field_object('solid_initial_state', $item_id);
$solid_initial_state_value = get_sub_field('solid_initial_state', $item_id);  
$solid_initial_state_label = $solid_initial_state['choices'][intval($solid_initial_state_value)];

$solid_hover_state = get_sub_field_object('solid_hover_state', $item_id);
$solid_hover_state_value = get_sub_field('solid_hover_state', $item_id);  
$solid_hover_state_label = $solid_hover_state['choices'][intval($solid_hover_state_value)];

$outline_type = get_sub_field_object('outline_type', $item_id);
$outline_type_value = get_sub_field('outline_type', $item_id);  
$outline_type_label = $outline_type['choices'][intval($outline_type_value)];

$button_type = get_sub_field('button_type', $item_id);

$button = ($button_type === 'Solid') ? ' solid' : ' outline';

$solid_state = ($button_type === 'Solid') ? ' ' . $solid_initial_state_label : '';

$solid_hover = ($button_type === 'Solid') ? ' ' . $solid_hover_state_label . '-hover' : '';

$outline = ($button_type === 'Outline') ? ' ' . $outline_type_label : '';

$classes = 'btn' . $button . $solid_state . $solid_hover . $outline . $custom_class;

 
 ?>


<a class="<?php echo $classes; ?>" href="<?php echo $link; ?>" target="<?php echo $target; ?>"><span><?php echo $text; ?></span></a>