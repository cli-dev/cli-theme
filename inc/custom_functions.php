<?php

define( 'ACFGFS_API_KEY', 'AIzaSyCb6qQxNAuJiQm-iEBkCs3KF1Iopl1gw0U' );

define('CLI_ROOT', get_template_directory_uri());

// Add Main Stylesheet

function main_stylesheet() {

  wp_register_style( 'main', CLI_ROOT . '/css/min/style.css', false, false, 'all' );
  wp_enqueue_style( 'main' );

}
add_action( 'wp_enqueue_scripts', 'main_stylesheet' );

if(!function_exists('cli_is_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function cli_is_css_folder_writable() {
		$css_dir = get_template_directory().'/css';

		return is_writable($css_dir);
	}
}

function cli_generate_dynamic_css_and_js() {

		if(cli_is_css_folder_writable()) {
			$css_dir = get_template_directory().'/css/';

			ob_start();
			include_once('css/style_dynamic.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);

		}
	}

function cli_add_dynamic_css(){
  if (file_exists(dirname(__FILE__) ."/css/style_dynamic.css") && cli_is_css_folder_writable() && !is_multisite() && !is_admin()) {
    wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.css", array(), filemtime(dirname(__FILE__) ."/css/style_dynamic.css"));
  } 
  else if(!is_admin()) {
    wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.php");
  }
}
add_action( 'wp_enqueue_scripts', 'cli_add_dynamic_css' );

function bac_variable_length_excerpt($text, $length, $finish_sentence){


  $length = get_field('excerpt_length', 'option');
  
  $finish_sentence = get_field('finish_sentence', 'option');
   
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
//Hooks the 'bac_excerpt_filter' function to a specific (get_the_excerpt) filter action.
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
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div>' . $phoneCode . $emailCode . '</div>';
  
}

function displayAddress() {
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div></div>';
  
}

function displayContactInfo() {
  
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $phoneCode . $emailCode . '</div>';
  
}

function displaySocialProfiles($icon_type, $extra_class) {
  
  $custom_class = $extra_class;
  $type_of_icon = $icon_type;
  $facebook= get_field('facebook', 'options');
  $twitter = get_field('twitter', 'options');
  $google = get_field('google', 'options');
  $linkedin = get_field('linkedin', 'options');
  $tumblr = get_field('tumblr', 'options');
  $pinterest = get_field('pinterest', 'options');
  $flickr = get_field('flickr', 'options');
  $newswire = get_field('newswire', 'options');
  $instagram = get_field('instagram', 'options');
  $youtube = get_field('youtube', 'options');
  $vimeo = get_field('vimeo', 'options');

  $facebookCode = '';
  $twitterCode = '';
  $googleCode = '';
  $linkedinCode = '';
  $tumblrCode = '';
  $pinterestCode = '';
  $flickrCode = '';
  $newswireCode = '';
  $instagramCode = '';
  $youtubeCode = '';
  $vimeoCode = '';

  $facebookSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/facebook-circle-outline.svg');
  $twitterSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/twitter-circle-outline.svg');
  $googleSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/google-circle-outline.svg');
  $linkedinSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/linkedin-circle-outline.svg');
  $tumblrSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/tumblr-circle-outline.svg');
  $pinterestSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/pinterest-circle-outline.svg');
  $flickrSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/flickr-circle-outline.svg');
  $newswireSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/newswire-circle-outline.svg');
  $instagramSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/instagram-circle-outline.svg');
  $youtubeSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/youtube-circle-outline.svg');
  $vimeoSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/vimeo-circle-outline.svg');
  
  if($facebook){
    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank">' . $facebookSVG . '</a></div>';  
    }
    
  }
  
  if($twitter){
    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank">' . $twitterSVG . '</a></div>';  
    }

  }
  
  if($google){
    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank">' . $googleSVG . '</a></div>';  
    }

  }
  
  if($linkedin){
    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank">' . $linkedinSVG . '</a></div>';  
    }

  }
  
  if($tumblr){
    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank">' . $tumblrSVG . '</a></div>'; 
    }

  }
  
  if($pinterest){
    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank">' . $pinterestSVG . '</a></div>'; 
    }

  }
  
  if($flickr){
    if($type_of_icon === 'icon1'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square-round"></i></a></div>';  
    }
    else{
    $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank">' . $flickrSVG . '</a></div>';  
    }

  }
  
  if($newswire){
    if($type_of_icon === 'icon1'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square-round"></i></a></div>';  
    }
    else{
    $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank">' . $newswireSVG . '</a></div>';  
    }

  }
  
  if($instagram){
    if($type_of_icon === 'icon1'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square-round"></i></a></div>';  
    }
    else{
    $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank">' . $instagramSVG . '</a></div>';  
    }

  }

  if($youtube){
    if($type_of_icon === 'icon1'){
      $youtubeCode = '<div class="social-icon"><a href="' . $youtube  . '" target="_blank"><i class="cli-youtube"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $youtubeCode = '<div class="social-icon"><a href="' . $youtube  . '" target="_blank"><i class="cli-youtube-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $youtubeCode = '<div class="social-icon"><a href="' . $youtube  . '" target="_blank"><i class="cli-youtube-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $youtubeCode = '<div class="social-icon"><a href="' . $youtube  . '" target="_blank"><i class="cli-youtube-square-round"></i></a></div>';  
    }
    else{
    $youtubeCode = '<div class="social-icon"><a href="' . $youtube  . '" target="_blank">' . $youtubeSVG . '</a></div>';  
    }

  }

  if($vimeo){
    if($type_of_icon === 'icon1'){
      $vimeoCode = '<div class="social-icon"><a href="' . $vimeo  . '" target="_blank"><i class="cli-vimeo"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $vimeoCode = '<div class="social-icon"><a href="' . $vimeo  . '" target="_blank"><i class="cli-vimeo-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $vimeoCode = '<div class="social-icon"><a href="' . $vimeo  . '" target="_blank"><i class="cli-vimeo-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $vimeoCode = '<div class="social-icon"><a href="' . $vimeo  . '" target="_blank"><i class="cli-vimeo-square-round"></i></a></div>';  
    }
    else{
    $vimeoCode = '<div class="social-icon"><a href="' . $vimeo  . '" target="_blank">' . $vimeoSVG . '</a></div>';  
    }

  }
  
  

return '<div class="social social-profiles ' . $type_of_icon . ' ' . $custom_class . '">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . $flickrCode  . $newswireCode . $instagramCode . $youtubeCode . $vimeoCode .'</div>';
  
}

function displaySocialShare() {
  
  $type_of_icon = get_field('type_of_icon', 'options');

  $facebookSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/facebook-circle-outline.svg');
  $twitterSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/twitter-circle-outline.svg');
  $googleSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/google-circle-outline.svg');
  $linkedinSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/linkedin-circle-outline.svg');
  $tumblrSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/tumblr-circle-outline.svg');
  $pinterestSVG = file_get_contents(get_template_directory_uri() . '/imgs/social/pinterest-circle-outline.svg');

    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank">' . $facebookSVG . '</a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank">' . $twitterSVG . '</a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank">' . $googleSVG . '</a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank">' . $linkedinSVG . '</a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon4'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank">' . $tumblrSVG . '</a></div>'; 
    }

    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank">' . $pinterestSVG . '</a></div>'; 
    }


return '<div class="social social-share ' . $type_of_icon . '">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . '</div>';
  
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
		'supports'            => array( 'title', 'thumbnail', ),
		'hierarchical'        => false,
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

// Register Custom Post Type
function portfolio() {

  $labels = array(
    'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Portfolio', 'text_domain' ),
    'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Portfolio Items', 'text_domain' ),
    'add_new_item'          => __( 'Add New Portfolio Item', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Item', 'text_domain' ),
    'edit_item'             => __( 'Edit Item', 'text_domain' ),
    'update_item'           => __( 'Update Item', 'text_domain' ),
    'view_item'             => __( 'View Item', 'text_domain' ),
    'search_items'          => __( 'Search Item', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Portfolio Item', 'text_domain' ),
    'description'           => __( 'Post Type Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'thumbnail', ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-portfolio',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


function push_google_font_families($field){

  $returned_content = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCb6qQxNAuJiQm-iEBkCs3KF1Iopl1gw0U');

  $google_fonts = json_decode($returned_content, true);

  $fonts = array();

  foreach($google_fonts['items'] as $val){

    $fontName = $val['family'];

    $fonts[$fontName] = $fontName;
  }

  $field['choices'] = $fonts;

  return $field;
}

add_filter('acf/load_field/name=theme_font', 'push_google_font_families');


function theme_font_choices( $field ) {
  
  $theme_fonts = get_field('theme_fonts', 'option');
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
  $theme_colors = get_field('theme_colors', 'option');

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

  $logo_position = get_field('logo_position', 'option');
  $center_logo_menu_type = get_field('center_logo_menu_type', 'option');

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
  <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" class="btn black outline" />
  </form>';

  return $form;
}

add_filter( 'get_search_form', 'my_search_form' );


function load_admin_style() {
  wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin/admin-style.css', false, '1.0.0' );
}

add_action( 'admin_enqueue_scripts', 'load_admin_style', 99 );