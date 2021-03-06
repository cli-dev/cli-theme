<?php

define('CLI_ROOT', get_template_directory_uri());

// Add Main Stylesheet

function add_favicon() {
  $myoptions = get_option( 'themesettings_');
  $favicon = $myoptions['favicon'];
  if ($favicon) {
    echo '<link rel="shortcut icon" href="' . $favicon . '" type="image/x-icon" />';
  }
}

add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');

function bac_variable_length_excerpt($text, $length, $finish_sentence){
  $myoptions = get_option( 'themesettings_');

  $length = $myoptions['excerpt_length'];

  $finish_sentence = $myoptions['finish_sentence'];

  $tokens = array();
  $out = '';
  $word = 0;

  //Divide the string into tokens; HTML tags, or words, followed by any whitespace.
  $regex = '/(<[^>]+>|[^<>\s]+)\s*/u';
  preg_match_all($regex, $text, $tokens);
  foreach ($tokens[0] as $t){ 
    //Parse each token
    if ($word >= $length && !$finish_sentence){ 
    //Limit reached
      break;
    }
    if ($t[0] != '<'){ 
    //Token is not a tag. 
    //Regular expression that checks for the end of the sentence: '.', '?' or '!'
      $regex1 = '/[\?\.\!]\s*$/uS';
      if ($word >= $length && $finish_sentence && preg_match($regex1, $t) == 1){ 
      //Limit reached, continue until ? . or ! occur to reach the end of the sentence.
        $out .= trim($t);
        break;
      }   
      $word++;
    }
    //Append what's left of the token.
    $out .= $t;     
  }
  //Add the excerpt ending as a link.
  $excerpt_end = ' [&hellip;]';

  //Add the excerpt ending as a non-linked ellipsis with brackets.
  //$excerpt_end = ' [&hellip;]';

  //Append the excerpt ending to the token. 
  $out .= $excerpt_end;

  return trim(force_balance_tags($out)); 
}

function bac_excerpt_filter($text){
  //Get the full content and filter it.
  $finish_sentence = 1;

  $length = 15;

  $text = get_the_content('');
  $text = strip_shortcodes( $text );
  $text = apply_filters('the_content', $text);

  $text = str_replace(']]>', ']]&gt;', $text);

  /**By default the code allows all HTML tags in the excerpt**/
  //Control what HTML tags to allow: If you want to allow ALL HTML tags in the excerpt, then do NOT touch.

  //If you want to Allow SOME tags: THEN Uncomment the next line + Line 80.
  $allowed_tags = '<p>'; /* Here I am allowing p, a, strong tags. Separate tags by comma. */

  //If you want to Disallow ALL HTML tags: THEN Uncomment the next line + Line 80, 
  //$allowed_tags = ''; /* To disallow all HTML tags, keep it empty. The Excerpt will be unformated but newlines are preserved. */
  $text = strip_tags($text, $allowed_tags); /* Line 80 */

  //Create the excerpt.
  $text = bac_variable_length_excerpt($text, $length, $finish_sentence);  
  return $text;
}
add_filter('get_the_excerpt','bac_excerpt_filter',5);

add_filter('widget_text', 'do_shortcode');

function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
}

function displayfullAddress() {
  $myoptions = get_option( 'themesettings_');
  $address_1 = $myoptions['address_line_1'];
  $city = $myoptions['city'];
  $state= '';
  $country = $myoptions['country'];
  $zip = $myoptions['zip'];
  $phone = $myoptions['phone'];
  $email = $myoptions['email'];

  $addressCode = '';
  $cityCode = '';
  $stateCode = '';
  $zipCode = '';
  $phoneCode = '';
  $emailCode = '';

  if($country === "AU") { 
    $state = $myoptions['au_state'];
  } else if($country === "CA"){ 
    $state = $myoptions['ca_state'];
  } else if($country === "UK"){ 
    $state = $myoptions['postcode_area'];
  } else { 
    $state = $myoptions['us_state'];
  }

  if($address_1){
    $addressCode = '<span class="schema-info address1" itemprop="streetAddress">' . $address_1 . '</span>';  
  }
  
  if($city){
    $cityCode = '<span class="schema-info city" itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span class="schema-info state" itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span class="schema-info zip" itemprop="postalCode">' . $zip . '</span>';  
  }
  
  if($phone){
    $phoneCode = '<div class="schema-info phone"><a href="tel:' . $phone . '"  itemprop="telephone">' . $phone . '</a></div>';  
  }
  
  if($email){
    $emailCode = '<div class="schema-info email"><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

  return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><a href="http://maps.google.com/?q=' . $address_1 . ' ' . $city . ' ' . $state . ' ' . $zip . '" target="_blank" class="schema-info address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div class="schema-info address2">' . $cityCode . $stateCode . ' ' . $zipCode . '</div></a>' . $phoneCode . $emailCode . '</div>';
  
}

function displayAddress() {
  $myoptions = get_option( 'themesettings_');
  $address_1 = $myoptions['address_line_1'];
  $city = $myoptions['city'];
  $state= '';
  $country = $myoptions['country'];
  $zip = $myoptions['zip'];

  $addressCode = '';
  $cityCode = '';
  $stateCode = '';
  $zipCode = '';

  if($country === "AU") { 
    $state = $myoptions['au_state'];
  } else if($country === "CA"){ 
    $state = $myoptions['ca_state'];
  } else if($country === "UK"){ 
    $state = $myoptions['postcode_area'];
  } else { 
    $state = $myoptions['us_state'];
  }
  
  if($address_1){
    $addressCode = '<span class="schema-info address-line-1" itemprop="streetAddress">' . $address_1 . '</span>';  
  }
  
  if($city){
    $cityCode = '<span class="schema-info city" itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span class="schema-info state" itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span class="schema-info zip" itemprop="postalCode">' . $zip . '</span>';  
  }

  return 
  '<a href="http://maps.google.com/?q=' . $address_1 . ' ' . $city . ' ' . $state . ' ' . $zip . '" target="_blank" class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">
    <span class="schema-info address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
      ' . $addressCode . '
      <span class="schema-info address-line-2">' . $cityCode . $stateCode . ' ' . $zipCode . '</span>
    </span>
  </a>';
  
}

function displayContactInfo() {
  $myoptions = get_option( 'themesettings_');
  $phone = $myoptions['phone'];
  $email = $myoptions['email'];

  $phoneCode = '';
  $emailCode = '';
  
  if($phone){
    $phoneCode = '<div class="schema-info phone"><a href="tel:' . $phone . '"  itemprop="telephone">' . $phone . '</a></div>';  
  }
  
  if($email){
    $emailCode = '<div class="schema-info email"><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

  return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $phoneCode . $emailCode . '</div>';
  
}

function displayPhone() {
  $myoptions = get_option( 'themesettings_');
  $phone = $myoptions['phone'];

  $phoneCode = '';
  
  if($phone){
    $phoneCode = '<div class="schema-info phone"><a href="tel:' . $phone . '"  itemprop="telephone">' . $phone . '</a></div>';  
  }

  return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $phoneCode . '</div>';
  
}

function displayEmail() {
  $myoptions = get_option( 'themesettings_');
  $email = $myoptions['email'];

  $emailCode = '';
  
  if($email){
    $emailCode = '<div class="schema-info email"><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

  return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $emailCode . '</div>';
  
}

function hex2rgb($hex) {
  $hex = str_replace("#", "", $hex);
  
  if(strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
  } else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
  }
  $rgb = array($r, $g, $b);
  
  //return $rgb; // returns an array with the rgb values
  
  $Final_Rgb_color = implode(", ", $rgb);
  
  return $Final_Rgb_color;
}

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

add_image_size( 'sidebar-thumb', 50, 50, true );

add_image_size( 'theme_image_preview', 100, 100);

function position() {

	$labels = array(
		'name'                => _x( 'Positions', 'Post Type General Name', 'cli_theme' ),
		'singular_name'       => _x( 'Position', 'Post Type Singular Name', 'cli_theme' ),
		'menu_name'           => __( 'Open Positions', 'cli_theme' ),
		'name_admin_bar'      => __( 'Open Positions', 'cli_theme' ),
		'parent_item_colon'   => __( 'Parent Item:', 'cli_theme' ),
		'all_items'           => __( 'All Positions', 'cli_theme' ),
		'add_new_item'        => __( 'Add New Position', 'cli_theme' ),
		'add_new'             => __( 'Add New', 'cli_theme' ),
		'new_item'            => __( 'New Position', 'cli_theme' ),
		'edit_item'           => __( 'Edit Position', 'cli_theme' ),
		'update_item'         => __( 'Update Position', 'cli_theme' ),
		'view_item'           => __( 'View Position', 'cli_theme' ),
		'search_items'        => __( 'Search Position', 'cli_theme' ),
		'not_found'           => __( 'Not found', 'cli_theme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cli_theme' ),
   );
	$args = array(
		'label'               => __( 'Position', 'cli_theme' ),
		'description'         => __( 'Open job positions', 'cli_theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-index-card',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
   );
	register_post_type( 'position', $args );

}
add_action( 'init', 'position', 0 );

function team_member() {

	$labels = array(
		'name'                => _x( 'Team Members', 'Post Type General Name', 'cli_theme' ),
		'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'cli_theme' ),
		'menu_name'           => __( 'Team Members', 'cli_theme' ),
		'name_admin_bar'      => __( 'Team Members', 'cli_theme' ),
		'parent_item_colon'   => __( 'Team Member:', 'cli_theme' ),
		'all_items'           => __( 'All Team Members', 'cli_theme' ),
		'add_new_item'        => __( 'Add New Team Member', 'cli_theme' ),
		'add_new'             => __( 'Add New Team Member', 'cli_theme' ),
		'new_item'            => __( 'New Team Member', 'cli_theme' ),
		'edit_item'           => __( 'Edit Team Member', 'cli_theme' ),
		'update_item'         => __( 'Update Team Member', 'cli_theme' ),
		'view_item'           => __( 'View Team Member', 'cli_theme' ),
		'search_items'        => __( 'Search Team Member', 'cli_theme' ),
		'not_found'           => __( 'Not found', 'cli_theme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cli_theme' ),
   );
	$args = array(
		'label'               => __( 'Team Member', 'cli_theme' ),
		'description'         => __( 'Post Type Description', 'cli_theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
   );
	register_post_type( 'team_member', $args );

}
add_action( 'init', 'team_member', 0 );

function projects() {

  $labels = array(
    'name'                  => _x( 'Projects', 'Post Type General Name', 'cli_theme' ),
    'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'cli_theme' ),
    'menu_name'             => __( 'Projects', 'cli_theme' ),
    'name_admin_bar'        => __( 'Projects', 'cli_theme' ),
    'archives'              => __( 'Project Archives', 'cli_theme' ),
    'parent_item_colon'     => __( 'Parent Project:', 'cli_theme' ),
    'all_items'             => __( 'All Projects', 'cli_theme' ),
    'add_new_item'          => __( 'Add New Project', 'cli_theme' ),
    'add_new'               => __( 'Add New', 'cli_theme' ),
    'new_item'              => __( 'New Project', 'cli_theme' ),
    'edit_item'             => __( 'Edit Project', 'cli_theme' ),
    'update_item'           => __( 'Update Project', 'cli_theme' ),
    'view_item'             => __( 'View Project', 'cli_theme' ),
    'search_items'          => __( 'Search Project', 'cli_theme' ),
    'not_found'             => __( 'Not found', 'cli_theme' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'cli_theme' ),
    'featured_image'        => __( 'Featured Image', 'cli_theme' ),
    'set_featured_image'    => __( 'Set featured image', 'cli_theme' ),
    'remove_featured_image' => __( 'Remove featured image', 'cli_theme' ),
    'use_featured_image'    => __( 'Use as featured image', 'cli_theme' ),
    'insert_into_item'      => __( 'Insert into project', 'cli_theme' ),
    'uploaded_to_this_item' => __( 'Uploaded to this project', 'cli_theme' ),
    'items_list'            => __( 'Projects list', 'cli_theme' ),
    'items_list_navigation' => __( 'Projects list navigation', 'cli_theme' ),
    'filter_items_list'     => __( 'Filter projects list', 'cli_theme' ),
    );
  $args = array(
    'label'                 => __( 'Project', 'cli_theme' ),
    'description'           => __( 'Post Type Description', 'cli_theme' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'thumbnail', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-portfolio',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => 'projects',    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    );
  register_post_type( 'project', $args );

}
add_action( 'init', 'projects', 0 );

function project_categories() {

  $labels = array(
    'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'cli_theme' ),
    'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'cli_theme' ),
    'menu_name'                  => __( 'Project Categories', 'cli_theme' ),
    'all_items'                  => __( 'All Project Categories', 'cli_theme' ),
    'parent_item'                => __( 'Parent Category', 'cli_theme' ),
    'parent_item_colon'          => __( 'Parent Category:', 'cli_theme' ),
    'new_item_name'              => __( 'New Project Category Name', 'cli_theme' ),
    'add_new_item'               => __( 'Add New Project Category', 'cli_theme' ),
    'edit_item'                  => __( 'Edit Project Category', 'cli_theme' ),
    'update_item'                => __( 'Update Project Category', 'cli_theme' ),
    'view_item'                  => __( 'View Project Category', 'cli_theme' ),
    'separate_items_with_commas' => __( 'Separate project categories with commas', 'cli_theme' ),
    'add_or_remove_items'        => __( 'Add or remove project categories', 'cli_theme' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'cli_theme' ),
    'popular_items'              => __( 'Popular Categories', 'cli_theme' ),
    'search_items'               => __( 'Search Project Categories', 'cli_theme' ),
    'not_found'                  => __( 'Not Found', 'cli_theme' ),
    'no_terms'                   => __( 'No project categories', 'cli_theme' ),
    'items_list'                 => __( 'Project Categories list', 'cli_theme' ),
    'items_list_navigation'      => __( 'Project Categories list navigation', 'cli_theme' ),
    );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    );
  register_taxonomy( 'project_cat', array( 'project' ), $args );

}
add_action( 'init', 'project_categories', 0 );

function filter_ptags_on_images($content){
 return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


function push_google_font_families($field){

  $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCCi4NfyfjQhCvAdi1VHYKbQhLgl-0linc";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_REFERER, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $result = curl_exec($ch);
  curl_close($ch);

  $google_fonts = json_decode($result, true);

  $fonts = array();

  //$field = '';

  if($google_fonts){
    foreach($google_fonts['items'] as $val){
      $fontName = $val['family'];
      $fonts[$fontName] = $fontName;
    }

    $field['choices'] = $fonts;

    return $field;
    
  } else {
    return null;
  } 
}

add_filter('acf/load_field/name=theme_font', 'push_google_font_families');


function theme_font_choices( $field ) {
  $myoptions = get_option( 'themesettings_');
  $theme_fonts = $myoptions['theme_fonts'];
  $typekit_fonts = get_field('typekit_fonts', 'option');

  $typekitFonts = array();
  $googleFonts = array();
  
  if($theme_fonts)
  {  
    foreach($theme_fonts as $theme_font)
    {
      $font = $theme_font['theme_font'];

      $googleFonts[$font] = $font;
    }
  }

  if($typekit_fonts)
  {  
    foreach($typekit_fonts as $typekit_font)
    {
      $fontName = $typekit_font['typekit_font'];
      $cssName = $typekit_font['css_name'];

      $typekitFonts[$cssName] = $fontName;
    }
  }
  
  $field['choices'] = array_merge($googleFonts, $typekitFonts);
  
  return $field;

}
add_filter('acf/load_field/name=default_font_family', 'theme_font_choices');
add_filter('acf/load_field/name=menu_font_family', 'theme_font_choices');
add_filter('acf/load_field/name=headings_font_family', 'theme_font_choices');
add_filter('acf/load_field/name=paragraph_font_family', 'theme_font_choices');

function theme_button_choices( $field ) {
  $myoptions = get_option( 'themesettings_');

  $theme_colors = $myoptions['theme_colors'];

  $colors = array();

  if($theme_colors){

    foreach($theme_colors as $theme_color){

      $themeColor = $theme_color['color_class_name'];

      array_push($colors, $themeColor);

    }
  }

  $field['choices'] = $colors;
  
  return $field;
}
add_filter('acf/load_field/name=solid_initial_state', 'theme_button_choices');
add_filter('acf/load_field/name=solid_hover_state', 'theme_button_choices');
add_filter('acf/load_field/name=outline_type', 'theme_button_choices');

function custom_navigation_menus() {
  $myoptions = get_option( 'themesettings_');
  $logo_position = $myoptions['logo_position'];

  $center_logo_menu_type = '';

  if ($logo_position === 'center') {
    $center_logo_menu_type = $myoptions['center_logo_menu_type'];
  }
  

  $locations = '';

  if($logo_position === 'center' && $center_logo_menu_type === 'divided'){
    $locations = array(
      'divided-right-menu' => __( 'Divided menu right side', 'cli_theme' ),
      'divided-left-menu' => __( 'Divided menu left side', 'cli_theme' ),
      );
  } else {
    $locations = array(
      'main-menu' => __( 'Main Menu', 'cli_theme' ),
      );
  }
  register_nav_menus( $locations );

}
add_action( 'init', 'custom_navigation_menus' );


function pagination($pages = '', $range = 1){  
  $showitems = ($range * 2)+1;  
  
  global $paged;
  if(empty($paged)) $paged = 1;
  
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }   
  if(1 != $pages){
    echo '<div class="pagination">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'"><i class="fa fa-angle-double-left"></i></a>';
    if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'"><i class="fa fa-angle-left"></i></a>';
    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? '<span class="current">'.$i.'</span>':'<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
      }
    }
    if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'"><i class="fa fa-angle-right"></i></a>';  
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'"><i class="fa fa-angle-double-right"></i></a>';
    echo '</div>';
  }
}

function my_search_form( $form ) {
  $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
  <input type="text" value="' . get_search_query() . '" name="s" id="s" />
  <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" class="btn black outline" /></form>';

return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

function the_slug() {
  global $post;
  $slug = $post->post_name;
  return $slug;
}

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

  // add the file extension to the array

  $existing_mimes['svg'] = 'mime/type';

        // call the modified list of extensions

  return $existing_mimes;

}

add_image_size( 'team-headshot', 300, 300, array( 'center', 'top' ) );

function load_admin_style() {
  wp_register_style( 'acfStyles', CLI_ROOT . '/admin/css/admin-style.css', false, false );
  wp_enqueue_style( 'acfStyles' );

  wp_register_script( 'acfScripts', CLI_ROOT . '/admin/js/admin-scripts.js', array( 'jquery' ), false, false);
  wp_enqueue_script( 'acfScripts' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_style', 999 );