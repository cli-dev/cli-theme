<?php

$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
	}
}
header("Content-type: text/css; charset=utf-8"); 
if( function_exists('get_field') ) :

$content_background_color = get_field('content_background_color', 'option');
$main_font_color = get_field('main_font_color', 'option');
$text_highlight_color = get_field('text_highlight_color', 'option');
$header_color = get_field('header_color', 'option');
$header_background_opacity = get_field('header_background_opacity', 'option');
$desktop_header_height = get_field('desktop_header_height', 'option');
$mobile_header_height = get_field('mobile_header_height', 'options');
$header_bg_rgb = hex2rgb($header_color);
$menu_link_color = get_field('menu_link_color', 'option');
$menu_line_height = get_field('menu_line_height', 'option');
$mobile_menu_item_divider_color = get_field('mobile_menu_item_divider_color', 'option');
$menu_icon_top_bar_background_color = get_field('menu_icon_top_bar_background_color', 'option');
$menu_icon_middle_bar_background_color = get_field('menu_icon_middle_bar_background_color', 'option');
$menu_icon_bottom_bar_background_color = get_field('menu_icon_bottom_bar_background_color', 'option');
$menu_icon_text_color_color = get_field('menu_icon_text_color_color', 'option');
$menu_font_size = get_field('menu_font_size', 'option');
$menu_background_color = get_field('menu_background_color', 'option'); 

$menu_font_family = get_field_object('menu_font_family', 'option'); 
$menu_font_family_value = get_field('menu_font_family', 'option');
$menu_font_family_label = $menu_font_family['choices'][ $menu_font_family_value ];

$menu_link_active_color = get_field('menu_link_active_color', 'option');

$default_font_family = get_field_object('default_font_family', 'option'); 
$default_font_family_value = get_field('default_font_family', 'option');
$default_font_family_label = $default_font_family['choices'][ $default_font_family_value ];

$headings_font_family = get_field_object('headings_font_family', 'option'); 
$headings_font_family_value = get_field('headings_font_family', 'option');
$headings_font_family_label = $headings_font_family['choices'][ $headings_font_family_value ];
$headings_font_color = get_field('headings_font_color', 'option');
$headings_text_transform = get_field('headings_text_transform', 'option');
$headings_line_height = get_field('headings_line_height', 'option');
$headings_font_weight = get_field('headings_font_weight', 'option');

$paragraph_font_family = get_field_object('paragraph_font_family', 'option'); 
$paragraph_font_family_value = get_field('paragraph_font_family', 'option');
$paragraph_font_family_label = $paragraph_font_family['choices'][ $paragraph_font_family_value ];
$paragraph_font_color = get_field('paragraph_font_color', 'option');
$paragraph_text_transform = get_field('paragraph_text_transform', 'option');
$paragraph_line_height = get_field('paragraph_line_height', 'option');
$paragraph_font_weight = get_field('paragraph_font_weight', 'option');

$link_text_color = get_field('link_text_color', 'option');
$link_text_hover_color = get_field('link_text_hover_color', 'option');

$footer_top_background_color = get_field('footer_top_background_color', 'option');
$footer_top_text_color = get_field('footer_top_text_color', 'option');
$footer_top_link_color = get_field('footer_top_link_color', 'option');
$footer_top_link_hover_color = get_field('footer_top_link_hover_color', 'option');
$footer_bottom_background_color = get_field('footer_bottom_background_color', 'option');
$footer_bottom_text_color = get_field('footer_bottom_text_color', 'option');
$footer_bottom_link_color = get_field('footer_bottom_link_color', 'option');
$footer_bottom_link_hover_color = get_field('footer_bottom_link_hover_color', 'option');

$pagination_item_background_color = get_field('pagination_item_background_color', 'option');
$pagination_item_text_color = get_field('pagination_item_text_color', 'option');
$pagination_current_background_color = get_field('pagination_current_background_color', 'option');
$pagination_current_text_color = get_field('pagination_current_text_color', 'option');

$global_css = get_field('global_css', 'option');
$tablet_portrait_css = get_field('tablet_portrait_css', 'option');
$tablet_landscape_css = get_field('tablet_landscape_css', 'option');
$desktop_css = get_field('desktop_css', 'option');

$scroll_button_width = get_field('scroll_button_width', 'option');
$scroll_button_border_width = get_field('scroll_button_border_width', 'option');
$scroll_button_icon_font_size = get_field('scroll_button_icon_font_size', 'option');
$scroll_button_bottom = get_field('scroll_button_bottom', 'option');
$scroll_button_right = get_field('scroll_button_right', 'option');
$scroll_button_border_color = get_field('scroll_button_border_color', 'option');
$scroll_button_background_color = get_field('scroll_button_background_color', 'option');
$scroll_button_icon_color = get_field('scroll_button_icon_color', 'option');
$scroll_button_hover_border_color = get_field('scroll_button_hover_border_color', 'option');
$scroll_button_hover_background_color = get_field('scroll_button_hover_background_color', 'option');
$scroll_button_hover_icon_color = get_field('scroll_button_hover_icon_color', 'option');

$sadie_effect_gradient_top_color = get_field('sadie_effect_gradient_top_color', 'option');
$sadie_effect_gradient_top_color_opacity = get_field('sadie_effect_gradient_top_color_opacity', 'option');
$sadie_effect_gradient_top = 'rgba(' . hex2rgb($sadie_effect_gradient_top_color) . ', ' . $sadie_effect_gradient_top_color_opacity . ')';
$sadie_effect_gradient_bottom_color = get_field('sadie_effect_gradient_bottom_color', 'option');
$sadie_effect_gradient_bottom_color_opacity = get_field('sadie_effect_gradient_bottom_color_opacity', 'option');
$sadie_effect_gradient_bottom = 'rgba(' . hex2rgb($sadie_effect_gradient_bottom_color) . ', ' . $sadie_effect_gradient_bottom_color_opacity . ')';

?>

<?php if ($text_highlight_color) : ?>

::-moz-selection { background: <?php echo $text_highlight_color; ?>; color: #FFF; }
::selection { background: <?php echo $text_highlight_color; ?>; color: #FFF;}

<?php endif; ?>

<?php if($content_background_color) { echo '#wrapper{background-color: ' . $content_background_color . ';} '; }?>

<?php if($main_font_color) { echo 'body{color: ' . $main_font_color . ';} '; }?>

<?php if($link_text_color) { echo 'a{color: ' . $link_text_color . ';} '; }?>

<?php if($link_text_hover_color) { echo 'a:hover{color: ' . $link_text_hover_color . ';} '; }?>

<?php if($header_color) { echo '#header, .menu-mobile-container{background-color: ' . $header_color . ';} '; }?>

<?php if($mobile_header_height) { echo '.header-inner > nav{ height: ' . $mobile_header_height . 'px;} .page-header, .post-image-window{ padding-top:' . $mobile_header_height . 'px;} '; }?>

@media screen and (min-width: 1000px){
  <?php if($header_color) { echo '.menu-container{ background-color: transparent; } #header { background-color: rgba(' . $header_bg_rgb . ', ' . $header_background_opacity . ');} .sub-menu { background-color: rgba(' . $header_bg_rgb . ', ' . $header_background_opacity . ');} '; }?>
  <?php if($desktop_header_height) { echo '.header-inner > nav{ height: ' . $desktop_header_height . 'px;} .page-header, .post-image-window{ padding-top:' . $desktop_header_height . 'px;} .menu-container .sub-menu-icon{ line-height: ' . $desktop_header_height . 'px;}'; }?>
}

.menu-mobile-container .menu a,
.menu-container .menu a{
  <?php if ($menu_link_color) { echo 'color: ' . $menu_link_color . '; '; }?>
  <?php if ($menu_font_family) { echo 'font-family: "' . $menu_font_family_value  . '"; '; }?>
}

.sub-menu-icon{
  <?php if ($menu_link_color) { echo 'color: ' . $menu_link_color . '; '; }?>
}

.menu-mobile-container .menu .current-menu-item a, .menu-mobile-container .menu a:hover, .menu-mobile-container .menu .current_page_parent a,
.menu-container .menu .current-menu-item a, .menu-container .menu a:hover, .menu-container .menu .current_page_parent a, li.menu-item-has-children:hover .sub-menu-icon{
  <?php if ($menu_link_active_color) { echo 'color: ' . $menu_link_active_color . '; '; }?>
}

<?php if($menu_icon_top_bar_background_color) :?>

.menu-button span::before{
  background-color: <?php echo $menu_icon_top_bar_background_color; ?>;
}

<?php endif ?>

<?php if($menu_icon_middle_bar_background_color) :?>

.menu-button span{
  background-color: <?php echo $menu_icon_middle_bar_background_color; ?>;
}

<?php endif ?>

<?php if($menu_icon_bottom_bar_background_color) :?>

.menu-button span::after{
  background-color: <?php echo $menu_icon_bottom_bar_background_color; ?>;
}

<?php endif ?>

<?php if($menu_icon_top_bar_background_color): ?>

.menu-button-txt{
  color: <?php echo $menu_icon_text_color_color; ?>;
}

<?php endif ?>

#header .menu a .link-text, .sub-menu-icon{
  <?php 
    if($menu_line_height) { echo 'line-height: ' . $menu_line_height . 'px;'; }
    if($menu_font_size) { echo 'font-size: ' . $menu_font_size . 'px;';}
  ?>
}

<?php if($mobile_menu_item_divider_color): ?>

#mobile-nav .menu li{
  border-bottom: solid 1px <?php echo $menu_icon_text_color_color; ?>;
}

#mobile-nav .menu li:last-child{
  border-bottom: none;
}

<?php endif ?>

<?php if ($footer_top_background_color) : ?>

#top-footer{ 
  background-color: <?php echo $footer_top_background_color; ?>;
  <?php if ($footer_top_text_color) : ?>
  color: <?php echo $footer_top_text_color; ?>;
  <?php endif; ?>
}

<?php endif; ?>


<?php if ($footer_top_link_color) : ?>

#top-footer a{ 
  color: <?php echo $footer_top_link_color; ?>;
}

#top-footer .social-icon svg path,
#top-footer .social-icon svg polygon{
  stroke: <?php echo $footer_top_link_color; ?>;
}

<?php endif; ?>

<?php if ($footer_top_link_hover_color) : ?>

#top-footer a:hover{ 
  color: <?php echo $footer_top_link_hover_color; ?>;
}

<?php endif; ?>

<?php if ($footer_bottom_background_color) : ?>

#bottom-footer{ 
  background-color: <?php echo $footer_bottom_background_color; ?>;
  <?php if ($footer_bottom_text_color) : ?>
  color: <?php echo $footer_bottom_text_color; ?>;
  <?php endif; ?>
}

<?php endif; ?>


<?php if ($footer_bottom_link_color) : ?>

#bottom-footer a{ 
  color: <?php echo $footer_bottom_link_color; ?>;
}

#bottom-footer .social-icon svg path{
  stroke: <?php echo $footer_bottom_link_color; ?>;
}

<?php endif; ?>

<?php if ($footer_bottom_link_hover_color) : ?>

#bottom-footer a:hover{ 
  color: <?php echo $footer_bottom_link_hover_color; ?>;
}

<?php endif; ?>

<?php if($default_font_family) { echo 'body{ font-family: "' . $default_font_family_value . '"; }'; } ?>

h1,h2,h3,h4,h5,h6{<?php if($headings_font_family) { echo 'font-family: "' . $headings_font_family_value . '";'; } if($headings_line_height) { echo 'line-height: ' . $headings_line_height . ';'; } if($headings_font_color) { echo 'color: ' . $headings_font_color . ';'; } if($headings_font_weight) { echo 'font-weight: ' . $headings_font_weight . ';'; } if($headings_text_transform) { echo 'text-transform: ' . $headings_text_transform . ';'; }?>}

p, ul li, ol li{<?php if($paragraph_font_family) { echo 'font-family: "' . $paragraph_font_family_value . '";'; } if($paragraph_line_height) { echo 'line-height: ' . $paragraph_line_height . ';'; } if($paragraph_font_color) { echo 'color: ' . $paragraph_font_color . ';'; } if($paragraph_font_weight) { echo 'font-weight: ' . $paragraph_font_weight . ';'; } if($paragraph_text_transform) { echo 'text-transform: ' . $paragraph_text_transform . ';'; }?>}

.pagination .current,.pagination a:hover{
  background-color: <?php echo $pagination_current_background_color; ?>;
  color: <?php echo $pagination_current_text_color; ?>;
}

.pagination a{
  background-color: <?php echo $pagination_item_background_color; ?>;
  color: <?php echo $pagination_item_text_color; ?>;
}

.effect-sadie .box-content:before{
  background: -webkit-linear-gradient(top, <?php echo $sadie_effect_gradient_top; ?> 0%, <?php echo $sadie_effect_gradient_bottom; ?> 75%);
  background: linear-gradient(to bottom, <?php echo $sadie_effect_gradient_top; ?> 0%, <?php echo $sadie_effect_gradient_bottom; ?> 75%);
}

#scrollTop{
  background: <?php if($scroll_button_background_color){echo $scroll_button_background_color;} else {echo "transparent";} ?>; 
  bottom: <?php echo $scroll_button_bottom; ?>px;
  right: <?php echo $scroll_button_right; ?>px;
  border: solid <?php echo $scroll_button_border_width; ?>px <?php echo $scroll_button_border_color; ?>;
  width: <?php echo $scroll_button_width; ?>px;
  height: <?php echo $scroll_button_width; ?>px;
}

#scrollTop i{
  color: <?php echo $scroll_button_icon_color; ?>;
  font-size: <?php echo $scroll_button_icon_font_size; ?>px;
}

#scrollTop:hover{
  background: <?php if($scroll_button_hover_background_color){echo $scroll_button_hover_background_color;} else {echo "transparent";} ?>; 
  border: solid <?php echo $scroll_button_border_width; ?>px <?php echo $scroll_button_hover_border_color; ?>;
}

#scrollTop:hover i{
  color: <?php echo $scroll_button_hover_icon_color; ?>;
}

<?php if( have_rows('theme_colors') ): while( have_rows('theme_colors') ): the_row(); 

  $color = get_sub_field('color');
  $color_class_name = get_sub_field('color_class_name');

  echo '.'. $color_class_name .'-border{ border-color:' . $color . ';  }';
  echo '.'. $color_class_name .'-bg{ background-color:' . $color . ';  }';
  echo '.'. $color_class_name .'-txt{ color:' . $color . ';  }';
  echo '.btn.'. $color_class_name .'.outline{ background: none; color:' . $color . ';  border: solid 2px ' . $color . ';}';
  echo '.btn.'. $color_class_name .'.outline:hover{ color: #FFF; background: ' . $color . ';}';
  echo '.btn.'. $color_class_name .'.solid{ color: #FFF; background: ' . $color . ';}';
  echo '.btn.'. $color_class_name .'-hover:hover{ color: #FFF; background: ' . $color . ' !important;}';
  echo '*[class*="hvr"].'. $color_class_name .':before{ background:' . $color . '; border-color:' . $color . ';}';
  
endwhile; endif; 
?>

<?php if ($global_css) { echo $global_css; }?>

<?php if ($tablet_portrait_css) { echo '@media screen and (min-width: 700px) and (orientation: portrait){' . $tablet_portrait_css . '}'; }?>

<?php if ($tablet_landscape_css) { echo '@media screen and (min-width: 700px) and (orientation: landscape){' . $tablet_landscape_css . '}'; }?>

<?php if ($desktop_css) { echo '@media screen and (min-width: 1100px){' . $desktop_css . '}'; }?>

<?php endif; ?>

