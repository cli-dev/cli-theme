<?php

function custom_div( $atts, $content = null ) {

	 $a = shortcode_atts( array(
			'class' => '',
      'animation_effect' => '',
      'animation_duration' => '',
      'animation_delay' => '',
      'animation_offset' => '',
		), $atts );

  return '<div class="' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'custom_div', 'custom_div' );

function btn_shortcode( $atts ) {

  $a = shortcode_atts( array(
    'title' => '',
    'link' => '',
    'btn_color' => '',
    'customclass' => '',
    'target' => 'self',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<a href="' . esc_attr($a['link']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '" target="_' . esc_attr($a['target']) . '" class="btn ' . esc_attr($a['btn_color']) . '-btn ' . esc_attr($a['customclass']) . ' ' . esc_attr($a['animation_effect']) . '"><span>' . esc_attr($a['title']) . '</span></a>';
  
}
add_shortcode( 'btn', 'btn_shortcode' );


function custom_shortcode( $atts ) {

	// Attributes
	$a = shortcode_atts(
		array(
			'default_text' => '',
			'hover_text' => '',
			'link' => '',
      'btn_color' => '',
      'class' => '',
      'target' => 'self',
      'animation_effect' => '',
      'animation_duration' => '',
      'animation_delay' => '',
      'animation_offset' => '',
		), $atts );
    
  return '<a class="special-btn ' . esc_attr($a['btn_color']) . '-btn ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '" href="' . esc_attr($a['link']) . '" target="_' . esc_attr($a['target']) . '"><span class="first-panel">' . esc_attr($a['default_text']) . '</span><span class="second-panel">' . esc_attr($a['hover_text']) . '</span></a>';
}
add_shortcode( 'special_btn', 'custom_shortcode' );

function page_box_shortcode( $atts ) {

  $a = shortcode_atts( array(
    'width' => '12',
    'align' => 'none',
    'content_position' => 'start',
    'content_align' => 'stretch',
    'page_slug' => '',
    'class' => '',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<div class="flex-col col-' . esc_attr($a['width']) . ' flex-single-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['page_slug']) . ' ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . ' page-link-box" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '"><div class="col-inner flex-position-' . esc_attr($a['content_position']) . '  flex-align-' . esc_attr($a['content_align']) . '" '. page_box_bg(esc_attr($a['page_slug'])) . '>' . create_page_box(esc_attr($a['page_slug'])) . '</div></div>';
  
}
add_shortcode( 'page_box', 'page_box_shortcode' );

function divider_shortcode( $atts ) {

  $a = shortcode_atts( array(
    'width' => '100%',
    'height' => '1px',
    'bg_color' => '#000',
    'margin_top' => '0',
    'margin_bottom' => '0',
    'margin_left' => 'auto',
    'margin_right' => 'auto',
    'class' => '',
  ), $atts );
  
  return '<div class="divider ' . esc_attr($a['class']) . '" style="width: ' . esc_attr($a['width']) . '; height: ' . esc_attr($a['height']) . '; margin-top: ' . esc_attr($a['margin_top']) . '; margin-bottom: ' . esc_attr($a['margin_bottom']) . '; margin-left: ' . esc_attr($a['margin_left']) . '; margin-right: ' . esc_attr($a['margin_right']) . '; background-color: ' . esc_attr($a['bg_color']) . ';"></div>';
  
}
add_shortcode( 'divider', 'divider_shortcode' );

function show_full_Address() {
  
  return displayfullAddress();
  
}
add_shortcode( 'full_address', 'show_full_Address' );

function show_Address() {
  
  return displayAddress();
  
}
add_shortcode( 'address', 'show_Address' );

function show_Contact() {
  
  return displayContactInfo();
  
}
add_shortcode( 'contact_info', 'displayContactInfo' );

function show_Phone() {
  
  return displayPhone();
  
}
add_shortcode( 'phone', 'show_Phone' );

function show_Email() {
  
  return displayEmail();
  
}
add_shortcode( 'email', 'show_Email' );

function show_verified_badge() {
  
  return display_verified_fbr_badge();
  
}
add_shortcode( 'fbr_verified', 'show_verified_badge' );

function show_verified_star_badge() {
  
  return display_verified_rating_fbr_badge();
  
}
add_shortcode( 'fbr_verified_star', 'show_verified_star_badge' );

function show_top_place() {
  
  return display_top_place_badge();
  
}
add_shortcode( 'fbr_top_place', 'show_top_place' );

function customer_service_badge() {
  
  return display_customer_service_badge();
  
}
add_shortcode( 'fbr_customer_service', 'customer_service_badge' );

function fbr_badges() {
  
  return '<div class="fbr-badges">' . display_top_place_badge() . display_verified_fbr_badge() . '</div>';
  
}
add_shortcode( 'fbr_badges', 'fbr_badges' );

function show_SocialProfiles($atts) {
  $a = shortcode_atts(
    array(
      'icon_type' => '',
    ), $atts );
  $icon_type = 'icon' . $a['icon_type'];
  return displaySocialProfiles($icon_type, 'shortcode');
  
}
add_shortcode( 'social_profiles', 'show_SocialProfiles' );

function show_FacebookProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayFacebookProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'facebook', 'show_FacebookProfile' );

function show_TwitterProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayTwitterProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'twitter', 'show_TwitterProfile' );

function show_GoogleProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayGoogleProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'google', 'show_GoogleProfile' );

function show_LinkedInProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayLinkedInProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'linkedin', 'show_LinkedInProfile' );

function show_TumblrProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayTumblrProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'tumblr', 'show_TumblrProfile' );

function show_PinterestProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayPinterestProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'pinterest', 'show_PinterestProfile' );

function show_FlickrProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayFlickrProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'flickr', 'show_FlickrProfile' );

function show_NewswireProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayNewswireProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'newswire', 'show_NewswireProfile' );

function show_InstagramProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayInstagramProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'instagram', 'show_InstagramProfile' );

function show_YoutubeProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayYoutubeProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'youtube', 'show_YoutubeProfile' );

function show_VimeoProfile() {
  $myoptions = get_option( 'themesettings_');
  $icon_type = $myoptions['type_of_icon'];
  return displayVimeoProfile($icon_type, 'shortcode');
  
}
add_shortcode( 'vimeo', 'show_VimeoProfile' );


function show_team() {
  
  get_template_part('templates/team-loop');
  
}
add_shortcode( 'team', 'show_team' );

function show_positions() {
  
  get_template_part('templates/positions-loop');
  
}
add_shortcode( 'positions', 'show_positions' );

function home_logo_link() {

  $myoptions = get_option( 'themesettings_');
  $desktop_logo_maximum_width = $myoptions['desktop_logo_maximum_width'];
  $logo_max_width = ($desktop_logo_maximum_width) ? ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"' : '';
  $logoimg = $myoptions['logo'];
  $logosvg = $myoptions['svg_desktop_logo'];
  $logo = ($logosvg) ? $logosvg : $logoimg;

  $logo_bg = ($logo) ? ' style="background: url(' . $logo . ') center no-repeat; background-size: contain;"' : '';

  $siteLogo = '<div class="site-logo" itemtype="http://schema.org/LocalBusiness"'. $logo_max_width .'><a itemprop="url" href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home"' . $logo_bg . '><img src="' . $logoimg . '" alt="' . get_bloginfo( 'name' ) . ' Logo" itemprop="logo" class="site-main-logo" /></a></div>';

  return $siteLogo;
  
}
add_shortcode( 'logo_link', 'home_logo_link' );

function footer_logo_link() {

  $myoptions = get_option( 'themesettings_');
  $logo = $myoptions['footer_logo'];

  $footerLogo = '<div class="footer-logo"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">
    <img src="' . $logo . '" alt="' . get_bloginfo( 'name' ) . ' Logo" /></a></div>';

  return $footerLogo;
  
}
add_shortcode( 'footer_logo', 'footer_logo_link' );

function copyright() {
  $myoptions = get_option( 'themesettings_');
  $copyright = $myoptions['copyright_text'];
  $siteTitle = get_bloginfo( 'name' ); 
  
  $currentYear = date("Y");

  if($copyright){
    return $copyright . ' &copy; ' . $currentYear;
  } else{
    return $siteTitle . ' &copy; ' . $currentYear;
  }
  
}
add_shortcode( 'copyright', 'copyright' );
