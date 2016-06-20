<?php 

$myoptions = get_option( 'themesettings_');
$logo_position = $myoptions['logo_position'];
$site_header_type = $myoptions['header_type'];
$top_header_type = '';
if ($site_header_type === 'Top Menu') { $top_header_type = $myoptions['top_header_position']; }
$center_logo_menu_type = '';
if($logo_position === 'center'){$center_logo_menu_type = $myoptions['center_logo_menu_type'];}

$overlapping_header = '';

if($top_header_type === "header-overlap") {
  $overlapping_header = ' overlapping-header';
}

$detect = new Mobile_Detect;

$page_for_posts = get_option( 'page_for_posts' );
$placeholder_img = get_field('background_image', $page_for_posts);

$headerStyles = '';

if($detect->isMobile() && has_post_thumbnail()) {
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
  $thumb_url = $thumb_url_array[0];
  $headerStyles = 'style="background: url(' . $thumb_url . ') center no-repeat; background-size: cover;"';
}
elseif($detect->isMobile() && !has_post_thumbnail()){
  $headerStyles = 'style="background: url(' . $placeholder_img . ') center no-repeat; background-size: cover;"';
} 
elseif(!$detect->isMobile() && has_post_thumbnail()){
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
  $thumb_url = $thumb_url_array[0];
  $headerStyles = 'style="background-image: url(' . $thumb_url . '); background-position: 50% 70%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;"';
}
else{
  $headerStyles = 'style="background-image: url(' . $placeholder_img . '); background-position: 50% 70%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;"';
}

?>

<header class="post-image-window post-header<?php echo $overlapping_header; ?>" style=" background-image: url(<?php if ( has_post_thumbnail() ) { echo $thumb_url; } else { echo $placeholder_img; }  ?>); background-position: 50% 70%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;"><?php 
  $title = get_the_title();
  $attr = array('class' => "post-img-inner", 'alt' => $title,);
  the_post_thumbnail( 'thumbnail', $attr );
  ?></header>