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
$mobile_header_height = get_field('mobile_header_height', 'option');
$header_bg_rgb = hex2rgb($header_color);
$menu_link_color = get_field('menu_link_color', 'option');
$menu_font_size = get_field('menu_font_size', 'option');

$menu_font_family = get_field_object('menu_font_family', 'option'); 
$menu_font_family_value = get_field('menu_font_family', 'option');
$menu_font_family_label = $menu_font_family['choices'][ $menu_font_family_value ];

$menu_link_active_color = get_field('menu_link_active_color', 'option');
$general_font_family = get_field('general_font_family', 'option'); 
$general_font = $general_font_family["fonts"];

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

$footer_top_background_color = get_field('footer_top_background_color', 'option');
$footer_top_text_color = get_field('footer_top_text_color', 'option');
$footer_top_link_color = get_field('footer_top_link_color', 'option');
$footer_top_link_hover_color = get_field('footer_top_link_hover_color', 'option');
$footer_bottom_background_color = get_field('footer_bottom_background_color', 'option');
$footer_bottom_text_color = get_field('footer_bottom_text_color', 'option');
$footer_bottom_link_color = get_field('footer_bottom_link_color', 'option');
$footer_bottom_link_hover_color = get_field('footer_bottom_link_hover_color', 'option');

$global_css = get_field('global_css', 'option');
$tablet_portrait_css = get_field('tablet_portrait_css', 'option');
$tablet_landscape_css = get_field('tablet_landscape_css', 'option');
$desktop_css = get_field('desktop_css', 'option');

?>

<?php if ($text_highlight_color) : ?>

::-moz-selection { background: <?php echo $text_highlight_color; ?>; color: #FFF; }
::selection { background: <?php echo $text_highlight_color; ?>; color: #FFF;}

<?php endif; ?>

<?php if($content_background_color) { echo '#wrapper{background-color: ' . $content_background_color . ';} '; }?>

<?php if($main_font_color) { echo 'body{color: ' . $main_font_color . ';} '; }?>

<?php if($header_color) { echo '#header, #header .menu-mobile-container{background-color: ' . $header_color . ';} '; }?>

<?php if($mobile_header_height) { echo '.header-inner{ height: ' . $mobile_header_height . 'px;} .page-header, .post-image-window{ padding-top:' . $mobile_header_height . 'px;} '; }?>

@media screen and (min-width: 1000px){
  <?php if($header_color) { echo '#header .menu-container{ background-color: transparent; } #header { background-color: rgba(' . $header_bg_rgb . ', ' . $header_background_opacity . ');} '; }?>
  <?php if($desktop_header_height) { echo '.header-inner{ height: ' . $desktop_header_height . 'px;} #header .menu a{ line-height: ' . $desktop_header_height . 'px; } .page-header, .post-image-window{ padding-top:' . $desktop_header_height . 'px;} '; }?>
}

#header .menu a{
  <?php if ($menu_link_color) { echo 'color: ' . $menu_link_color . '; '; }?>
  <?php if ($menu_font_family) { echo 'font-family: "' . $menu_font_family_label  . '"; '; }?>
}

#header .menu .current-menu-item a, #header .menu a:hover{
  <?php if ($menu_link_active_color) { echo 'color: ' . $menu_link_active_color . '; '; }?>
}

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

#top-footer .social-icon svg path{
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

h1,h2,h3,h4,h5,h6{<?php if($headings_font_family_label) { echo 'font-family: "' . $headings_font_family_label . '";'; } if($headings_line_height) { echo 'line-height: ' . $headings_line_height . ';'; } if($headings_font_color) { echo 'color: ' . $headings_font_color . ';'; } if($headings_font_weight) { echo 'font-weight: ' . $headings_font_weight . ';'; } if($headings_text_transform) { echo 'text-transform: ' . $headings_text_transform . ';'; }?>}

p, ul li, ol li{<?php if($paragraph_font_family_label) { echo 'font-family: "' . $paragraph_font_family_label . '";'; } if($paragraph_line_height) { echo 'line-height: ' . $paragraph_line_height . ';'; } if($paragraph_font_color) { echo 'color: ' . $paragraph_font_color . ';'; } if($paragraph_font_weight) { echo 'font-weight: ' . $paragraph_font_weight . ';'; } if($paragraph_text_transform) { echo 'text-transform: ' . $paragraph_text_transform . ';'; }?>}

<?php if( have_rows('theme_colors') ): while( have_rows('theme_colors') ): the_row(); 

  $color = get_sub_field('color');
  $color_class_name = get_sub_field('color_class_name');

  echo '.'. $color_class_name .'-border{ border-color:' . $color . ';  }';
  echo '.'. $color_class_name .'-bg{ background-color:' . $color . ';  }';
  echo '.'. $color_class_name .'-txt{ color:' . $color . ';  }';
  echo '*[class*="hvr"].'. $color_class_name .':before{ background-color:' . $color . '; border-color:' . $color . ';}';
  
endwhile; endif; 
?>

<?php if ($global_css) { echo $global_css; }?>

<?php if ($tablet_portrait_css) { echo '@media screen and (min-width: 700px) and (orientation: portrait){' . $tablet_portrait_css . '}'; }?>

<?php if ($tablet_landscape_css) { echo '@media screen and (min-width: 700px) and (orientation: landscape){' . $tablet_landscape_css . '}'; }?>

<?php if ($desktop_css) { echo '@media screen and (min-width: 1100px){' . $desktop_css . '}'; }?>

<?php endif; ?>

