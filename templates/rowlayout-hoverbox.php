<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$hover_effect = get_sub_field('hover_effect', $item_id);

$background_color = (get_sub_field('background_color', $item_id)) ? ' background-color: ' . get_sub_field('background_color', $item_id) . '; ' : '';

$box_image = get_sub_field('box_image', $item_id);

$link_type = get_sub_field('link_type', $item_id);

$internal_link = get_permalink( get_sub_field('site_link', $item_id));
$external_link = get_sub_field('external_link', $item_id);

$link = ($link_type === 'Internal') ? $internal_link : $external_link;

$target = ($link_type === 'Internal') ? '_self' : '_blank';

$minimum_height = (get_sub_field('minimum_height', $item_id)) ? ' min-height: ' . get_sub_field('minimum_height', $item_id) . 'px; ' : '';

$box_open_tag = (get_sub_field('link_box', $item_id) == 1) ? '<a href="' . $link . '" target="' . $target . '" class="hover-box effect-' . $hover_effect . '" style="' . $minimum_height . ' ' . $background_color . '">' : '<div class="hover-box effect-' . $hover_effect . '" style="' . $minimum_height . ' ' . $background_color . '">';

$box_close_tag = (get_sub_field('link_box', $item_id) == 1) ? '</a>' : '</div>';

$box_title = get_sub_field('box_title', $item_id);
$box_content = get_sub_field('box_content', $item_id);


?>

<?php echo $box_open_tag; ?>
  <?php if ($box_image) { echo '<div class="box-img" style="background: url(' . $box_image . ') center no-repeat; background-size: cover;"></div>';} ?>
  <div class="box-content">
    <div class="box-title"><?php echo $box_title; ?></div>
    <div class="box-txt"><?php echo $box_content; ?></div>
  </div>
<?php echo $box_close_tag; ?>

